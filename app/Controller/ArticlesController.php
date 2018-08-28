<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('SiteArticle', 'Model');
App::uses('Portfolio', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
class ArticlesController extends AppController {
	public $name = 'Articles';
	public $uses = array('Media.Media', 'SiteArticle', 'Portfolio');
	public $helpers = array('ObjectType', 'Media');
	
	const PER_PAGE = 2;
	
	protected $objectType;

	public function beforeFilter() {
		$this->inProgress();
		// $this->objectType = 'SiteArticle';
		// parent::beforeFilter();
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
		$this->set('aArticles', $this->paginate($this->objectType));
	}
	
	public function view($slug) {
		$article = $this->{$this->objectType}->findBySlug($slug);
		
		if (!$article && !TEST_ENV) {
			// return $this->redirect('/');
		}
		$aMedia = $this->Media->getObjectList($this->objectType, $article[$this->objectType]['id']);
		$this->set(compact('article', 'aMedia'));

	}
}
