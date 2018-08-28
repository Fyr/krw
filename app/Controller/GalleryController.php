<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('Media', 'Media.Model');
App::uses('Media', 'View/Helper');
class GalleryController extends AppController {
	public $name = 'Wiki';
	public $uses = array('Media.Media', 'Portfolio');
	public $helpers = array('ObjectType', 'Media');
	
	public function beforeFilter() {
		$this->inProgress();
	}
	/*
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
