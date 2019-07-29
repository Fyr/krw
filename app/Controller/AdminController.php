<?php
App::uses('AppController', 'Controller');
class AdminController extends AppController {
	public $name = 'Admin';
	public $layout = 'admin';
	// public $components = array();
	public $uses = array();

	public function _beforeInit() {
	    // auto-add included modules - did not included if child controller extends AdminController
	    $this->components = array_merge(array('Auth', 'Core.PCAuth', 'Table.PCTableGrid'), $this->components);
	    $this->helpers = array_merge(array('Html', 'Table.PHTableGrid', 'Form.PHForm'), $this->helpers);
	    
		$this->aNavBar = array(
			'Content' => array('label' => __('Content'), 'href' => '', 'submenu' => array(
				array('label' => __('Static pages'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'Page')),
				array('label' => __('Site Articles'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'SiteArticle')),
				array('label' => __('Wiki'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'WikiArticle')),
				array('label' => __('Gallery'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'GalleryArticle')),
				array('label' => __('Work Logs'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'WorkLog')),
			)),
			/*
			'Wiki' => array('label' => __('Wiki'), 'href' => '', 'submenu' => array(
				array('label' => __('Sections'), 'href' => array('controller' => 'AdminContent', 'action' => 'index', 'WikiSection')),

			)),
			*/
			'Settings' => array('label' => __('Settings'), 'href' => array('controller' => 'AdminSettings', 'action' => 'index')),

		);
		$this->aBottomLinks = $this->aNavBar;
	}

	public function isAuthorized($user) {
		$group_id = Hash::get($user, 'user_group_id');
		if ($group_id == 1) {
			$this->set('currUser', $user);
			return Hash::get($user, 'active');
		}
		$this->redirect($this->Auth->loginAction);
		return false;
	}

	public function beforeFilter() {
		/*
		$this->loadModel('Section');
		foreach($this->Section->find('list') as $id => $title) {
			$this->aNavBar['Products']['submenu'][] = array(
				'label' => $title, 'href' => array('controller' => 'AdminProducts', 'Product.section' => $id)
			);
		}
		*/
	    $this->currMenu = $this->_getCurrMenu();
	    $this->currLink = $this->currMenu;
	}
	
	public function beforeRenderLayout() {
		$this->set('isAdmin', $this->isAdmin());
	}
	
	public function isAdmin() {
		return AuthComponent::user('id') == 1;
	}

	public function index() {
		//$this->redirect(array('controller' => 'AdminProducts'));
	}
	
	protected function _getCurrMenu() {
		$curr_menu = str_ireplace('Admin', '', $this->request->controller); // By default curr.menu is the same as controller name
		return $curr_menu;
	}

	public function delete($id) {
		$this->autoRender = false;

		$model = $this->request->query('model');
		if ($model) {
			$this->loadModel($model);
			if (strpos($model, '.') !== false) {
				list($plugin, $model) = explode('.',$model);
			}
			$this->{$model}->delete($id);
		}
		if ($backURL = $this->request->query('backURL')) {
			$this->redirect($backURL);
			return;
		}
		$this->redirect(array('controller' => 'Admin', 'action' => 'index'));
	}
	
}
