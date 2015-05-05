<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');
	require_once(ENTITIES_DIR . 'PersonalDetails.php');

	class PersonalDetailsService implements IService{

		private $repo;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->repo = new Repository('PersonalDetails');
		}

		/*::PRIVATE FUNCTIONS::*/

		/*::PUBLIC FUNCTIONS::*/
		public static function createPersonalDetails($details){
			if(is_array($details)){

				$details['id'] = '';

				$pd = new PersonalDetails();
				$pd = Mapping::toObject('PersonalDetails', $details);

				return $pd;
			}			
			else{
				echo "ARRAY REQUIRED";
				die();
			}
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
				$data['data'] = Mapping::toObject('PersonalDetails', $data['data']);
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

			if($id == null || $id == -1 || $id == 0){
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