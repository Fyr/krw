<?
App::uses('Router', 'Cake/Routing');
class SiteRouter extends Router {

	static public function getObjectType($article) {
		list($objectType) = array_keys($article);
		return $objectType;
	}
	
	static public function url($article) {
		$objectType = self::getObjectType($article);
		if ($objectType == 'Portfolio') {
			$url = array(
				'controller' => 'portfolio',
				'action' => 'view',
				$article['Portfolio']['slug']
			);
		} elseif ($objectType == 'Page') {
			$url = array(
				'controller' => 'pages',
				'action' => 'view',
				$article['Page']['slug']
			);
		} else {
			$url = array(
				'controller' => 'articles',
				'action' => 'view',
				$article['SiteArticle']['slug']
			);
		}
		return parent::url($url);
	}
	
}