<?
App::uses('Router', 'Cake/Routing');
class SiteRouter extends Router {

	static public function getObjectType($article) {
		list($objectType) = array_keys($article);
		return $objectType;
	}
	
	static public function url($article) {
		$objectType = self::getObjectType($article);
		if ($objectType == 'Page') {
			$url = array(
				'controller' => 'pages',
				'action' => 'view',
				$article['Page']['slug']
			);
		} elseif ($objectType == 'WikiArticle') {
			$url = array(
				'controller' => 'wiki',
				'action' => 'view',
				'objectType' => 'WikiArticle',
				'slug' => $article[$objectType]['slug']
			);
		} elseif ($objectType == 'GalleryArticle') {
			$url = array(
				'controller' => 'Gallery',
				'action' => 'view',
				'objectType' => $objectType,
				'slug' => $article[$objectType]['slug']
			);
		} else {
			$url = array(
				'controller' => 'Articles',
				'action' => 'view',
				'objectType' => $objectType,
				'slug' => $article[$objectType]['slug']
			);

		}
		return parent::url($url);
	}
	
}