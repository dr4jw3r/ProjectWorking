<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class LanguageLearnService implements IService{

		private $repo;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->repo = new Repository('LanguageLearn');
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
				$data['data'] = Mapping::toObject('LanguageLearn', $data['data']);
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

			$query_properties = array(
				'user_id' => $_SESSION['logged_user']['id'],
				'language_code' => $details->get_language_code()
			);

			$language = $this->byProperty($query_properties);

			if($language == null){
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

	}
?>