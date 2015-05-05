<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');


	class LanguageLearn extends BaseEntity implements IEntity
	{
		private $user_id;
		private $language_code;

		public function __construct()
		{
			$num_args = func_num_args();
			
			if($num_args == 1)
			{
				$args = func_get_args();
				$args = $args[0];

				if(isset($args['user_id']) && !empty($args['user_id'])){
					$this->user_id = $args['user_id'];
				}
				if(isset($args['language_code']) && !empty($args['language_code'])){
					$this->language_code = $args['language_code'];
				}
			}
		}

	    public function get_user_id()
	    {
	        return $this->user_id;
	    }
	    public function set_user_id($user_id)
	    {
	        $this->user_id = $user_id;
	    }
	    public function get_language_code()
	    {
	    	return $this->language_code;
	    }
	    public function set_language_code($code)
	    {
	    	$this->language_code = $code;
	    }

	    /*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }

	}
?>