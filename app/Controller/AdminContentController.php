<?php
App::uses('AdminController', 'Controller');
App::uses('WorkLog', 'Model');
class AdminContentController extends AdminController {
    public $name = 'AdminContent';
    public $components = array('Article.PCArticle');
    public $uses = array('Article.Article', 'WorkLog');
    public $helpers = array('ObjectType');
    
    public function index($objectType, $objectID = '') {
        $this->paginate = array(
            'Page' => array(
            	'fields' => array('title', 'slug')
            ),
        	'SiteArticle' => array(
        		'fields' => array('created', 'modified', 'title', 'slug', 'featured', 'published')
        	),
			'WikiSection' => array(
				'fields' => array('id', 'title', 'published', 'sorting'),
				'order' => array('WikiSection.sorting' => 'ASC')
			),
			'WikiArticle' => array(
				'fields' => array('created', 'modified', 'title', 'slug', 'published')
			),
			'GalleryArticle' => array(
				'fields' => array('created', 'modified', 'title', 'slug', 'teaser', 'published')
			),
			'WorkLog' => array(
				'fields' => array('created', 'work_type', 'object_type', 'object_id', 'comment')
			)
        );
        
        $aRowset = $this->PCArticle->setModel($objectType)->index();
        $this->set('objectType', $objectType);
        $this->set('objectID', $objectID);
        $this->set('aRowset', $aRowset);
    }
    
	public function edit($id = 0, $objectType, $objectID = '') {
		$this->loadModel('Media.Media');
		
		if (!$id) {
			// если не задан ID, то objectType+ObjectID должны передаваться
			$this->request->data($objectType.'.object_type', $objectType);
			// $this->request->data('Article.object_id', $objectID);
			$this->request->data('Seo.object_type', $objectType);
		}

		$this->PCArticle->setModel($objectType);
		$old_article = $this->PCArticle->model()->findById($id);
		$this->PCArticle->edit(&$id, &$lSaved);

		if ($lSaved) {
			$old_article = Hash::get($old_article, $objectType);
			$new_article = hash::get($this->PCArticle->model()->findById($id), $objectType);
			$this->WorkLog->saveLog($objectType, $old_article, $new_article);

			$indexRoute = array('action' => 'index', $objectType, $objectID);
			$editRoute = array('action' => 'edit', $id, $objectType, $objectID);
			return $this->redirect(($this->request->data('apply')) ? $indexRoute : $editRoute);
		}
		
		if (!$id) {
			$this->request->data($objectType.'.status', array('published'));
			$this->request->data($objectType.'.sorting', '0');
		}

		$this->set('objectType', $objectType);
	}
}
