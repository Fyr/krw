<?
	$pageTitle = $article['GalleryArticle']['title'];
?>
<?=$this->element('title', compact('pageTitle'))?>
<?=$this->ArticleVars->body($article)?>
<?=$this->element($type)?>