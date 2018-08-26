<?
    $aHead = array($this->Html->tag('span', $header), 'Опыт, лет', 'Уровень', 'Год');
?>
<table class="table skills">
    <thead>
    <tr>
<?
    foreach($aHead as $title) {
?>
        <th><?=$title?></th>
<?
    }
?>
    </tr>
    </thead>
    <tbody>
<?
    foreach($skills as $_row) {
        $row = array();
        foreach(array('title', 'amount', 'level', 'last_year') as $key) {
            $row[] = $_row[$key];
        }
?>
        <tr>
<?
        foreach($row as $td) {
?>
                <td><?=$td?></td>
<?
        }
?>
        </tr>
<?
    }
?>
    </tbody>
</table>