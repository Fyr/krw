<?
/*
	echo $this->PHForm->input('status', array(
		'label' => false,
		'multiple' => 'checkbox',
		'options' => array('published' => __('Published', true), 'featured' => __('Featured', true)),
		'class' => 'checkbox inline'
	));

	echo $this->element('Article.edit_title');
	echo $this->element('Article.edit_slug');
	echo $this->PHForm->input('period', array('label' => array('class' => 'control-label', 'text' => 'URL')));
*/
	echo $this->PHForm->input('period');
	echo $this->PHForm->input('company');
	echo $this->PHForm->input('position');
	echo $this->PHForm->input('project');
	echo $this->PHForm->input('url', array('label' => array('class' => 'control-label', 'text' => 'URL')));
	echo $this->PHForm->input('descr', array('type' => 'textarea', 'label' => array('class' => 'control-label', 'text' => 'Description')));
	echo $this->PHForm->input('tasks', array('type' => 'textarea', 'label' => array('class' => 'control-label', 'text' => 'Tasks')));
	echo $this->PHForm->input('tech_stack', array('type' => 'textarea', 'label' => array('class' => 'control-label', 'text' => __('Tech.stack'))));
	echo $this->PHForm->input('sorting', array('class' => 'input-mini'));

echo $this->PHForm->hidden('published');
echo $this->PHForm->hidden('featured');