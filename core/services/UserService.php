<?php 

	require_once('IService.php');
	require_once(REPO_DIR . 'Repository.php');
	require_once(MAPPINGS_DIR . 'Mapping.php');

	class UserService implements IService{

		private $user_repository;

		/*::CONSTRUCTOR::*/
		public function __construct(){
			$this->user_repository = new Repository('User');
		}

		/*::PRIVATE FUNCTIONS::*/

		/*::PUBLIC FUNCTIONS::*/
		public function createNewRegistrationUser($params){
			$params['salt'] = mcrypt_create_iv(64, MCRYPT_DEV_URANDOM);
			$params['password'] = password_hash($params['password'], PASSWORD_DEFAULT, array('salt' => $params['salt']));
			$user = new User($params);
			return $user;
		}

		public function byId($id){
			$data = $this->user_repository->byId($id);
			if($data['status'] == 1 && $data['count'] == 1){
				return $data['data'][0];
			}
			else{
				return null;
			}
		}

		public function byProperty($params){
			$data = $this->user_repository->byProperty($params);

			if($data['status'] == 1 && $data['count'] > 0){
				$data['data'] = Mapping::toObject('User', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function all(){
			$data = $this->user_repository->all();
			if($data['status'] == 1 && $data['count'] > 0){
				$data['data'] = Mapping::toObject('User', $data['data']);
				return $data['data'];
			}
			else{
				return null;
			}
		}

		public function saveOrUpdate($user){

			$id = $user->get_id();

			if($id == null || $id == -1 || $id == 0){
				$r = $this->user_repository->save($user);
				return $r['data'];
			}
			else{
				$r = $this->user_repository->update($user);
				return $r['data'];
			}
		}

		public function delete($props)
		{
			return $this->user_repository->delete($props);
		}

		public function complexSelect($where = null, $and = null, $or = null)
		{
			return $this->user_repository->complexSelect($where, $and, $or);
		}

	}
?>