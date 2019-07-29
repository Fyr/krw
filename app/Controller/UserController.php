<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');
// App::uses('PHForm', 'Form.View/Helper');
class UserController extends AppController {
	public $name = 'User';
	public $layout = 'userarea';
	public $uses = array('User');
	// public $helpers = array('Form.PHForm');
	
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
		// return $this->redirect(array('controller' => 'Timeline', 'action' => 'index'));
	}
	
	public function edit() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data('User.user_id', $this->currUserID);
			if ($this->request->data('UserAchievement')) {
				foreach($this->request->data('UserAchievement') as $i => $data) {
					$url = $this->request->data('UserAchievement.'.$i.'.url');
					$url = (strpos($url, 'http://') === false) ? 'http://'.$url : $url;
					$this->request->data('UserAchievement.'.$i.'.url', $url);
				}
			}
			$this->User->saveAll($this->request->data);
			return $this->redirect(array('controller' => $this->name, 'action' => 'edit', '?' => array('success' => '1')));
		} else {
			$this->request->data = $this->currUser;
		}
		
		$this->set('aTimezoneOptions', $this->Timezone->options());
		$this->set('aCountryOptions', $this->Country->options());
	}

	public function view($id = 0) {
		$this->loadModel('GroupMember');
		// $this->loadModel('Article');
		if (!$id) {
			$id = $this->currUserID;
		}
		$this->set('user', $this->User->getUser($id));
		$aGroups = $this->GroupMember->getUserGroups($id);
		foreach($aGroups as &$group) {
			$group_id = $group['Group']['id'];
			// $aGroupMembers[$group_id] = Hash::extract($this->GroupMember->getList($group_id), '{n}.GroupMember.user_id');
			$group['Group']['members'] = count(Hash::extract($this->GroupMember->getList($group_id), '{n}.GroupMember.user_id'));
		}
		$this->set('aGroups', $aGroups);
		$this->set('aCountryOptions', $this->Country->options());
		
		$this->set('aArticles', $this->Article->findAllByOwnerIdAndPublished($id, 1));
		$this->set('aCategoryOptions', $this->ArticleCategory->options());
	}
	
	public function changeEmail() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->saveAll($this->request->data);
			return $this->redirect(array('controller' => $this->name, 'action' => 'edit', '?' => array('success' => '1')));
		} else {
			$this->request->data = $this->currUser;
		}
	}
	
	public function changePassword() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->saveAll($this->request->data);
			return $this->redirect(array('controller' => $this->name, 'action' => 'edit', '?' => array('success' => '1')));
		} else {
			$this->request->data = $this->currUser;
		}
	}
}
