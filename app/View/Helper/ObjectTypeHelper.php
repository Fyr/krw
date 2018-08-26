<?php
App::uses('AppHelper', 'View/Helper');
class ObjectTypeHelper extends AppHelper {
    public $helpers = array('Html');
    
    private function _getTitles() {
        $Titles = array(
            'index' => array(
                'Article' => __('Articles'),
                'Page' => __('Static pages'),
                'Portfolio' => __('Portfolio'),
                'WorkExp' => __('Work Experience'),
                'User' => __('Users'),
            ),
            'create' => array(
                'Article' => __('Create Article'),
                'Page' => __('Create Static page'),
                'Portfolio' => __('Create Portfolio work'),
                'WorkExp' => __('Create WorkExp'),
                'User' => __('Create User'),
            ),
            'edit' => array(
                'Article' => __('Edit Article'),
                'Page' => __('Edit Static page'),
                'Portfolio' => __('Edit Portfolio work'),
                'WorkExp' => __('Edit WorkExp'),
                'User' => __('Edit User'),
            ),
            'view' => array(
            	'Article' => __('View Article'),
            	'News' => __('View News article'),
            	'Product' => __('View Product')
            )
        );
        return $Titles;
    }
    
    public function getTitle($action, $objectType) {
        $aTitles = $this->_getTitles();
        return (isset($aTitles[$action][$objectType])) ? $aTitles[$action][$objectType] : $aTitles[$action]['Article'];
    }
    
    public function getBaseURL($objectType, $objectID = '') {
        return $this->Html->url(array('action' => 'index', $objectType, $objectID));
    }
}