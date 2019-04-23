<?php
App::uses('AppModel', 'Model');
class Article extends AppModel {
	public $useTable = 'articles';

	public $validate = array(
		'title' => 'notempty'
	);

	public function viewed($id) {
		$sql = "UPDATE {$this->useTable} SET views = views + 1 WHERE id = {$id}";
		$this->query($sql);
	}
}
