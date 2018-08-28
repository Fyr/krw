<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('Page', 'Model');
App::uses('WorkExp', 'Model');
App::uses('SkillsCategory', 'Model');
App::uses('Skill', 'Model');
App::uses('Portfolio', 'Model');
class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array('Page', 'WorkExp', 'Skill', 'SkillsCategory', 'Portfolio');
	public $helpers = array('ArticleVars', 'Media.PHMedia', 'Core.PHTime');

	public function home() {
		$this->set('article', $this->Page->findBySlug('home'));
	}

	public function inprogress() {
	}

	public function view($slug) {
		$this->request->params['objectType'] = 'Page';
		
		$article = $this->Page->findBySlug($slug);
		$this->set('article', $article);
		
		// $this->currMenu = $slug;
	}
	
	public function notExists() {
		// http_response_code(404);
		// $this->response->header('HTTP/1.0 404 Not Found');
		$this->response->statusCode(404);
		$this->response->send();
	}
}