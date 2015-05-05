<?php 
	class Database{
		
		private static $connection;
		private static $table_prefix;

		private function __construct(){}

		public static function getInstance(){

			$config = parse_ini_file('config.ini');
			self::$table_prefix = $config['prefix'];
			if(self::$connection == null){
				self::$connection = self::openConnection($config);				
			}
			return self::$connection;
		}

		public function closeConnection(){
			self::$connection = null;
		}

		public static function getPrefix(){
			return self::$table_prefix;
		}
		
		private static function openConnection($config){
			$con = null;
			$dsl = "mysql:host=" . $config['hostname'] . ";dbname=" . $config['database'] . ";charset=utf8";
			try{
				$con = new PDO(
						$dsl,
						$config['username'],
						$config['password']
				);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch(PDOException $ex){			
				Logger::log($ex);
				die('A fatal error occurred.');
			}
			return $con;
		}

	}
?>