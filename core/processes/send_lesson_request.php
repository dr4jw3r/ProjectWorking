<?php
	require_once(realpath("../core_include.php"));

	pageProtect();

	require_once(SERVICES_DIR . 'LessonRequestService.php');

	$lang['lesson_request'] = getTranslations('lesson_request');
	$data = sanitize($_POST);


	if($data['req_duration_min'] > 0)
	{
		$lesson_request_service = new LessonRequestService();

		$request_params = array(
			"user_from_id" 	=> $_SESSION['logged_user']['id'],
			"user_to_id" 	=> $data['req_user_to_id'],
			"date"			=> date('Y-m-d', strtotime($data['req_date'])),
			"start_time"	=> date('H:i:s', strtotime($data['start_time'])),
			"end_time"		=> date('H:i:s', strtotime($data['end_time'])),
			"duration"		=> $data['req_duration_min'],
			"language_code"	=> $data['language_select'],
			"status"		=> 0
		);

		$lesson_request = new LessonRequest($request_params);
		$lesson_request_service->saveOrUpdate($lesson_request);

		appendSessionSuccess($lang['lesson_request']['req_created_successfully']);
		redirect(PAGES_URL . 'lessons.php');
	}
	else
	{
		appendSessionError($lang['lesson_request']['invalid_duration']);
		$_SESSION['lesson_request_user_to_id'] = $data['req_user_to_id'];
		redirect(PAGES_URL . 'lessonrequest.php');
	}
?>