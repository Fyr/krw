<h2 class="form">Guild stats</h2>
<table class="grid" border="0" cellpadding="0" cellspacing="0">
    <thead>
        <th>N</th>
        <th>Name</th>
        <th>Start GS</th>
        <th>Curr.GS</th>
        <th>GS Made</th>
    </thead>
    <tbody>

<?
    foreach($aStats as $i => $player) {
?>
        <tr>
            <td align="right"><?=$i + 1?></td>
            <td><?=$player['name']?></td>
            <td align="right"><?=number_format($player['start_gs'], 0, '', ',')?></td>
            <td align="right"><?=number_format($player['end_gs'], 0, '', ',')?></td>
            <td align="right"><?=number_format($player['gs'], 0, '', ',')?></td>
        </tr>

<?
    }
?>
    </tbody>
</table>
