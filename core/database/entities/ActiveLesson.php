<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class ActiveLesson extends BaseEntity implements IEntity
	{

		private $id;
		private $request_id;
		private $user_a_id;
		private $user_b_id;
		private $user_hash;
		private $room_id;

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
				if(isset($args['request_id']) && !empty($args['request_id'])){
					$this->request_id = $args['request_id'];
				}
				if(isset($args['user_a_id']) && !empty($args['user_a_id'])){
					$this->user_a_id = $args['user_a_id'];
				}
				if(isset($args['user_b_id']) && !empty($args['user_b_id'])){
					$this->user_b_id = $args['user_b_id'];
				}
				if(isset($args['user_hash']) && !empty($args['user_hash'])){
					$this->user_hash = $args['user_hash'];
				}
				if(isset($args['room_id']) && !empty($args['room_id'])){
					$this->room_id = $args['room_id'];
				}
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
	    public function get_request_id()
	    {
	        return $this->request_id;
	    }
	    public function set_request_id($request_id)
	    {
	        $this->request_id = $request_id;
	    }
	    public function get_user_a_id()
	    {
	        return $this->user_a_id;
	    }
	    public function set_user_a_id($user_a_id)
	    {
	        $this->user_a_id = $user_a_id;
	    }
	    public function get_user_b_id()
	    {
	        return $this->user_b_id;
	    }
	    public function set_user_b_id($user_b_id)
	    {
	        $this->user_b_id = $user_b_id;
	    }
	    public function get_user_hash()
	    {
	        return $this->user_hash;
	    }
	    public function set_user_hash($user_hash)
	    {
	        $this->user_hash = $user_hash;
	    }
	    public function get_room_id(){
	    	return $this->room_id;
	    }
	    public function set_room_id($room_id){
	    	$this->room_id = $room_id;
	    }

	    /*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }

	}

?>