<?php

	function checkLessons()
	{
		require_once(SERVICES_DIR . 'ActiveLessonService.php');
		require_once(SERVICES_DIR . 'LessonRequestService.php');
		require_once(SERVICES_DIR . 'UserService.php');

		require_once(MAPPINGS_DIR . 'Mapping.php');

		$id = $_SESSION['logged_user']['id'];
		$lesson_request_service = new LessonRequestService();

		$where = array('user_to_id' => $id);
		$and = null;
		$or = array('_1_user_from_id' => $id);
		$requests = $lesson_request_service->complexSelect($where, $and, $or);
		$requests = Mapping::toObject('LessonRequest', $requests['data']);

		if($requests != null)
		{
			$today = date('Y-m-d');
			$now = date('H:i:m');
			$in30 = new DateTime('+30 minutes');
			$in30 = $in30->format('H:i:m');

			foreach($requests as $request)
			{
				if($request->get_status() == 0) continue;

				$start_date = $request->get_date();
				$is_today = ($today == $start_date) ? true : false;

				if($is_today)
				{
					$start_time = $request->get_start_time();
					$end_time = $request->get_end_time();
					$is_now = ($start_time <= $now) ? true : false;
					$is_soon = ($start_time <= $in30) ? true : false;
					$is_ended = ($end_time <= $now) ? true : false;

					if($is_ended)
					{
						require_once(SERVICES_DIR . 'LessonRequestArchiveService.php');
						$lras = new LessonRequestArchiveService();
						$request->set_status(4);
						$lra = $lras->reformObject($request);

						$als = new ActiveLessonService();
						$al = $als->byProperty(array('request_id' => $request->get_id()));
						$al = $al[0];
						$lras->saveOrUpdate($lra);
						$delete_params = array('id' => $request->get_id());
						$lesson_request_service->delete($delete_params);
						continue;
					}

					if($is_now || $is_soon)
					{
						$lang['requests_dash'] = getTranslations('requests_dash');
						$html = getTemplate('dashboard_box');
						$content = '';

						if($is_now)
						{
							$user_service = new UserService();
							$als = new ActiveLessonService();

							$user1 = $user_service->byId($request->get_user_from_id());
							$user2 = $user_service->byId($request->get_user_to_id());

							$emails[0] = $user1['email'];
							$emails[1] = $user2['email'];

							sort($emails);

							$hash = md5($emails[0] . $emails[1]);

							$active_lesson = $als->byProperty(array('user_hash' => $hash));

							if($active_lesson == null)
							{
								$lesson_props = array(
									'request_id' => $request->get_id(),
									'user_a_id' => $user1['id'],
									'user_b_id' => $user2['id'],
									'user_hash' => $hash
								);

								$active_lesson = new ActiveLesson($lesson_props);
								$als->saveOrUpdate($active_lesson);
							}
							else
							{
								$active_lesson = $active_lesson[0];
								$room_id = $active_lesson->get_room_id();

								$join_link = "";

								if($room_id == null)
								{
									$join_link = '<a href="%s">%s</a>';
									$url = PAGES_URL . 'learn.php?alh=' . $active_lesson->get_user_hash();

									$join_link = sprintf($join_link, $url, $lang['requests_dash']['join']);
								}
								else
								{
									$join_link = $join_link = '<a href="%s">%s</a>';
									$url = PAGES_URL . 'learn.php' . '?roomid=' . $room_id . '&alh=' . $active_lesson->get_user_hash();
									$join_link = sprintf($join_link, $url, $lang['requests_dash']['join']);
								}
							}

							$request->set_status(3);
							$lesson_request_service->saveOrUpdate($request);

							$lesson_time = new DateTime($start_time);
							$lesson_time = $lesson_time->format('H:i');

							$content_text = sprintf($lang['requests_dash']['lesson_in_progress'], $lesson_time);
							$warn_span = '<span class="icon alert_icon"></span>';
							$content .= "<p class=\"dash_line\">{$warn_span}{$content_text} {$join_link}</p>";
						}		
						else
						{
							if($is_soon)
							{
								$lesson_time = new DateTime($start_time);
								$lesson_time = $lesson_time->format('H:i');
								$content_text = sprintf($lang['requests_dash']['line_text'], $lesson_time);
								$warn_span = '<span class="icon warning_icon"></span>';
								$content .= "<p class=\"dash_line\">{$warn_span}{$content_text}</p>";
							}
						}
						return sprintf($html,
							$lang['requests_dash']['upcoming'],
							$content
						);
					}
				}
			}
		}

	}

?>
