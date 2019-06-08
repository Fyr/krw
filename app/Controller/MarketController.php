<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
class MarketController extends AppController {
	public $name = 'Portfolio';
	public $uses = array('Media.Media', 'Portfolio');
	public $helpers = array('ObjectType', 'Media');

	public function beforeFilter() {
		$this->inProgress();
	}

	/*
	const PER_PAGE = 100;
	
	public function index() {
		$this->paginate = array(
			'conditions' => array('Portfolio.published' => 1),
			'limit' => self::PER_PAGE, 
			'order' => array('Portfolio.sorting' => 'asc', 'Portfolio.featured' => 'desc', 'Portfolio.created' =>  'desc'),
			'page' => $this->request->param('page')
		);
		$this->set('aArticles', $this->paginate('Portfolio'));
	}
	
	public function view($slug) {
		$article = $this->Portfolio->findBySlug($slug);
		
		if (!$article) {
			return $this->redirect404();
		}
		$aMedia = $this->Media->getObjectList('Portfolio', $article['Portfolio']['id']);
		$this->set(compact('article', 'aMedia'));

	}
	*/
}
