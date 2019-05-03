<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('WikiArticle', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
class WikiController extends AppController {
	public $name = 'Wiki';
	public $uses = array('Media.Media', 'WikiArticle');
	public $helpers = array('ObjectType', 'Media');

	protected $objectType;
	
	public function beforeFilter() {
		// $this->inProgress();
		$this->objectType = 'WikiArticle';
		parent::beforeFilter();
	}

	public function index() {
		$this->inProgress();
	}

	public function view($slug) {
		if (is_numeric($slug)) {
			$article = $this->{$this->objectType}->findById($slug);
			if (!$article) {
				$this->redirect404();
				return false;
			}
			$this->redirect(array('controller' => 'wiki', 'action' => 'view', $article[$this->objectType][$slug]));
			return false;
		}
		// $article = $this->{$this->objectType}->findBySlug($slug);
		$article = $this->WikiArticle->findBySlug($slug);
		if (!$article && !TEST_ENV) {
			$this->inProgress();
			return false;
		}
		/*
		if (!$article['WikiArticle']['published']) {
			$this->inProgress();
			return false;
		}
		*/
		$aMedia = $this->Media->getObjectList($this->objectType, $article[$this->objectType]['id']);
		$this->set(compact('article', 'aMedia'));
	}
}
