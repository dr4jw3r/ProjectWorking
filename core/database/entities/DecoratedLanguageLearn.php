<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');
	require_once('User.php');
	require_once('PersonalDetails.php');
	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(SERVICES_DIR . 'LanguageLearnService.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');
	require_once(MAPPINGS_DIR . 'LanguageMapping.php');


	class DecoratedLanguageLearn extends BaseEntity implements IEntity
	{
		private $language_learn;
		private $language_name;

		public function __construct($language_learn)
		{
			$this->language_learn = $language_learn;
			$this->language_name = LanguageMapping::map($this->language_learn->get_language_code());
		}

		public function get_language_learn()
		{
			return $this->language_learn;
		}
		public function set_language_learn($language_learn)
		{
			$this->language_learn = $language_learn;
		}
		public function get_language_name()
		{
			return $this->language_name;
		}
		public function set_language_name($language_name)
		{
			$this->language_name = $language_name;
		}

		public function remapToArray()
		{
			$this->language_learn = Mapping::toArray($this->language_learn);
		}


		/*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }
	}

?>