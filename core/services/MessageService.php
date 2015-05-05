<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class MessageService implements IService{

		private $repo;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->repo = new Repository('Message');
		}

		/*::PRIVATE FUNCTIONS::*/

		/*::PUBLIC FUNCTIONS::*/

		public function generateInbox()
		{
			$sql = "SELECT * FROM LangExchange_Message WHERE `user_to_id` = :0 AND `status` = 0 OR `status` = 1;";
			$properties = array($_SESSION['logged_user']['id']);
			$messages = $this->simpleQuery($sql, $properties);
			$messages = Mapping::toObject('Message', $messages['data']);

			if($messages == null)
			{
				$lang['messages'] = getTranslations('messages');

				echo '<div class="warning">';
				echo $lang['messages']['no_messages'];
				echo '</div>';				
			}
			else
			{
				require_once(SERVICES_DIR . 'UserService.php');
				require_once(ENTITIES_DIR . 'DecoratedUser.php');
				$user_service = new UserService();
				$template = getTemplate('message_line');

				$html = '';

				foreach($messages as $message)
				{
					$status = ($message->get_status() == 0) ? 'unread' : '';
					$user = $user_service->byId($message->get_user_from_id());
					$user = new DecoratedUser($user);

					$date_string = strtotime($message->get_date_sent());
					$date_day = date('d-m-Y', $date_string);
					$date_hr = date('H:i:s', $date_string);

					$html .= sprintf($template,
						$status,
						$user->get_full_name(),
						$date_day,
						$date_hr,
						$message->get_subject(),
						$message->get_content(),
						$message->get_user_from_id(),
						$message->get_id()
					);
				}

				echo $html;
			}
		}

		public function generateSentbox()
		{
			$sql = "SELECT * FROM `LangExchange_Message` WHERE `user_from_id` = :0 AND `status` != 2";
			$props = array($_SESSION['logged_user']['id']);

			$messages = $this->simpleQuery($sql, $props);
			$messages = Mapping::toObject('Message', $messages['data']);

			if($messages == null)
			{
				$lang['messages'] = getTranslations('messages');

				echo '<div class="warning">';
				echo $lang['messages']['no_messages'];
				echo '</div>';				
			}
			else
			{
				require_once(SERVICES_DIR . 'UserService.php');
				require_once(ENTITIES_DIR . 'DecoratedUser.php');
				$user_service = new UserService();
				$template = getTemplate('message_line');

				$html = '';

				foreach($messages as $message)
				{
					$user = $user_service->byId($message->get_user_from_id());
					$user = new DecoratedUser($user);

					$date_string = strtotime($message->get_date_sent());
					$date_day = date('d-m-Y', $date_string);
					$date_hr = date('H:i:s', $date_string);

					$html .= sprintf($template,
						'',
						$user->get_full_name(),
						$date_day,
						$date_hr,
						$message->get_subject(),
						$message->get_content(),
						$message->get_user_from_id(),
						$message->get_id()
					);
				}

				echo $html;
			}
		}

		public function generateTrashbox()
		{
			$sql = "SELECT * FROM `LangExchange_Message` WHERE `user_to_id` = :0 AND `status` = 2";
			$props = array(
				$_SESSION['logged_user']['id']
			);
			$messages = $this->simpleQuery($sql, $props);

			$sql = "SELECT * FROM `LangExchange_Message` WHERE `user_from_id` = :0 AND `status` = 2";
			$messages2 = $this->simpleQuery($sql, $props);

			$messages = Mapping::toObject('Message', $messages['data']);
			$messages2 = Mapping::toObject('Message', $messages2['data']);

			$messages = array_merge($messages, $messages2);

			if($messages == null)
			{
				$lang['messages'] = getTranslations('messages');

				echo '<div class="warning">';
				echo $lang['messages']['no_messages'];
				echo '</div>';				
			}
			else
			{
				require_once(SERVICES_DIR . 'UserService.php');
				require_once(ENTITIES_DIR . 'DecoratedUser.php');
				$user_service = new UserService();
				$template = getTemplate('message_line');

				$html = '';

				foreach($messages as $message)
				{
					$user = $user_service->byId($message->get_user_from_id());
					$user = new DecoratedUser($user);

					$date_string = strtotime($message->get_date_sent());
					$date_day = date('d-m-Y', $date_string);
					$date_hr = date('H:i:s', $date_string);

					$html .= sprintf($template,
						'',
						$user->get_full_name(),
						$date_day,
						$date_hr,
						$message->get_subject(),
						$message->get_content(),
						$message->get_user_from_id(),
						$message->get_id()
					);
				}

				echo $html;
			}
		}

		public function generateDashboardBox()
		{
			$messages_href = PAGES_URL . 'messages.php';
			$template = "<div class=\"dash_item_wrap\">
							<div class=\"dash_item_header\">%s</div>
							<div class=\"dash_item_content\">
								%s %s %s <a href=\"{$messages_href}\">%s</a>
							</div>
						</div>";

			$lang['index'] = getTranslations('index');

			$where = array('user_to_id' => $_SESSION['logged_user']['id']);
			$and = array('_1_status' => 0);
			$or = null;
			
			$messages = $this->complexSelect($where, $and, $or);

			echo sprintf($template,
				$lang['index']['messages'],
				$lang['index']['you_have'],
				count($messages['data']),
				$lang['index']['new'],
				$lang['index']['messages_lc']
			);
		}
	
		public function byId($id){
			$data = $this->repo->byId($id);
			if($data['status'] == 1 && $data['count'] == 1){
				return $data['data'][0];
			}
			else{
				return null;
			}
		}

		public function byProperty($params){
			$data = $this->repo->byProperty($params);
			if($data['status'] == 1 && $data['count'] > 0){
				$data['data'] = Mapping::toObject('Message', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function all(){
			$data = $this->repo->all();
			if($data['status'] == 1 && $data['count'] > 0){
				echo "UNIMPLEMENTED";
			}
			else{
				return null;
			}
		}

		public function saveOrUpdate($details){

			$id = $details->get_id();

			if($id == null){
				return $this->repo->save($details);
			}
			else{
				return $this->repo->update($details);
			}
		}

		public function delete($props)
		{
			return $this->repo->delete($props);
		}

		public function complexSelect($where = null, $and = null, $or = null)
		{
			return $this->repo->complexSelect($where, $and, $or);
		}

		public function simpleQuery($sql, $props)
		{
			return $this->repo->simpleQuery($sql, $props);
		}

	}

	/*
		status:
		0 - unread
		1 - read
		2 - trash
	*/
?>