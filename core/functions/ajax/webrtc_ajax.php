<?php

	// require_once('/var/www/html/core/core_include.php');
	require_once('/opt/lampp/htdocs/Project/core/core_include.php');
	require_once(SERVICES_DIR . 'ActiveLessonService.php');

	$data = sanitize($_POST);
	$function = $data['function'];

	if($function == 'save_room_id')
	{
		$room_id = $data['room_id'];
		$als = new ActiveLessonService();

		$active_lesson = $als->byProperty(array('user_hash' => $data['alh']));
		
		if($active_lesson != null)
		{
			$active_lesson = $active_lesson[0];
			$active_lesson->set_room_id($room_id);
			$als->saveOrUpdate($active_lesson);
			echo 'success';
		}
		else
		{
			die('FATAL ERROR');
		}
	}


?>
