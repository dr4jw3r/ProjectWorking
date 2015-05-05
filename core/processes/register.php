<?php 
	require_once('../core_include.php');
	require_once(SERVICES_DIR . 'UserService.php');
	require_once(SERVICES_DIR . 'PersonalDetailsService.php');

	$lang['registration'] = getTranslations('registration');

	if(	isset($_POST['registration_email']) &&
	   	isset($_POST['registration_email_repeat']) && 
		isset($_POST['registration_password']) &&
		isset($_POST['registration_password_repeat']) &&
		isset($_POST['registration_first_name']) &&
		isset($_POST['registration_country_select']) &&
		isset($_POST['registration_city']) &&
		isset($_POST['gender']) &&
		!empty($_POST['registration_email']) &&
		!empty($_POST['registration_email_repeat']) &&
		!empty($_POST['registration_password']) &&
		!empty($_POST['registration_password_repeat']) &&
		!empty($_POST['registration_first_name']) &&
		!empty($_POST['registration_country_select']) &&
		!empty($_POST['registration_city']) &&
		!empty($_POST['gender'])
	)
	{
		if($_POST['registration_email'] == $_POST['registration_email_repeat'] && $_POST['registration_password'] == $_POST['registration_password_repeat']){
			$email = filter_var($_POST['registration_email'], FILTER_SANITIZE_EMAIL);
			$password = $_POST['registration_password'];
			$first_name = filter_var($_POST['registration_first_name'], FILTER_SANITIZE_SPECIAL_CHARS);
			$country_code = filter_var($_POST['registration_country_select'], FILTER_SANITIZE_SPECIAL_CHARS);
			$city = filter_var($_POST['registration_city'], FILTER_SANITIZE_SPECIAL_CHARS);
			if($_POST['gender'] === "1" || $_POST['gender'] === "2"){
				$gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
			}
			else{
				Logger::log("Incorrect gender.");
				die();
			}
		}
		else{
			appendSessionError($lang['registration']['email_pwd_mismatch']);
			header('Location: ' . PAGES_URL . 'registration.php');
		}

		if(isset($email) && isset($password)){
			$user_service = new UserService();
			$personal_details_service = new PersonalDetailsService();

			$user = $user_service->byProperty(array('email' => $email));

			if($user == null){
				$registration_user = $user_service->createNewRegistrationUser(array(
					'email' => $email,
					'password' => $password,
				));

				$saved_user_id = $user_service->saveOrUpdate($registration_user);

				$personal_details = $personal_details_service->createPersonalDetails(array(
					'user_id' => $saved_user_id,
					'first_name' => $first_name,
					'country_code' => $country_code,
					'city' => $city,
					'gender' => $gender
				));

				$personal_details_service->saveOrUpdate($personal_details);

				appendSessionSuccess($lang['registration']['user_created_successfully']);
				header('Location: ' . PAGES_URL . 'index.php');
			}
			else{
				appendSessionError($lang['registration']['usr_already_exists']);
				header('Location: ' . PAGES_URL . 'registration.php');
			}
		}
		else{
			Logger::log('Error during registration.');
			header('Location: ' . PAGES_URL . 'registration.php');
		}
	}
	else{
		appendSessionError($lang['registration']['fill_all_fields']);
		header('Location: ' . PAGES_URL . 'registration.php');
	}
 ?>