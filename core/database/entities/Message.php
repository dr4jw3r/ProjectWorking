<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class Message extends BaseEntity implements IEntity
	{
		private $id;
		private $user_from_id;
		private $user_to_id;
		private $date_sent;
		private $subject;
		private $content;
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
				if(isset($args['user_from_id']) && !empty($args['user_from_id'])){
					$this->user_from_id = $args['user_from_id'];
				}
				if(isset($args['user_to_id']) && !empty($args['user_to_id'])){
					$this->user_to_id = $args['user_to_id'];
				}
				if(isset($args['date_sent']) && !empty($args['date_sent'])){
					$this->date_sent = $args['date_sent'];
				}
				if(isset($args['subject']) && !empty($args['subject'])){
					$this->subject = $args['subject'];
				}
				if(isset($args['content']) && !empty($args['content'])){
					$this->content = $args['content'];
				}
				if(isset($args['status'])){
					$this->status = $args['status'];
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
	    public function get_date_sent()
	    {
	        return $this->date_sent;
	    }
	    public function set_date_sent($date_sent)
	    {
	        $this->date_sent = $date_sent;
	    }
	    public function get_subject()
	    {
	        return $this->subject;
	    }
	    public function set_subject($subject)
	    {
	        $this->subject = $subject;
	    }
	    public function get_content()
	    {
	    	return $this->content;
	    }
	    public function set_content($content)
	    {
	    	$this->content = $content;
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