<?
	echo $this->PHForm->input('status', array('label' => false, 'multiple' => 'checkbox', 'options' => array('published' => __('Published', true), 'featured' => __('Featured', true)), 'class' => 'checkbox inline'));
	echo $this->element('Article.edit_title');
	echo $this->PHForm->input('subtitle');
	echo $this->element('Article.edit_slug');
	echo $this->PHForm->input('teaser');
