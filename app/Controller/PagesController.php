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
		$this->set('isHome', true);
	}

	public function skills() {
		$aSkillsCat = $this->SkillsCategory->getOptions();

		$aSkills = $this->Skill->find('all', array('order' => array('Skill.cat_id' => 'asc', 'Skill.sorting' => 'asc')));
		$aSkills = Hash::combine($aSkills, '{n}.Skill.id', '{n}.Skill', '{n}.Skill.cat_id');

		$aWorkExp = $this->WorkExp->find('all', array('order' => 'sorting'));
		$this->set(compact('aSkills', 'aSkillsCat', 'aWorkExp'));
	}

	public function view($slug) {
		$this->request->params['objectType'] = 'Page';
		
		$article = $this->Page->findBySlug($slug);
		$this->set('article', $article);
		
		$this->currMenu = $slug;
	}
	
	public function notExists() {
		// http_response_code(404);
		// $this->response->header('HTTP/1.0 404 Not Found');
		$this->response->statusCode(404);
		$this->response->send();
	}
}
