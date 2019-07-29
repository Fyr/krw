<?
    $aMenu = array(
        array('title' => 'Wiki', 'subTitle' => __('wikipedia of%sKingsRoad', '<br/>'), 'url' => array('controller' => 'wiki', 'action' => 'index')),
        array('title' => __('Articles'), 'subTitle' => __('KingsRoad guides%sreviews, tutorials', '<br/>'), 'url' => array('controller' => 'articles', 'action' => 'index')),
        array('title' => __('Market'), 'subTitle' => __('sell / buy%saccount safely', '<br/>'), 'url' => array('controller' => 'pages', 'action' => 'view', 'market')),
        array('title' => __('Gallery'), 'subTitle' => __('media, game-art%sscreenshots', '<br/>'), 'url' => array('controller' => 'gallery', 'action' => 'index'))
    );
?>
<ul class="mainMenu">
<?
    foreach($aMenu as $menu) {
        $class = (strtolower($this->request->controller) == strtolower($menu['url']['controller']) && $menu['url']['action'] != 'home') ? 'active' : '';
?>
    <li class="<?=$class?>">
        <a href="<?=$this->Html->url($menu['url'])?>">
            <div class="centerPart">
                <div class="title"><?=$menu['title']?></div>
                <div class="subTitle"><?=$menu['subTitle']?></div>
            </div>
        </a>
    </li>
<?
    }
?>
</ul>
