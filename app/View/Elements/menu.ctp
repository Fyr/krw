<?
    $aMenu = array(
        array('title' => 'Wiki', 'subTitle' => 'энциклопедия<br />KingsRoad', 'url' => array('controller' => 'wiki', 'action' => 'index')),
        array('title' => 'Игрокам', 'subTitle' => 'KingsRoad гайды<br />статьи, обзоры', 'url' => array('controller' => 'articles', 'action' => 'index')),
        array('title' => 'Биржа', 'subTitle' => 'продать / купить<br />аккаунт безопасно', 'url' => array('controller' => 'market', 'action' => 'index')),
        array('title' => 'Галерея', 'subTitle' => 'медиа, пиксель-арт,<br />скриншоты', 'url' => array('controller' => 'gallery', 'action' => 'index'))
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
