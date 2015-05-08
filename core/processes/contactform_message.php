<?php 

	require_once(realpath('../core_include.php'));
	require_once(SERVICES_DIR . 'MessageService.php');

	$data = sanitize($_POST);

	$subject = $data['message_email'] . ':' . $data['message_subject'];
	$body = $data['body'];

	$message_service = new MessageService();
	$message_properties = array(
		"user_from_id" => -1,
		"user_to_id"   => -1,
		"date_sent"	   => date('Y-m-d H:i:s'),
		"subject"	   => $subject,
		"content"	   => $body,
		"status"	   => 0
	);

	$message = new Message($message_properties);
	$message_service->saveOrUpdate($message);

	appendSessionSuccess('Your message has been sent successfully!');

	redirect(PAGES_URL . 'contact.php');

?>