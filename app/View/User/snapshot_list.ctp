<?
    // echo $this->Html->css(array('admin'), array('inline' => false));
    if ($this->request->query('saved')) {
        echo $this->Html->tag('p', __('Your profile has been saved'), array('class' => 'mandatory'));
    }
    echo $this->Form->create();
    echo $this->Html->tag('h2', __('Snapshots of Guild Stats'));
    // echo $this->Form->submit('Create');
    echo $this->Html->link('Create', array('action' => 'snapshotEdit'), array('class' => 'button'));
    echo $this->Form->end();
?>
<br/>
<table class="grid" border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>Created</th>
            <th>Players</th>
            <th>Status</th>
            <!--th class="mandatory">Actions</th-->
        </tr>
    </thead>
    <tbody>
<?
    foreach($aRowset as $row) {
        $players = unserialize($row['Snapshot']['data']);
        $errors = 0;
        foreach($players as $player) {
            if ($player['status'] == 'ERROR') {
                $errors++;
            }
        }
?>
        <tr class="grid-row">
            <td><?=$row['Snapshot']['created']?></td>
            <td align="right"><?=count($players)?></td>
            <td align="center" style="color; #f00;"><?=$errors?> errors</td>
            <!--td align="center"><?=$row['Snapshot']['created']?></td-->
        </tr>
<?
    }
?>
    </tbody>
</table>
