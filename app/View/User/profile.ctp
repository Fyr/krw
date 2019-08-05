<?
    if ($this->request->query('saved')) {
        echo $this->Html->tag('p', __('Your profile has been saved'), array('class' => 'mandatory'));
    }
    echo $this->Form->create('User');
    echo $this->Html->tag('h2', __('Kingsroad Profile'));
    echo $this->Form->input('guild_name');
    echo $this->Form->input('player_name');
    echo $this->Form->input('owner', array(
        'type' => 'checkbox',
        'label' => array('text' => __('I am a guild owner')),
        'checked' => $this->request->data('User.owner')
    ));
    echo $this->Form->submit('Save');
    echo $this->Form->end();