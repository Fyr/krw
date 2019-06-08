<?
	// echo $this->element('title', array('title' => 'Мой блог', 'subtitle' => 'Полезные и интересные статьи на разные темы'));
	foreach($aArticles as $i => $article) {
		$this->ArticleVars->init($article, $url, $title, $teaser, $src, '150x');
?>

	<h2>
		<a href="<?=$url?>"><?=$title?></a>
	</h2>
<?
		if ($src) {
?>
	<div class="frame leftImg">
		<a href="<?=$url?>">
			<img src="<?=$src?>" alt="<?=$title?>">
		</a>
	</div>
<?
		}
?>
	<p><?=$teaser?></p>
	<div>
		<b><?=$this->PHTime->niceShort($article[$this->ArticleVars->getObjectType($article)]['created'])?></b>
	</div>
	<?=$this->element('more', compact('url'))?>
	<hr />
<?
	}
	echo $this->element('paginate');
?>