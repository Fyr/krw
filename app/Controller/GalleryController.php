<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
class GalleryController extends AppController {
	public $name = 'Gallery';
	public $uses = array('Media.Media', 'GalleryArticle');
	public $helpers = array('ObjectType', 'Media', 'Core.PHTime');

	const PER_PAGE = 8;
	
	public function beforeFilter() {
		$this->currMenu = 'Articles';
		$this->objectType = 'GalleryArticle';
		parent::beforeFilter();
	}

	public function index() {
		$this->paginate = array(
			'conditions' => array($this->objectType.'.object_type' => $this->objectType, $this->objectType.'.published' => 1),
			'limit' => self::PER_PAGE,
			'order' => $this->objectType.'.created DESC',
			'page' => $this->request->param('page')
		);
		$aArticles = $this->paginate($this->objectType);
		$this->set('aArticles', $aArticles);
		$this->render('../Articles/index');
	}

	public function view($slug) {
		$article = $this->{$this->objectType}->findBySlug($slug);
		list($type) = explode('-', $slug);
		if (!$article || !in_array($type, array('tour', 'eventset'))) {
			return $this->redirect404();
		}

		$aMedia = $this->Media->getObjectList($this->objectType, $article[$this->objectType]['id'], array('orig_fname' => 'asc'));
		$this->set(compact('article', 'aMedia', 'type'));
	}

}
