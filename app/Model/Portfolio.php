<?php
App::uses('AppModel', 'Model');
App::uses('Article', 'Article.Model');
// App::uses('Seo', 'Seo.Model');
class Portfolio extends Article {
	public $objectType = 'Portfolio';

	public $hasOne = array(
		'Media' => array(
			'className' => 'Media.Media',
			'foreignKey' => 'object_id',
			'conditions' => array('Media.object_type' => 'Portfolio', 'Media.main' => 1),
			'dependent' => true
		)
	);
	/*
	var $hasOne = array(
		'Seo' => array(
			'className' => 'Seo.Seo',
			'foreignKey' => 'object_id',
			'conditions' => array('Seo.object_type' => 'Portfolio'),
			'dependent' => true
		)
	);
	*/

	public function beforeSave($options = array()) {
		if (isset($this->data['Portfolio']['options']['url'])) {
			$url = Hash::get($this->data, 'Portfolio.options.url');
			if ($url && strpos($url, 'http://') === false) {
				$this->data['Portfolio']['options']['url'] = 'http://'.$url;
			}
		}
		$this->data['Portfolio']['options'] = serialize($this->data['Portfolio']['options']);
		return true;
	}

	public function afterFind($results, $primary = false) {
		if ($primary) {
			foreach($results as &$res) {
				if (isset($res['Portfolio']) && isset($res['Portfolio']['options'])) {
					$res['Portfolio']['options'] = unserialize($res['Portfolio']['options']);
				}
			}
		}
		return $results;
	}
}
