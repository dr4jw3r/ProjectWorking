<?php
	require_once(realpath('../../core_include.php'));

	require_once(realpath(ENTITIES_DIR . 'DecoratedUser.php'));

	require_once(realpath(SERVICES_DIR . 'UserService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageLearnService.php'));
	require_once(realpath(SERVICES_DIR . 'LanguageSpokenService.php'));

	require_once(realpath(MAPPINGS_DIR . 'Mapping.php'));
	require_once(realpath(MAPPINGS_DIR . 'GenderMapping.php'));
	require_once(realpath(MAPPINGS_DIR . 'CountryMapping.php'));

	$data = sanitize($_POST);
	$function = $data['function'];

	if($function == 'get_users')
	{
		
		$user_service 				= new UserService();
		$language_learn_service 	= new LanguageLearnService();
		$language_spoken_service 	= new LanguageSpokenService();

		$languages_spoken = $data['languages_spoken'];
		$languages_learn = $data['languages_learn'];

		$where 	= array("language_code" => $languages_spoken[0]);
		$and 	= null;
		$or 	= array();


		if(count($languages_spoken > 1))
		{
			for($i = 1; $i < count($languages_spoken); $i++)
			{
				$or["_{$i}_language_code"] = $languages_spoken[$i];
			}
		}
		else
		{
			$or = null;
		}

		$other_learn = $language_learn_service->complexSelect($where, $and, $or);

		$where 	= array("language_code" => $languages_learn[0]);
		$and 	= null;
		$or 	= array();

		if(count($languages_learn > 1))
		{
			for($i = 1; $i < count($languages_learn); $i++)
			{
				$or["_{$i}_language_code"] = $languages_learn[$i];
			}
		}
		else
		{
			$or = null;
		}


		$other_speak = $language_spoken_service->complexSelect($where, $and, $or);

		$other_learn_user_ids = array();
		$other_speak_user_ids = array();

		foreach($other_learn['data'] as $ol)
		{
			array_push($other_learn_user_ids, $ol['user_id']);
		}

		foreach($other_speak['data'] as $os)
		{
			array_push($other_speak_user_ids, $os['user_id']);
		}

		$unique_ids = array_intersect($other_speak_user_ids, $other_learn_user_ids);
		$own_id_index = array_search($_SESSION['logged_user']['id'], $unique_ids);

		if($own_id_index)
		{
			$unique_ids[$own_id_index] = null;
		}

		if(count($unique_ids) != 0)
		{
			$where = array("id" => $unique_ids[0]);
			$and = null;
			$or = array();

			for($i = 1; $i < count($unique_ids); $i++)
			{
				$or["_{$i}_id"] = $unique_ids[$i];
			}

			$search_partners = $user_service->complexSelect($where, $and, $or);
			$search_partners = $search_partners['data'];

			if($search_partners != null)
			{
				for ($i = 0; $i < count($search_partners); $i++)
				{
					$search_partners[$i] = new DecoratedUser($search_partners[$i]);
					$search_partners[$i]->remapToArray();
					$search_partners[$i] = Mapping::toArray($search_partners[$i]);
					$search_partners[$i]['user']['email'] = null;
					$search_partners[$i]['user']['password'] = null;
					$search_partners[$i]['user']['salt'] = null;
					$search_partners[$i]['personal_details']['gender'] = GenderMapping::map($search_partners[$i]['personal_details']['gender']);
					$search_partners[$i]['personal_details']['country_code'] = CountryMapping::map($search_partners[$i]['personal_details']['country_code']);
					$search_partners[$i]['personal_details']['last_name'] = ($search_partners[$i]['personal_details']['last_name'] == null) ? "" : $search_partners[$i]['personal_details']['last_name'];
				}
			}

			echo json_encode($search_partners);
		}
		else
		{
			echo json_encode(array("message" => "no_users", "data" => "null"));
		}


	}
?>