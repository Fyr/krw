<div class="span8 offset2">
<?
    $id = $this->request->data($objectType.'.id');
    $slug = $this->request->data($objectType.'.slug');
    $title = $this->ObjectType->getTitle(($id) ? 'edit' : 'create', $objectType);
    
    $objectID = '';
	echo $this->element('admin_title', compact('title'));

    echo $this->PHForm->create($objectType);
    echo $this->Html->link(__('Preview').'<i class="icon icon-chevron-right"></i>',
        array('controller' => 'articles', 'action' => 'view', $slug),
        array('class' => 'btn btn-mini pull-right', 'escape' => false)
    );
    echo $this->Form->hidden('Seo.id', array('value' => Hash::get($this->request->data, 'Seo.id')));
    $aTabs = array(
        'General' => $this->element('/AdminContent/admin_edit_'.$objectType),
		'Text' => $this->element('Article.edit_body'),
		// 'SEO' => $this->element('Seo.edit')
    );
    if ($id) {
        $aTabs['Media'] = $this->element('Media.edit', array('object_type' => $objectType, 'object_id' => $id));
    }
	echo $this->element('admin_tabs', compact('aTabs'));
	echo $this->element('Form.form_actions', array('backURL' => $this->ObjectType->getBaseURL($objectType, $objectID)));
    echo $this->PHForm->end();
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	// var $grid = $('#grid_FormField');
});
</script>