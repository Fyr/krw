<?
	if ($this->Articlevars->getObjectType($article) == 'Portfolio') {
		echo $this->element('Articles/view_Portfolio');
	} else {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '150x');
		echo $this->element('title', array('title' => $title, 'subtitle' => $article['SiteArticle']['subtitle']));
?>
<div class="block">
	<?=$this->ArticleVars->body($article)?>
</div>
<p><a class="btn btn-mini" href="<?=$this->Html->url(array('controller' => 'articles' , 'action' => 'index'))?>">&laquo; <?=__('back')?></a></p>
<?
	}
?>