<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');
	require_once('User.php');
	require_once('PersonalDetails.php');

	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(SERVICES_DIR . 'LanguageSpokenService.php');

	require_once(MAPPINGS_DIR . 'Mapping.php');
	require_once(MAPPINGS_DIR . 'LanguageMapping.php');
	require_once(MAPPINGS_DIR . 'ProficiencyMapping.php');


	class DecoratedLanguageSpoken extends BaseEntity implements IEntity
	{
		private $language_spoken;
		private $language_name;
		private $language_level_string;

		public function __construct($language_spoken)
		{
			$this->language_spoken = $language_spoken;
			$this->language_name = LanguageMapping::map($this->language_spoken->get_language_code());
			$this->language_level_string = ProficiencyMapping::map($this->language_spoken->get_level());
		}

		public function get_language_spoken()
		{
			return $this->language_spoken;
		}
		public function set_language_spoken($language_spoken)
		{
			$this->language_spoken = $language_spoken;
		}
		public function get_language_name()
		{
			return $this->language_name;
		}
		public function set_language_name($language_name)
		{
			$this->language_name = $language_name;
		}
		public function get_language_level_string()
		{
			return $this->language_level_string;
		}
		public function set_language_level_string($language_level_string)
		{
			$this->language_level_string = $language_level_string;
		}

		public function remapToArray()
		{
			$this->language_spoken = Mapping::toArray($this->language_spoken);
		}


		/*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }
	}

?>