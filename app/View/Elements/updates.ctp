<table>
    <tbody>
<?
    foreach($aLogs['logs'] as $created => $work_logs) {
?>
        <tr>
            <td style="vertical-align: top" nowrap="nowrap"><b><?=date('d.m.Y', strtotime($created))?></b></td>
            <td>
<?
        foreach($work_logs as $work_type => $logs) {
            echo $this->element('show_log', array('articles' => $aLogs['articles'], 'logs' => $logs, 'work_type' => $work_type));
        }
?>
            </td>
        </tr>
<?
    }
?>
    </tbody>
</table>
