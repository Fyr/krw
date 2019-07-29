<?=$this->element('title',  array('pageTitle' => __('Register')))?>
<?
	$required = $this->Html->tag('span', '*', array('class' => 'mandatory'));
	echo $this->Html->tag('p', __('%s Fields are mandatory', $required));
	echo $this->Form->create();
	echo $this->Html->tag('h2', __('Your Account'));
	echo $this->Form->input('username', array(
		'label' => array('text' => $required.__('Username'))
	));
	echo $this->Form->input('email', array(
		'label' => array('text' => $required.'Email')
	));
	echo $this->Form->input('password', array(
		'label' => array('text' => $required.__('Password'))
	));
	echo $this->Form->input('confirm_password', array(
		'type' => 'password',
		'label' => array('text' => $required.__('Confirm Password'))
	));
	echo $this->Form->input('subscribe', array(
		'type' => 'checkbox',
		'label' => array('text' => __('I want to receive news and announcements')),
		'checked' => true,
	));
	echo '<br/>';
	echo $this->Html->tag('h2', __('Kingsroad Profile'));
	echo $this->Form->input('guild_name');
	echo $this->Form->input('player_name');
	echo $this->Form->input('owner', array(
		'type' => 'checkbox',
		'label' => array('text' => __('I am a guild owner'))
	));
	$link = $this->Html->link('terms of service', array('controller' => 'pages', 'action' => 'view', 'disclaimer'));
	echo '<br/>';
	echo $this->Form->input('agree', array(
		'type' => 'checkbox',
		'label' => array('text' => __('I agree with %s', $link)),
		'checked' => false,
		'onchange' => 'onAgree()'
	));
	echo $this->Form->submit('Submit', array('disabled' => true));
	echo $this->Form->end();
?>

<script>
function onAgree() {
	$('[type="submit"]').prop('disabled', !$('#UserAgree:checked').length);
}
</script>