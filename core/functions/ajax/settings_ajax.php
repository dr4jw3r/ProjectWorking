<?php 

	require_once(realpath("../../core_include.php"));
	require_once(ENTITIES_DIR . "LanguageSpoken.php");
	require_once(ENTITIES_DIR . "LanguageLearn.php");
	require_once(SERVICES_DIR . "LanguageSpokenService.php");
	require_once(SERVICES_DIR . "LanguageLearnService.php");

	$data = sanitize($_POST);	

	$function = $data['function'];

	if($function == 'add_language')
	{
		$language_spoken_service = new LanguageSpokenService();

		$lang_data = array(
			'user_id' => $_SESSION['logged_user']['id'],
			'language_code' => $data['language'],
			'level' => $data['level']
		);

		$language_spoken = new LanguageSpoken($lang_data);

		$language_spoken_service->saveOrUpdate($language_spoken);
	}
	else if($function == 'remove_language')
	{
		$language_spoken_service = new LanguageSpokenService();

		$lang_data = array(
			'user_id' => $_SESSION['logged_user']['id'],
			'language_code' => $data['language'],
		);

		$language_spoken_service->delete($lang_data);
	}
	else if($function == 'add_language_to_learn')
	{
		$language_learn_service = new LanguageLearnService();

		$lang_data = array(
			'user_id' => $_SESSION['logged_user']['id'],
			'language_code' => $data['language']
		);

		$language_learn = new LanguageLearn($lang_data);

		$language_learn_service->saveOrUpdate($language_learn);
	}
	else if($function == 'remove_language_to_learn')
	{
		$language_learn_service = new LanguageLearnService();

		$lang_data = array(
			'user_id' => $_SESSION['logged_user']['id'],
			'language_code' => $data['language'],
		);

		$language_learn_service->delete($lang_data);
	}

 ?>