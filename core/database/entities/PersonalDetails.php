<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');

	class PersonalDetails extends BaseEntity implements IEntity{

		private $id;
		private $user_id;
		private $first_name;
		private $last_name;
		private $country_code;
		private $city;
		private $age;
		private $gender;
		private $profile_description;

		public function __construct(){
			$num_args = func_num_args();
			
			if($num_args == 1){
				$args = func_get_args();
				$args = $args[0];
				if(isset($args['id']) && !empty($args['id'])){
					$this->id = $args['id'];
				}
				if(isset($args['user_id']) && !empty($args['user_id'])){
					$this->user_id = $args['user_id'];
				}
				if(isset($args['first_name']) && !empty($args['first_name'])){
					$this->first_name = $args['first_name'];
				}
				if(isset($args['last_name']) && !empty($args['last_name'])){
					$this->last_name = $args['last_name'];
				}
				if(isset($args['country_code']) && !empty($args['country_code'])){
					$this->country_code = $args['country_code'];
				}
				if(isset($args['city']) && !empty($args['city'])){
					$this->city = $args['city'];
				}
				if(isset($args['age']) && !empty($args['age'])){
					$this->age = $args['age'];
				}
				if(isset($args['gender']) && !empty($args['gender'])){
					$this->gender = $args['gender'];
				}
			}
		}
	
	    
		/*=:GETTERS AND SETTERS:=*/
	    public function get_id()
	    {
	        return $this->id;
	    }
	    public function set_id($id)
	    {
	        $this->id = $id;
	    }
	    public function get_user_id()
	    {
	        return $this->user_id;
	    }
	    public function set_user_id($user_id)
	    {
	        $this->user_id = $user_id;
	    }
	    public function get_first_name()
	    {
	        return $this->first_name;
	    }
	    public function set_first_name($first_name)
	    {
	        $this->first_name = $first_name;
	    }
	    public function get_last_name()
	    {
	        return $this->last_name;
	    }
	    public function set_last_name($last_name)
	    {
	        $this->last_name = $last_name;
	    }
	    public function get_country_code()
	    {
	        return $this->country_code;
	    }
	    public function set_country_code($country_code)
	    {
	        $this->country_code = $country_code;

	        return $this;
	    }
	    public function get_city()
	    {
	        return $this->city;
	    }
	    public function set_city($city)
	    {
	        $this->city = $city;
	    }
	    public function get_age()
	    {
	        return $this->age;
	    }
	    public function set_age($age)
	    {
	        $this->age = $age;
	    }
	    public function get_gender()
	    {
	        return $this->gender;
	    }
	    public function set_gender($gender)
	    {
	        $this->gender = $gender;
	    }
	    public function get_profile_description(){
	    	return $this->profile_description;
	    }
	    public function set_profile_description($profile_description){
	    	$this->profile_description = $profile_description;
	    }

	    /*=:INTERFACE FUNCTIONS:=*/
	    public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }
	  
}

	/*
	array(
		'user_id' => ,
		'first_name' => '',
		'last_name' => '',
		'country_id' => ,
		'city' => '',
		'age' => ,
		'gender' => 
	)
	*/
?>