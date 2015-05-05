<?php
	require_once('../core_include.php');
	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(ENTITIES_DIR . 'PersonalDetails.php');

	$lang['settings'] = getTranslations('settings');

	$personal_details_service = new PersonalDetailsService();

	$personal_details = $personal_details_service->byProperty(array('user_id' => $_SESSION['logged_user']['id']))[0];

	$_POST['settings_first_name'] != '' ? $personal_details->set_first_name($_POST['settings_first_name']) : null;
	$_POST['settings_last_name'] != '' ? $personal_details->set_last_name($_POST['settings_last_name']) : null;
	$_POST['settings_country'] != '' ? $personal_details->set_country_code($_POST['settings_country']) : null;
	$_POST['settings_city'] != '' ? $personal_details->set_city($_POST['settings_city']) : null;
	$personal_details->set_gender($_POST['gender']);

	if($_POST['settings_age'] != ''){
		$age = filter_var($_POST['settings_age'], FILTER_VALIDATE_INT);
		if($age){
			$personal_details->set_age($age);
		}
		else{
			appendSessionError($lang['settings']['age_format_invalid']);
		}
	}

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