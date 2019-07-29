<?=$this->element('title',  array('pageTitle' => __('Enter your account')))?>
<?
	if (isset($error)) {
		echo $this->Html->div('error-message', $error, array('style' => 'font-size: 1em'));
	}
	echo $this->Form->create();
	echo $this->Form->input('username', array(
		'label' => array('text' => __('Username'))
	));
	echo $this->Form->input('password', array(
		'label' => array('text' => __('Password'))
	));
	echo $this->Form->submit(__('Log in'));
	echo $this->Form->end();
?>