<?php 
	require_once(realpath("../../core_include.php"));

	require_once(ENTITIES_DIR . 'DecoratedUser.php');

	require_once(SERVICES_DIR . 'LessonRequestService.php');
	require_once(SERVICES_DIR . 'LessonRequestArchiveService.php');
	require_once(SERVICES_DIR . 'UserService.php');

	require_once(MAPPINGS_DIR . 'Mapping.php');
	require_once(MAPPINGS_DIR . 'LanguageMapping.php');

	pageProtect();

	$data = sanitize($_POST);

	if($data['function'] == 'get_requests')
	{
		$lesson_request_service = new LessonRequestService();
		$requests = $lesson_request_service->byProperty(array('user_to_id' => $_SESSION['logged_user']['id']));

		if($requests != null)
		{
			$user_ids = array();
		
			for($i = 0; $i < count($requests); $i++)
			{
				array_push($user_ids, $requests[$i]->get_user_from_id());
				$requests[$i]->set_date(date('d-m-Y', strtotime($requests[$i]->get_date())));
				$requests[$i]->set_start_time(date('H:i', strtotime($requests[$i]->get_start_time())));
				$requests[$i]->set_end_time(date('H:i', strtotime($requests[$i]->get_end_time())));
				$requests[$i]->set_language_code(LanguageMapping::map($requests[$i]->get_language_code()));
				$requests[$i] = Mapping::toArray($requests[$i]);
			}

			$user_ids = array_unique($user_ids);
			$user_service = new UserService();
			
			$where = array('id' => $user_ids[0]);
			$and = null;
			$or = array();

			if(count($user_ids > 1))
			{
				for($i = 1; $i < count($user_ids); $i++)
				{
					$or["_{$i}_id"] = $user_ids[$i];
				}
			}
			else
			{
				$or = null;
			}

			$users = $user_service->complexSelect($where, $and, $or);
			$users = $users['data'];

			for($i = 0; $i < count($users); $i++)
			{
				$users[$i] = new DecoratedUser($users[$i]);
				$users[$i]->get_user()->set_password(null);
				$users[$i]->get_user()->set_salt(null);
				$users[$i]->remapToArray();
				$users[$i] = Mapping::toArray($users[$i]);
			}

			$response = array(
				'users' => $users,
				'requests' => $requests
			);

			echo json_encode($response);
		}
		else{
			echo json_encode('null');			
		}
	}
	else if($data['function'] == 'change_status')
	{
		$lesson_request_service = new LessonRequestService();
		$request = Mapping::toObject('LessonRequest', $lesson_request_service->byId($data['request_id']));
		$request->set_status($data['status']);
		$lesson_request_service->saveOrUpdate($request);
		echo json_encode(array('id' => $data['request_id'], 'status' => $data['status']));
	}
	else if($data['function'] == 'get_sent')
	{
		$lesson_request_service = new LessonRequestService();
		$query_props = array('user_from_id' => $_SESSION['logged_user']['id']);
		$requests = $lesson_request_service->byProperty($query_props);

		if($requests == null)
		{
			echo json_encode('null');
		}
		else
		{
			$user_ids = array();
		
			for($i = 0; $i < count($requests); $i++)
			{
				array_push($user_ids, $requests[$i]->get_user_to_id());
				$requests[$i]->set_date(date('d-m-Y', strtotime($requests[$i]->get_date())));
				$requests[$i]->set_start_time(date('H:i', strtotime($requests[$i]->get_start_time())));
				$requests[$i]->set_end_time(date('H:i', strtotime($requests[$i]->get_end_time())));
				$requests[$i]->set_language_code(LanguageMapping::map($requests[$i]->get_language_code()));
				$requests[$i] = Mapping::toArray($requests[$i]);
			}

			$user_ids = array_unique($user_ids);
			$user_service = new UserService();
			
			$where = array('id' => $user_ids[0]);
			$and = null;
			$or = array();

			if(count($user_ids > 1))
			{
				for($i = 1; $i < count($user_ids); $i++)
				{
					$or["_{$i}_id"] = $user_ids[$i];
				}
			}
			else
			{
				$or = null;
			}

			$users = $user_service->complexSelect($where, $and, $or);
			$users = $users['data'];

			for($i = 0; $i < count($users); $i++)
			{
				$users[$i] = new DecoratedUser($users[$i]);
				$users[$i]->get_user()->set_password(null);
				$users[$i]->get_user()->set_salt(null);
				$users[$i]->remapToArray();
				$users[$i] = Mapping::toArray($users[$i]);
			}

			$response = array(
				'users' => $users,
				'requests' => $requests
			);

			echo json_encode($response);
		}
	}
	else if($data['function'] == 'get_archived')
	{
		$lras = new LessonRequestArchiveService();
		$requests = $lras->byProperty(array('user_to_id' => $_SESSION['logged_user']['id']));

		if($requests != null)
		{
			$user_ids = array();
		
			for($i = 0; $i < count($requests); $i++)
			{
				array_push($user_ids, $requests[$i]->get_user_to_id());
				$requests[$i]->set_date(date('d-m-Y', strtotime($requests[$i]->get_date())));
				$requests[$i]->set_start_time(date('H:i', strtotime($requests[$i]->get_start_time())));
				$requests[$i]->set_end_time(date('H:i', strtotime($requests[$i]->get_end_time())));
				$requests[$i]->set_language_code(LanguageMapping::map($requests[$i]->get_language_code()));
				$requests[$i] = Mapping::toArray($requests[$i]);
			}

			$user_ids = array_unique($user_ids);

			$user_service = new UserService();
			
			$where = array('id' => $user_ids[0]);
			$and = null;
			$or = array();

			if(count($user_ids > 1))
			{
				for($i = 1; $i < count($user_ids); $i++)
				{
					$or["_{$i}_id"] = $user_ids[$i];
				}
			}
			else
			{
				$or = null;
			}

			$users = $user_service->complexSelect($where, $and, $or);
			$users = $users['data'];

			for($i = 0; $i < count($users); $i++)
			{
				$users[$i] = new DecoratedUser($users[$i]);
				$users[$i]->get_user()->set_password(null);
				$users[$i]->get_user()->set_salt(null);
				$users[$i]->remapToArray();
				$users[$i] = Mapping::toArray($users[$i]);
			}

			$response = array(
				'users' => $users,
				'requests' => $requests
			);

			echo json_encode($response);
		}
		else{
			echo json_encode('null');			
		}

	}

?>