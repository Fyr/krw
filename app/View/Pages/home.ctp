<?=$this->element('title', array('pageTitle' => $article['Page']['title']))?>
<?=$this->ArticleVars->body($article)?>
<hr />
<h2>Последние обновления:</h2>
<?=$this->element('updates', compact('aLogs'))?>
<?
    $url = $this->Html->url(array('controller' => 'pages', 'action' => 'updates'));
    $title = __('all updates');
?>
<?=$this->element('more', compact('url', 'title'))?>