<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class LessonRequestService implements IService{

		private $repo;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->repo = new Repository('LessonRequest');
		}

		/*::PRIVATE FUNCTIONS::*/

		/*::PUBLIC FUNCTIONS::*/
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
				$data['data'] = Mapping::toObject('LessonRequest', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function all(){
			$data = $this->repo->all();
			if($data['status'] == 1 && $data['count'] > 0){
				$data['data'] = Mapping::toObject('LessonRequest', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function saveOrUpdate($lesson_request){

			$id = $lesson_request->get_id();

			if($id == null || $id == -1 || $id == 0){
				$r = $this->repo->save($lesson_request);
				return $r['data'];
			}
			else{
				$r = $this->repo->update($lesson_request);
				return $r['data'];
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

		public function generateDashboardBox()
		{
			$lang['index'] = getTranslations('index');

			$template = "<div class=\"dash_item_wrap\">
							<div class=\"dash_item_header\">%s</div>
							<div class=\"dash_item_content\">%s&nbsp;
								<span style=\"color:#00F;\">%s&nbsp;</span>
								%s
								<br/><br/>
								%s&nbsp;%s
								<br/><br/>
								%s&nbsp;%s
								<br/><br/>
								%s&nbsp;%s
								<br/><br/>
								%s
							</div>
						</div>";

			$requests = $this->byProperty(array("user_to_id" => $_SESSION['logged_user']['id']));

			if($requests != null)
				{
				$total_count = count($requests);
				$pending_count = 0;
				$accepted_count = 0;
				$rejected_count = 0;

				foreach($requests as $request)
				{
					$status = $request->get_status();
					if($status == 1)
					{
						$accepted_count++;
					}
					else if($status == 2)
					{
						$rejected_count++;
					}
					else if($status == 0)
					{
						$pending_count++;
					}
				}

				$total_count = "<span style=\"color:#00F;text-shadow:1px 1px 1px #000;\">{$total_count}</span>";
				$pending_count = "<span style=\"color:#FF0;text-shadow:1px 1px 1px #000;\">{$pending_count}</span>";
				$accepted_count = "<span style=\"color:#0F0;text-shadow:1px 1px 1px #000;\">{$accepted_count}</span>";
				$rejected_count = "<span style=\"color:#F00;text-shadow:1px 1px 1px #000;\">{$rejected_count}</span>";

				$requests_link = '<a href="' . PAGES_URL . 'lessons.php' . '">' . $lang['index']['lessons_page'] . '</a>';

				echo sprintf($template, 
					$lang['index']['lesson_requests'],
					$lang['index']['you_have'],
					$total_count,
					$lang['index']['requests'],
					$pending_count,
					$lang['index']['pending'],
					$accepted_count,
					$lang['index']['accepted'],
					$rejected_count,
					$lang['index']['rejected'],
					$requests_link
				);
			}
			else
			{
				$href = PAGES_URL . 'lessons.php';
				$template = "<div class=\"dash_item_wrap\">
								<div class=\"dash_item_header\">%s</div>
								<div class=\"dash_item_content\">%s <a href=\"{$href}\">%s</a></div>
							</div>";
				echo sprintf($template,
					$lang['index']['lesson_requests'],
					$lang['index']['you_have_no'],
					$lang['index']['lesson_requests_lc']
				);
			}
		}

	}
?>