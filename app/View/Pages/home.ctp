<?=$this->element('title', array('pageTitle' => $article['Page']['title']))?>
<?=$this->ArticleVars->body($article)?>
<hr />
<?
    $url = SiteRouter::url($article2);
?>
<h2>Нужна помощь в игре?</h2>
Если ты хочешь получить от меня помощь в игре KingsRoad, <b>внимательно</b> прочитай <a href="<?=$url?>">эту статью</a> и действуй!
<?=$this->element('more', compact('url'))?>
<hr />
<?
/*

<h2>Есть инфа? Поделись!</h2>
Для того, чтобы KingsRoad wiki был полноценным, мне приходится собирать очень много информации. Однако ты можешь мне в этом помочь.<br/>
TODO: нужно написать четкий список того, что нужно

<?
*/
/*
    if ($article2) {
?>
    <?=$this->element('title', array('pageTitle' => $article2['Page']['title']))?>
    <?=$this->ArticleVars->body($article2)?>
    <hr />
    }
*/
?>
<h2>Последние обновления:</h2>
<?=$this->element('updates', compact('aLogs'))?>
<?
    $url = $this->Html->url(array('controller' => 'pages', 'action' => 'updates'));
    $title = __('all updates');
?>
<?=$this->element('more', compact('url', 'title'))?>