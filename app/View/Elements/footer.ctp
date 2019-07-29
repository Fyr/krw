<?
$aMenu = array(
    array('title' => 'Wiki', 'url' => array('controller' => 'wiki', 'action' => 'index')),
    array('title' => __('Articles'), 'url' => array('controller' => 'articles', 'action' => 'index')),
    array('title' => __('Market'), 'url' => array('controller' => 'pages', 'action' => 'view', 'market')),
    array('title' => __('Gallery'), 'url' => array('controller' => 'gallery', 'action' => 'index'))
);
?>
<ul class="smallMenu">
    <li><a href="/"><?=__('Home')?></a></li>
<?
    foreach($aMenu as $item) {
?>
    <li><?=$this->Html->link($item['title'], $item['url'])?></li>
<?
    }
?>
</ul>
<ul class="smallMenu subMenu">
    <li><a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'view', 'about'))?>"><?=__('About')?></a></li>
    <li><a href="mailto:fyr@tut.by?subject=<?=Configure::read('domain.title')?>%20contacts"><?=__('Contacts')?></a></li>
    <li><a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'view', 'disclaimer'))?>"><?=__('Disclaimer')?></a></li>
</ul>