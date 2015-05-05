<?php 
	require_once('BaseEntity.php');
	require_once('IEntity.php');
	require_once('User.php');
	require_once('PersonalDetails.php');
	require_once('DecoratedLanguageSpoken.php');
	require_once('DecoratedLanguageLearn.php');

	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(SERVICES_DIR . 'LanguageSpokenService.php');
	require_once(SERVICES_DIR . 'LanguageLearnService.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');


	class DecoratedUser extends BaseEntity implements IEntity
	{

		private $user;
		private $personal_details;
		private $languages_spoken;
		private $languages_learn;

		public function __construct($user)
		{
			$personal_details_service = new PersonalDetailsService();
			$language_spoken_service = new LanguageSpokenService();
			$languages_learn_service = new LanguageLearnService();

			if(is_array($user))
			{
				$this->user = Mapping::toObject('User', $user);
			}
			else
			{
				$this->user = $user;
			}

			$user_id = $this->user->get_id();
			$pd = $personal_details_service->byProperty(array("user_id" => $user_id));
			$this->personal_details = $pd[0];

			$ls = $language_spoken_service->byProperty(array('user_id' => $user_id));
			$ll = $languages_learn_service->byProperty(array('user_id' => $user_id));

			for($i = 0; $i < count($ls); $i++){ $ls[$i] = new DecoratedLanguageSpoken($ls[$i]); }		
			for($i = 0; $i < count($ll); $i++){ $ll[$i] = new DecoratedLanguageLearn($ll[$i]); }		
		
			$this->languages_spoken = $ls;
			$this->languages_learn = $ll;

		}

		public function get_user()
		{
			return $this->user;
		}
		public function set_user($user)
		{
			$this->user = $user;
		}
		public function get_personal_details()
		{
			return $this->personal_details;
		}
		public function set_personal_details($personal_details)
		{
			$this->personal_details = $personal_details;
		}
		public function get_languages_spoken()
		{
			return $this->languages_spoken;
		}
		public function set_languages_spoken($languages)
		{
			$this->languages_spoken = $languages;
		}
		public function get_languages_learn()
		{
			return $this->languages_learn;
		}
		public function set_languages_learn($languages)
		{
			$this->languages_learn = $languages;
		}

		public function remapToArray()
		{
			$this->user 			= Mapping::toArray($this->user);
			$this->personal_details = Mapping::toArray($this->personal_details);
			
			foreach($this->languages_spoken as $lang){ $lang->remapToArray(); } 
			
			foreach($this->languages_learn as $lang)
			{
				$lang->remapToArray();
			}

			$this->languages_spoken = Mapping::toArray($this->languages_spoken);
			$this->languages_learn 	= Mapping::toArray($this->languages_learn);
		}

		public function get_full_name()
		{
			$first = $this->personal_details->get_first_name();
			$last = $this->personal_details->get_last_name();

			if($last == null)
			{
				$last = "";
			}

			return $first . ' ' . $last;
		}


		/*=:INTERFACE FUNCTIONS:=*/
      	public static function getProps(){
	    	$props = get_class_vars(__CLASS__);
	    	$props = array_keys($props);
	    	return $props;
	    }
	}

?>