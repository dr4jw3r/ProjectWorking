<?php 
	require_once('../core_include.php');

	require_once(SERVICES_DIR . 'UserService.php');
	require_once(SERVICES_DIR . 'PersonalDetailsService.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	$lang['login'] = getTranslations('login');

	if(isset($_POST['login_email']) && isset($_POST['login_password']) && !empty($_POST['login_email']) && !empty($_POST['login_password'])){
		$username = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
		$password = $_POST['login_password'];

		$user_service = new UserService();
		$user = $user_service->byProperty(array('email' => $username));
		$user = $user[0];

		if($user != null){

			if(password_verify($password, $user->get_password())){
				// if($user->getActive() == 0){
					// appendSessionError($lang['login']['inactive']);
					// header('Location:' . PAGES_URL);
				// }
				// else{
					$_SESSION['logged_user'] = Mapping::toArray($user);
					session_regenerate_id();
					header('Location: ' . PAGES_URL . 'index.php');
				// }
			}
			else{
				appendSessionError($lang['login']['user_password_incorrect']);
				header('Location: ' . htmlspecialchars($_POST['cur_loc'], ENT_QUOTES));
			}
		}
		else{
			appendSessionError($lang['login']['user_password_incorrect']);
			header('Location: ' . htmlspecialchars($_POST['cur_loc'], ENT_QUOTES));
		}

	}
	else{
		appendSessionError($lang['login']['correct_details']);
		header('Location: ' . htmlspecialchars($_POST['cur_loc'], ENT_QUOTES));
	}
 ?>