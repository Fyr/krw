<?php
App::uses('Controller', 'Controller');
App::uses('AppModel', 'Model');

class AppController extends Controller {
	public $components = array(
		'Auth' => array(
			'authorize'      => array('Controller'),
			'loginAction'    => array('plugin' => '', 'controller' => 'user', 'action' => 'login'),
			'loginRedirect'  => array('plugin' => '', 'controller' => 'user', 'action' => 'dashboard'),
			'ajaxLogin' => 'Core.ajax_auth_failed',
			'logoutRedirect' => '/',
			'authError'      => 'You must sign in to access that page'
		),
	);
	public $paginate;
	public $aNavBar = array(), $aBottomLinks = array(), $currMenu = '', $currLink = '', $currUser;
	public $pageTitle = '', $aBreadCrumbs = array(), $seo = array();
	
	public function __construct($request = null, $response = null) {
		$this->_beforeInit();
		parent::__construct($request, $response);
		$this->_afterInit();
	}

	protected function _beforeInit() {
	    $this->helpers = array_merge(array('Html', 'Form', 'Paginator', 'Media', 'ArticleVars'), $this->helpers);
	}

	protected function _afterInit() {
		// after construct actions here
		$this->_initLang();
	}

	public function _initLang() {
		$aLangs = array_keys(Configure::read('Config.langs'));
		if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $aLangs)) {
			$lang = $_COOKIE['lang'];
		} else {
			// Auto detect lang
			preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]), $matches);
			$langs = array_combine($matches[1], $matches[2]);
			foreach ($langs as $n => $v)
				$langs[$n] = $v ? $v : 1;
			arsort($langs);

			$aSupportLang = array('ru-ru' => 'rus', 'ru' => 'rus');
			foreach($aSupportLang as $code => $_lang) {
				if (isset($langs[$code])) {
					$lang = $_lang;
					break;
				}
			}
		}
		Configure::write('Config.language', $lang);
	}
	
	public function isAuthorized($user) {
		$this->set('currUser', $user);
		return Hash::get($user, 'active');
	}

	public function isAdmin() {
		return AuthComponent::user('id') === 1;
	}

	public function loadModel($modelClass = null, $id = null) {
		if ($modelClass === null) {
			$modelClass = $this->modelClass;
		}

		$this->uses = ($this->uses) ? (array)$this->uses : array();
		if (!in_array($modelClass, $this->uses, true)) {
			$this->uses[] = $modelClass;
		}

		list($plugin, $modelClass) = pluginSplit($modelClass, true);

		$this->{$modelClass} = ClassRegistry::init(array(
			'class' => $plugin . $modelClass, 'alias' => $modelClass, 'id' => $id
		));
		if (!$this->{$modelClass}) {
			throw new MissingModelException($modelClass);
		}
		return $this->{$modelClass};
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->beforeFilterLayout();
	}
	
	protected function beforeFilterLayout() {
		$this->objectType = $this->getObjectType();
		$this->Auth->allow(array('home', 'index', 'view', 'login', 'register'));
		$this->currUser = array();
		if ($this->Auth->loggedIn()) {
			$this->_refreshUser();
		}
	}
	
	public function beforeRender() {
		$this->set('aNavBar', $this->aNavBar);
		$this->set('currMenu', $this->currMenu);
		$this->set('aBottomLinks', $this->aBottomLinks);
		$this->set('currLink', $this->currLink);
		$this->set('pageTitle', $this->pageTitle);
		$this->set('aBreadCrumbs', $this->aBreadCrumbs);
		$this->set('seo', $this->seo);
		$this->set('lang', Configure::read('Config.language'));
		$this->set('currUser', $this->currUser);

		$this->beforeRenderLayout();
	}
	
	protected function beforeRenderLayout() {
		/*
		$this->WikiSection = $this->loadModel('WikiSection');
		$aWikiSections = $this->WikiSection->find('all', array(
			'conditions' => array('published' => 1),
			'order' => array('sorting' => 'ASC')
		));
		*/

		Configure::write('aWikiSections', array(
			'gaming-currency' => __('Gaming Currency'),
			'jewels' => __('Jewels'),
			'evo-materials-stones' => __('Evo-materials for Jewels')
		));
		$this->set('aWikiSections', Configure::read('aWikiSections'));
	}
	
	/**
	 * Sets flashing message
	 *
	 * @param str $msg
	 * @param str $type - must be 'success', 'error' or empty
	 */
	public function setFlash($msg, $type = 'info') {
		$this->Session->setFlash($msg, 'default', array(), $type);
	}

	protected function getObjectType() {
		$objectType = $this->request->param('objectType');
		return ($objectType) ? $objectType : 'SiteArticle';
	}
	
	public function redirect404() {
		// return $this->redirect(array('controller' => 'pages', 'action' => 'notExists'), 404);
		throw new NotFoundException();
	}

	public function inProgress() {
		$this->redirect(array('controller' => 'pages', 'action' => 'inprogress'));
	}

	protected function _refreshUser($lForce = false) {
		if ($lForce) {
			$this->loadModel('User');
			$user = $this->User->findById($this->currUser['id']);
			$this->Auth->login($user['User']);
		}

		$this->currUser = AuthComponent::user();
	}

}
