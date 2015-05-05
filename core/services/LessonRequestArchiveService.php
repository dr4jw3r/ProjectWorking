<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class LessonRequestArchiveService implements IService{

		private $repo;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->repo = new Repository('LessonRequestArchive');
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
				$data['data'] = Mapping::toObject('LessonRequestArchive', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function all(){
			$data = $this->repo->all();
			if($data['status'] == 1 && $data['count'] > 0){
				$data['data'] = Mapping::toObject('LessonRequestArchive', $data['data']);
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

		public function reformObject($request)
		{
			$lra = new LessonRequestArchive();
			$lra->set_request_id($request->get_id());
			$lra->set_user_from_id($request->get_user_from_id());
			$lra->set_user_to_id($request->get_user_to_id());
			$lra->set_date($request->get_date());
			$lra->set_start_time($request->get_start_time());
			$lra->set_end_time($request->get_end_time());
			$lra->set_duration($request->get_duration());
			$lra->set_language_code($request->get_language_code());
			$lra->set_status($request->get_status());
			return $lra;
		}

	}
?>