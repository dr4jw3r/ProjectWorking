<?php 

class Mapping{

	public static function toObject($class_name, $array){
		require_once(ENTITIES_DIR . $class_name . '.php');

		if(array_key_exists('id', $array)){
			$object = new $class_name;
			foreach($array as $key => $value){
				$object->__set($key, $value);
			}
			return $object;
		}
		else{
			$list = array();
			foreach($array as $arr){
				$object = new $class_name;
				foreach($arr as $key => $value){
					$object->__set($key, $value);
				}
				array_push($list, $object);
			}
			return $list;
		}

	}

	public static function toArray($object)
	{
		if($object != null)
		{
			$array = array();

			if(!is_array($object))
			{
				$properties = $object->getProps();
				
				foreach ($properties as $property)
				{
					$array[$property] = $object->__get($property);
				}
			}
			else
			{
				foreach ($object as $single_obj) {

					$properties = $single_obj->getProps();
					$single_arr = array();

					foreach($properties as $property)
					{
						$single_arr[$property] = $single_obj->__get($property);
					}

					array_push($array, $single_arr);
				}
			}
			return $array;
		}
		else
		{
			return null;
		}
	}
}

?>