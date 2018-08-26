<li>
    <span><b><?=$period?></b></span> <b><?=$position?></b><br/>
    <span>Компания:</span> <?=$company?><br/>
    <span>Проект:</span> <?=($url) ? '<a href="'.$url.'" target="_blank">'.$project.'</a>' : $project ?><br/>
<?
    foreach($aItems as $title => $descr) {
?>
        <span><?=$title?>:</span> <?=$descr?><br/>
<?
    }
?>
</li>