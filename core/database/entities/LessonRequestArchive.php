<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class LessonRequestArchive extends BaseEntity implements IEntity
	{
		private $id;
		private $request_id;
		private $user_from_id;
		private $user_to_id;
		private $date;
		private $start_time;
		private $end_time;
		private $duration;
		private $language_code;
		private $status;

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
				if(isset($args['user_from_id']) && !empty($args['user_from_id'])){
					$this->user_from_id = $args['user_from_id'];
				}
				if(isset($args['user_to_id']) && !empty($args['user_to_id'])){
					$this->user_to_id = $args['user_to_id'];
				}
				if(isset($args['date']) && !empty($args['date'])){
					$this->date = $args['date'];
				}
				if(isset($args['start_time']) && !empty($args['start_time'])){
					$this->start_time = $args['start_time'];
				}
				if(isset($args['end_time']) && !empty($args['end_time'])){
					$this->end_time = $args['end_time'];
				}
				if(isset($args['duration']) && !empty($args['duration'])){
					$this->duration = $args['duration'];
				}
				if(isset($args['language_code']) && !empty($args['language_code'])){
					$this->language_code = $args['language_code'];
				}
				if(isset($args['status'])){
					$this->status = $args['status'];
				}
						
			}
		}

		public static function get_status_string($status)
		{
			switch ($status) {
				case 0:
					return 'PENDING';
					break;
				case 1:
					return 'ACCEPTED';
					break;
				case 2:
					return 'REFUSED';
					break;
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
	    public function get_user_from_id()
	    {
	        return $this->user_from_id;
	    }
	    public function set_user_from_id($user_from_id)
	    {
	        $this->user_from_id = $user_from_id;
	    }
	    public function get_user_to_id()
	    {
	        return $this->user_to_id;
	    }
	    public function set_user_to_id($user_to_id)
	    {
	        $this->user_to_id = $user_to_id;
	    }
	    public function get_date()
	    {
	        return $this->date;
	    }
	    public function set_date($date)
	    {
	        $this->date = $date;
	    }
	    public function get_start_time()
	    {
	        return $this->start_time;
	    }
	    public function set_start_time($start_time)
	    {
	        $this->start_time = $start_time;
	    }
	    public function get_end_time()
	    {
	        return $this->end_time;
	    }
	    public function set_end_time($end_time)
	    {
	        $this->end_time = $end_time;
	    }
	    public function get_duration()
	    {
	        return $this->duration;
	    }
	    public function set_duration($duration)
	    {
	        $this->duration = $duration;
	    }
	    public function get_language_code()
	    {
	        return $this->language_code;
	    }
	    public function set_language_code($language_code)
	    {
	        $this->language_code = $language_code;
	    }
	    public function get_status()
	    {
	        return $this->status;
	    }
	    public function set_status($status)
	    {
	        $this->status = $status;
	    }
	  	


	    /*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }

	}
?>