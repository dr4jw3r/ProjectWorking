<?php 

	require_once(DB_DIR . 'Database.php');
	require_once(UTILS_DIR . 'Logger.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class Repository
	{

		private $class;
		private $table_prefix;
		private $class_name;
		private $db;
		
		/*::CONSTRUCTOR/DESTRUCTOR::*/
		public function __construct($class_name)
		{
			require_once(ENTITIES_DIR . $class_name . '.php');

			$this->class_name = $class_name;
			$class = new $class_name;
			$this->db = Database::getInstance();
			$this->table_prefix = Database::getPrefix();
		}

		public function __destruct()
		{
			$this->db = null;
		}


		/*::PRIVATE FUNCTIONS::*/
		private function process_query($stmt)
		{
			$type = '/^update|insert|delete/i';

			$rows = array();

			if(preg_match($type,$stmt->queryString,$match))
			{
				$stmt->execute();
				$rows['status'] = 1;
				$rows['count'] = 1;
				$rows['data'] = $this->db->lastInsertId();
				return $rows;
			}
			else
			{
				$stmt->execute();
				$rows['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$rows['count'] = $stmt->rowCount();

				if($rows['count'] != 0){
					$rows['status'] = 1;
					$rows['count'] = $stmt->rowCount();
				}
				else{
					$rows['status'] = 2;
					$rows['count'] = 0;
				}
				return $rows;
			}		
		}

		private function buildSelect($params)
		{
			$query = 'SELECT * FROM ' . $this->table_prefix . $this->class_name . ' WHERE ';
			end($params);
			$last_key = key($params);

			foreach($params as $key => $value)
			{
				$query .= '`' . $key . '` = :' . $key;
				if(count($params) > 1 && $key != $last_key)
				{
					$query .= ' AND ';
				}
			}

			$stmt = $this->db->prepare($query);
			foreach($params as $key => $value)
			{
				$pdo_type = $this->getPDOType($value);
				$stmt->bindValue(':' . $key, $value, $pdo_type);
			}

			return $stmt;
		}

		private function buildComplexSelect($where, $and, $or)
		{
			$where_clause = array_keys($where);
			$where_clause = $where_clause[0];
			$where_value = $where[$where_clause];

			if($or != null)
			{
				$matches = array();
				$regex = "/_\d+_(.+)/i";
				$or_ar_kz = array_keys($or);
				preg_match($regex, $or_ar_kz[0], $matches);
				$or_key = $matches[1];
			}

			if($and != null)
			{
				$matches = array();
				$regex = "/_\d+_(.+)/i";
				$and_ar_kz = array_keys($and);
				preg_match($regex, $and_ar_kz[0], $matches);
				$and_key = $matches[1];
			}

			$sql = "SELECT * FROM {$this->table_prefix}{$this->class_name} WHERE ";
			$sql .= "`{$where_clause}` = :{$where_clause}";

			if($and != null)
			{
				for($i = 0; $i < count($and); $i++)
				{
					if($i != count($and))
					{
						$sql .= " AND {$and_key} = :_" . ($i + 1) . "_{$and_key}";
					}
				}
			}

			if($or != null)
			{
				for($i = 0; $i < count($or); $i++)
				{
					if($i != count($or))
					{
						$sql .= " OR {$or_key} = :_" . ($i + 1) . "_{$or_key}";
					}
				}
			}

			$stmt = $this->db->prepare($sql);

			$pdo_type = $this->getPDOType($where_value);
			$stmt->bindValue(":{$where_clause}", $where_value, $pdo_type);

			for($i = 0; $i < count($and); $i++)
			{
				$ar_i = $i + 1;
				$ar_k = "_{$ar_i}_{$and_key}";
				$pdo_type = $this->getPDOType($and[$ar_k]);
				$stmt->bindValue(":{$ar_k}", $and[$ar_k], $pdo_type);
			}

			for($i = 0; $i < count($or); $i++)
			{
				$ar_i = $i + 1;
				$ar_k = "_{$ar_i}_{$or_key}";
				$pdo_type = $this->getPDOType($or[$ar_k]);
				$stmt->bindValue(":{$ar_k}", $or[$ar_k], $pdo_type);
			}

			return $stmt;
		}

		private function buildInsert($object)
		{

			$class = get_class($object);
			$object = Mapping::toArray($object);

			$sql = 'INSERT INTO `' . $this->table_prefix . $this->class_name . '` (';
			$sql_values = 'VALUES (';	

			end($object);
			$last_key = key($object);

			foreach($object as $key => $value)
			{
				$sql .= "`$key`";
				$sql_values .= ":$key";

				if($key != $last_key)
				{
					$sql .= ', ';
					$sql_values .= ', ';
				}
			}

			$sql .= ')';
			$sql_values .= ')';

			$sql = $sql . ' ' . $sql_values;

			$stmt = $this->db->prepare($sql);

			foreach($object as $key => $value)
			{
				$pdo_type = $this->getPDOType($value);
				$stmt->bindValue(':' . $key, $value, $pdo_type);
			}

			return $stmt;
		}

		private function buildUpdate($object)
		{
			$sql = 'UPDATE `' . $this->table_prefix . $this->class_name . '` SET ';
			$object = Mapping::toArray($object);

			end($object);
			$last_key = key($object);

			foreach($object as $key => $value)
			{
				if($key != 'id')
				{
					$sql .= "`$key` = :$key";
					if($key != $last_key)
					{
						$sql .= ', ';
					}
				}
			}

			$sql .= ' WHERE `id` = :id';

			$stmt = $this->db->prepare($sql);

			foreach($object as $key => $value)
			{
				$pdo_type = $this->getPDOType($value);
				$stmt->bindValue(':' . $key, $value, $pdo_type);
			}
			$stmt->bindValue(':id', $object['id'], PDO::PARAM_INT);
			return $stmt;
		}

		private function buildCompositeUpdate($object, $keys)
		{
			$sql = 'UPDATE `' . $this->table_prefix . $this->class_name . '` SET ';
			$object = Mapping::toArray($object);

			end($object);
			$last_key = key($object);

			foreach($object as $key => $value)
			{
				if($key != 'id'){
					$sql .= "`$key` = :$key";
					if($key != $last_key)
					{
						$sql .= ', ';
					}
				}
			}

			$sql .= ' WHERE ';

			foreach($keys as $key)
			{
				$sql .= "`{$key}` = :key_{$key}";

				if($key != $keys[count($keys) - 1])
				{
					$sql .= " AND ";
				}
			}

			$stmt = $this->db->prepare($sql);

			foreach($object as $key => $value)
			{
				$pdo_type = $this->getPDOType($value);
				$stmt->bindValue(':' . $key, $value, $pdo_type);

			}

			foreach($keys as $key)
			{
				$pdo_type = $this->getPDOType($object[$key]);
				$stmt->bindValue(':key_' . $key, $object[$key], $pdo_type);
			}

			return $stmt;
		}

		private function getPDOType($parameter)
		{
			$type = gettype($parameter);

			if($type == 'string')
			{
				return PDO::PARAM_STR;
			}
			else if($type == 'integer')
			{
				return PDO::PARAM_INT;
			}
		}

		/*::PUBLIC FUNCTIONS::*/
		public function byId($id)
		{
			try
			{
				$query = 'SELECT * FROM `' . $this->table_prefix . $this->class_name . '` WHERE `id` = :id'; 
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(':id', $id, PDO::PARAM_INT);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $ex)
			{
				Logger::log($ex);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}

		public function all(){
			try{
				$query = 'SELECT * FROM `' . $this->table_prefix . $this->class_name . '`'; 
				$stmt = $this->db->prepare($query);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $ex){
				Logger::log($ex);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally{
				return $rows;
			}
		}

		public function delete($props)
		{
			try
			{
				$stmt = $this->buildDelete($props);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $ex)
			{
				Logger::log($ex);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}

		public function byProperty($params){
			try{
				$stmt = $this->buildSelect($params);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $e){
				Logger::log($e);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally{
				return $rows;
			}
		}

		public function buildDelete($props)
		{
			$sql = "DELETE FROM `{$this->table_prefix}{$this->class_name}` WHERE ";

			end($props);
			$last_key = key($props);

			foreach ($props as $key => $value)
			{
				$sql .= "`{$key}` = :{$key}";

				if($last_key != $key)
				{
					$sql .= " AND ";
				}
			}

			$stmt = $this->db->prepare($sql);

			foreach($props as $key => $value)
			{
				$pdo_type = $this->getPDOType($value);
				$stmt->bindValue(":{$key}", $value, $pdo_type);
			}

			return $stmt;
		}

		public function save($object)
		{
			try
			{
				$stmt = $this->buildInsert($object);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $e)
			{
				Logger::log($e);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}

		public function update($object)
		{
			try
			{
				$stmt = $this->buildUpdate($object);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $e)
			{
				Logger::log($e);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}
		
		public function compositeUpdate($object, $keys)
		{
			try
			{
				$stmt = $this->buildCompositeUpdate($object, $keys);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $e)
			{
				Logger::log($e);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}


		public function complexSelect($where, $and, $or)
		{
			try
			{
				$stmt = $this->buildComplexSelect($where, $and, $or);
				$rows = $this->process_query($stmt);
			}
			catch(PDOException $e)
			{
				Logger::log($e);
				$rows['status'] = 0;
				$rows['count'] = 0;
				die('A fatal error occurred.');
			}
			finally
			{
				return $rows;
			}
		}

		public function simpleQuery($sql, $properties)
		{
			$stmt = $this->db->prepare($sql);
			foreach($properties as $i => $property)
			{
				$pdo_type = $this->getPDOType($property);
				$stmt->bindValue(":{$i}", $property, $pdo_type);
			}
			return $this->process_query($stmt);
		}

	/*
		::Return object format::

		===Return Array Format===
		$x['data'] - Rows returned by query
			$x['data'][0] - Row 1
			$x['data'][1] - Row 2
			$x['data'][n] - Row n
		$x['count'] - Count of rows returned by the query
		$x['status'] - Read below
	
		===Status legend===
		0: Failed due to PDO exception
		1: All ok, returned rows
		2: Query ok but no rows to be returned
	
	*/
	}
?>