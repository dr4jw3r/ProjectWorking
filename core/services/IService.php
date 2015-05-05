<?php 
	interface IService
	{
		public function byId($id);
		public function byProperty($parameters);
		public function all();
		public function saveOrUpdate($object);
		public function delete($properties);
		public function complexSelect($where, $and, $or);
	}
?>