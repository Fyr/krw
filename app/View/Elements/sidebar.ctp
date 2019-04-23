<?
    $url = $this->Html->url(array('controller' => 'pages', 'action' => 'view', 'about'));
?>
<div class="block">
    <h2><a href="<?=$url?>">Обо мне</a></h2>
    <div class="frame leftImg">
        <img src="/media/router/index/page/125/400x/image.jpg" alt="Это я, Хрюкатор" />
    </div>
    <p>Всем привет!</p>
    <p>Если вас интересует бесплатная браузерная игра KingsRoad, заходите на мой сайт!</p>
    <p>Играю уже давно и не по наслышке знаю, как сложно искать ответы на вопросы, возникающие по игре KingsRoad.</p>
    <p>Здесь я делюсь с вами опытом, а также полезной и интересной информацией по KingsRoad, накопленной в процессе игры.</p>
    <?=$this->element('more', compact('url'))?>
</div>
