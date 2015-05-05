<?php 
	require_once('../core_include.php');
	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(ENTITIES_DIR . 'PersonalDetails.php');

	$lang['settings'] = getTranslations('settings');

	$personal_details_service = new PersonalDetailsService();
	$personal_details = $personal_details_service->byProperty(array('user_id' => $_SESSION['logged_user']['id']))[0];

	$_POST['profile_desc'] != '' ? $personal_details->set_profile_description($_POST['profile_desc']) : null;

	$success = $personal_details_service->saveOrUpdate($personal_details);

	if($success['status'] == 1){
		appendSessionSuccess($lang['settings']['settings_saved_successfully']);
		header('Location:' . PAGES_URL . 'settings.php');
	}
	else{
		appendSessionError($lang['settings']['settings_save_error']);
		header('Location:' . PAGES_URL . 'settings.php');
	}


?>