<?php
App::uses('Controller', 'Controller');
App::uses('AppModel', 'Model');

class AppController extends Controller {
	public $paginate;
	public $aNavBar = array(), $aBottomLinks = array(), $currMenu = '', $currLink = '';
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
	}
	
	public function beforeRender() {
		$this->set('aNavBar', $this->aNavBar);
		$this->set('currMenu', $this->currMenu);
		$this->set('aBottomLinks', $this->aBottomLinks);
		$this->set('currLink', $this->currLink);
		$this->set('pageTitle', $this->pageTitle);
		$this->set('aBreadCrumbs', $this->aBreadCrumbs);
		$this->set('seo', $this->seo);

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
		$aWikiSections = array(
			'gaming-currency' => 'Игровая валюта',
			'jewels' => 'Драгоценные камни',
			'evo-materials-stones' => 'Материалы развития камней'
		);
		$this->set('aWikiSections', $aWikiSections);
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
}
