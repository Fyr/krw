<?
    $aCategories = array(
        'Классы' => array(
            'class_knight' => 'Рыцарь',
            'class_archer' => 'Лучник',
            'class_mage' => 'Маг'
        ),
        'Умения' => array(
            'skills_knight' => 'Активные умения - Рыцарь',
            'skills_archer' => 'Активные умения - Лучник',
            'skills_mage' => 'Активные умения - Маг',
            'skills_passive' => 'Пассивные умения - все классы',
        ),

    );
?>
<div class="categories">
    <ul class="categoriesList">
        <li><b>KingsRoad Wiki</b></li>
<?
/*
    foreach($aCategories as $cat_title => $menu) {
?>
        <li>
            <span><?=$cat_title?></span>
            <ul>
<?
        foreach($menu as $slug => $title) {
?>
                <li><a href="<?=$this->Html->url(array('controller' => 'wiki', 'action' => 'view', $slug))?>"><?=$title?></a></li>
<?
        }
?>

            </ul>
        </li>
<?
    }
*/
?>
        <!--li>
            <a href="/pages/inprogress">Деревня</a>
        </li>
        <li>
            <a href="/pages/inprogress">Драконы</a>
        </li-->
<?
    foreach($aWikiSections as $slug => $title) {
?>
        <li>
            <?=$this->Html->link($title, SiteRouter::url(array('WikiArticle' => compact('slug'))))?>
        </li>
<?
    }
?>
    </ul>
</div>