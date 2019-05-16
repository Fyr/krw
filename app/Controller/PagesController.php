<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::uses('Page', 'Model');
App::uses('WorkLog', 'Model');
class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array('Page', 'WorkLog');
	public $helpers = array('ArticleVars', 'Media.PHMedia', 'Core.PHTime');

	public function home() {
		$this->set('article', $this->Page->findBySlug('home'));

		$aWorkLogs = $this->WorkLog->getLogs(3);
		$this->set('aLogs', $aWorkLogs);
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

	public function updates() {
		$aWorkLogs = $this->WorkLog->getLogs();
		$this->set('aLogs', $aWorkLogs);
	}
}
