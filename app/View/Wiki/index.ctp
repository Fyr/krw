<?=$this->element('title', array('pageTitle' => 'KingsRoad Wiki'))?>
<?
    foreach($aWikiSections as $slug => $title) {
        echo '<h2>'.$this->Html->link($title, SiteRouter::url(array('WikiArticle' => compact('slug')))).'</h2>';
    }
?>
