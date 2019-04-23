<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('SiteArticle', 'Model');
App::uses('Portfolio', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
App::uses('PHTime', 'Core.View/Helper');
class ArticlesController extends AppController {
	public $name = 'Articles';
	public $uses = array('Media.Media', 'SiteArticle', 'Portfolio');
	public $helpers = array('ObjectType', 'Media', 'Core.PHTime');
	
	const PER_PAGE = 8;
	
	protected $objectType;

	public function beforeFilter() {
		/*
		if ($this->request->action !== 'view') {
			$this->inProgress();
			return false;
		}
		*/
		// $this->objectType = 'SiteArticle';
		parent::beforeFilter();
	}
	
	public function beforeRender() {
		// $this->currMenu = ($this->objectType == 'News') ? 'News' : 'Articles';
		$this->currMenu = 'Articles';
		$this->set('objectType', $this->objectType);
		
		parent::beforeRender();
	}
	
	public function index() {
		$this->paginate = array(
			'conditions' => array($this->objectType.'.object_type' => 'SiteArticle', $this->objectType.'.published' => 1),
			'limit' => self::PER_PAGE, 
			'order' => $this->objectType.'.created DESC',
			'page' => $this->request->param('page')
		);
		$aArticles = $this->paginate($this->objectType);
		$this->set('aArticles', $aArticles);
	}
	
	public function view($slug) {
		if (is_numeric($slug)) {
			$article = $this->{$this->objectType}->findById($slug);
			if (!$article) {
				$this->redirect404();
				return false;
			}
			$this->redirect(array('controller' => 'articles', 'action' => 'view', $article[$this->objectType][$slug]));
			return false;
		}
		$article = $this->{$this->objectType}->findBySlug($slug);
		
		if (!$article && !TEST_ENV) {
			$this->inProgress();
			return false;
		}
		$aMedia = $this->Media->getObjectList($this->objectType, $article[$this->objectType]['id']);
		$this->set(compact('article', 'aMedia'));

		$this->{$this->objectType}->viewed($article[$this->objectType]['id']);
	}
}
