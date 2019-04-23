<ul class="smallMenu">
    <li><a href="/">Главная</a></li>
    <li><a href="/inprogress">Wiki</a></li>
    <li><a href="/articles">Статьи</a></li>
    <li><a href="/inprogress">Биржа</a></li>
    <li><a href="/inprogress">Галерея</a></li>
</ul>
<ul class="smallMenu subMenu">
    <li><a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'view', 'about'))?>">О проекте</a></li>
    <li><a href="mailto:fyr@tut.by?subject=<?=Configure::read('domain.title')?>%20contacts">Контакты</a></li>
    <li><a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'view', 'disclaimer'))?>">Отказ от ответственности</a></li>
</ul>