<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class Language extends BaseEntity implements IEntity
	{
		private $id;
		private $code;
		private $name;

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
				if(isset($args['code']) && !empty($args['code'])){
					$this->code = $args['code'];
				}
				if(isset($args['name']) && !empty($args['name'])){
					$this->name = $args['name'];
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
	  	public function get_code()
	  	{
	  		return $this->code;
	  	}
	  	public function set_code($code)
	  	{
	  		$this->code = $code;
	  	}
	  	public function get_name()
	  	{
	  		return $this->name;
	  	}
	  	public function set_name($name)
	  	{
	  		$this->name = $name;
	  	}


	    /*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }

	}
?>