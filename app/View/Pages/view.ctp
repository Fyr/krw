<?
	$title = $article['Page']['title'];
/*
	echo $this->element('bread_crumbs', array('aBreadCrumbs' => array(
		__('Home') => '/',
		$title => ''
	)));
*/
	echo $this->element('title', array('pageTitle' => $title));
?>
	<?=$this->ArticleVars->body($article)?>