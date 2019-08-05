<?

    $this->Html->script(array(
        'https://code.highcharts.com/highcharts.js',
        'https://code.highcharts.com/modules/series-label.js'
    ), array('inline' => false));

    $options = array(
        'title' => array('text' => 'Summary "Outcasts" Guild Score Report'),
        'subtitle' => array('text' => 'Source: krwiki.net'),
        'yAxis' => array('title' => array('text' => 'Summary Guild Score' )),
        'exporting' => array('enabled' => false),
        'xAxis' => array('categories' => $aLabels),
        'series' => array(
            array('name' => 'Total GS', 'data' => $aTotal)
        ),
        'legend' => array(
            'layout' => 'vertical',
            'align' => 'right',
            'verticalAlign' => 'middle'
        )
    );
    foreach($aGS as $name => $gs) {
        $options['series'][] = array('name' => $name, 'data' => $gs);
    }
?>
<h2 class="form">Guild reports</h2>
<div id="report-canvas" class="mapContainer" style="border: 1px solid #8d120d; height: 600px; ">

</div>
<script>
$(function(){
    Highcharts.chart('report-canvas', <?=json_encode($options)?>);
});
</script>