<?
    $aType = array(
        WorkLog::DEV_WORK => '',
        WorkLog::PUBLISHED => 'Опубликовал статью',
        WorkLog::CREATED => 'Начал писать статью',
        WorkLog::UPDATED => 'Обновил статью',
    );

    $aTypes = array(
        WorkLog::DEV_WORK => 'Обновления по сайту',
        WorkLog::PUBLISHED => 'Опубликовал статьи',
        WorkLog::CREATED => 'Начал писать статьи',
        WorkLog::UPDATED => 'Обновил статьи',
    );

    if (count($logs) > 1) {
        echo $aTypes[$work_type].':<br />';
        foreach($logs as $log) {
            fdebug($log, 'app.log');
            $object_type = $log['object_type'];
            $object_id = $log['object_id'];
            if ($object_type === 'WorkLog') {
                echo '&nbsp;-&nbsp;'.$log['comment'].'<br/>';
            } else {
                $this->ArticleVars->init($articles[$object_type][$object_id], $url, $title, $teaser, $src, '150x');
                $class = ($object_type === 'WikiArticle') ? 'wiki-link' : '';
                echo '&nbsp;&nbsp;&nbsp;' . $this->Html->link($title, $url, array('class' => $class)) . '<br/>';
            }
        }
    } else {
        $object_type = $logs[0]['object_type'];
        $object_id = $logs[0]['object_id'];
        if ($object_type === 'WorkLog') {
            echo $logs[0]['comment'];
        } else {
            $this->ArticleVars->init($articles[$object_type][$object_id], $url, $title, $teaser, $src, '150x');
            $class = ($object_type === 'WikiArticle') ? 'wiki-link' : '';
            echo $aType[$work_type] . ': ' . $this->Html->link($title, $url, array('class' => $class));
        }
        echo '<br/>';
    }
?>
