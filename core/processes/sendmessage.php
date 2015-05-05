<?php 
	require_once(realpath('../core_include.php'));

	require_once(SERVICES_DIR . 'MessageService.php');

	$data = sanitize($_POST);
	$lang['messages'] = getTranslations('messages');

	$message_data = array(
		'user_from_id' => $_SESSION['logged_user']['id'],
		'user_to_id' => $data['to_id'],
		'date_sent' => date('Y-m-d H:i:s'),
		'subject' => $data['message_subject_input'],
		'content' => $data['message_body_input'],
		'status' => 0
	);

	$message_service = new MessageService();
	$message = new Message($message_data);
	$message_service->saveOrUpdate($message);

	appendSessionSuccess($lang['messages']['message_sent']);
	redirect(PAGES_URL . 'messages.php');
?>