<?php 
	require_once(realpath("../core_include.php"));

	require_once(SERVICES_DIR . 'UserService.php');

	require_once(MAPPINGS_DIR . 'Mapping.php');

	
	$lang['settings'] = getTranslations('settings');
	$data = sanitize($_POST);	

	$current_user_password = $_SESSION['logged_user']['password'];

	if(password_verify($data['old_password'], $current_user_password))
	{
		if($data['new_password'] === $data['new_password_repeat'])
		{
			$user_service = new UserService();
			$salt = mcrypt_create_iv(64, MCRYPT_DEV_URANDOM);
			$current_user = $user_service->byId($_SESSION['logged_user']['id']);
			$new_password = password_hash($data['new_password'], PASSWORD_DEFAULT, array('salt' => $salt));
			$current_user['password'] = $new_password;
			$current_user['salt'] = $salt;
			$current_user = Mapping::toObject('User', $current_user);
			$user_service->saveOrUpdate($current_user);
			appendSessionSuccess($lang['settings']['password_changed_successfully']);
		}
		else
		{
			appendSessionError($lang['settings']['new_password_mismatch']);
		}
		header("Location: " . PAGES_URL . 'settings.php');	
	}
	else
	{
		appendSessionError($lang['settings']['old_password_incorrect']);
		header("Location: " . PAGES_URL . 'settings.php');
	}


?>