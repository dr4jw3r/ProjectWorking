<?php 
	require_once(realpath('../../core_include.php'));

	require_once(SERVICES_DIR . 'MessageService.php');

	require_once(MAPPINGS_DIR . 'Mapping.php');

	$data = sanitize($_POST);	

	$function = $data['function'];

	$message_service = new MessageService();

	if($function == 'message_status_change')
	{
		$message = Mapping::toObject('Message', $message_service->byId($data['message_id']));
		$message->set_status($data['status']);
		$message_service->saveOrUpdate($message);
	}

?>