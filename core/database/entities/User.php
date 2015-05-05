<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class User extends BaseEntity implements IEntity
	{

		private $id;
		private $email;
		private $password;
		private $salt;
		private $date_registered;
		private $last_visit;
		private $active;

		public function __construct()
		{
			$num_args = func_num_args();
			
			if($num_args == 1)
			{
				$args = func_get_args();
				$args = $args[0];

				if(isset($args['id']) && !empty($args['id'])){
					$this->id = $args['id'];
				}
				if(isset($args['email']) && !empty($args['email'])){
					$this->email = $args['email'];
				}
				if(isset($args['password']) && !empty($args['password'])){
					$this->password = $args['password'];
				}
				if(isset($args['salt']) && !empty($args['salt'])){
					$this->salt = $args['salt'];
				}
				if(isset($args['date_registered']) && !empty($args['date_registered'])){
					$this->date_registered = $args['date_registered'];
				}
				$this->active = 0;
			}
		}

	    public function get_id()
	    {
	        return $this->id;
	    }
	    public function set_id($id)
	    {
	        $this->id = $id;
	    }
	    public function get_email()
	    {
	        return $this->email;
	    }
	    public function set_email($email)
	    {
	        $this->email = $email;
	    }
	    public function get_password()
	    {
	        return $this->password;
	    }
	    public function set_password($password)
	    {
	        $this->password = $password;
	    }
	    public function get_salt()
	    {
	        return $this->salt;
	    }
	    public function set_salt($salt)
	    {
	        $this->salt = $salt;
	    }
	    public function get_date_registered()
	    {
	        return $this->date_registered;
	    }
	    public function set_date_registered($date_registered)
	    {
	        $this->date_registered = $date_registered;
	    }
	    public function get_last_visit(){
	    	return $this->last_visit;
	    }
	    public function set_last_visit($last_visit){
	    	$this->last_visit = $last_visit;
	    }
	    public function get_active()
	    {
	        return $this->active;
	    }
	    public function set_active($active)
	    {
	        $this->active = $active;
	    }
	    public function get_personal_details(){
	    	return $this->personal_details;
	    }
	    public function set_personal_details($details){
	    	$this->personal_details = $details;
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
		'email' => '',
		'password' => '', 
		'salt' => '',
		'date_registered' => 
		'active' => 
	)
	*/
?>