<?
App::uses('AppModel', 'Model');
App::uses('Article', 'Article.Model');
App::uses('Media', 'Media.Model');
App::uses('Seo', 'Seo.Model');
class WikiSection extends Model {
	/*
	protected $objectType = 'WikiArticle';
	
	var $hasOne = array(
		'Media' => array(
			'foreignKey' => 'object_id',
			'conditions' => array('Media.object_type' => 'WikiArticle', 'Media.main' => 1),
			'dependent' => true
		),
		'Seo' => array(
			'className' => 'Seo.Seo',
			'foreignKey' => 'object_id',
			'conditions' => array('Seo.object_type' => 'WikiArticle'),
			'dependent' => true
		)
	);
	*/
}
