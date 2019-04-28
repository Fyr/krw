<?php
App::uses('AppHelper', 'View/Helper');
class ObjectTypeHelper extends AppHelper {
    public $helpers = array('Html');
    
    private function _getTitles() {
        $Titles = array(
            'index' => array(
                'Article' => __('Articles'),
                'Page' => __('Static pages'),
                'WikiSection' => __('Wiki Sections'),
                'WikiArticle' => __('Wiki Articles'),
                'User' => __('Users'),
                'WorkLog' => __('Work Logs'),
            ),
            'create' => array(
                'Article' => __('Create Article'),
                'Page' => __('Create Static page'),
                'WikiSection' => __('Create Wiki Section'),
                'WikiArticle' => __('Create Wiki Article'),
                'User' => __('Create User'),
                'WorkLog' => __('Create Work Log'),
            ),
            'edit' => array(
                'Article' => __('Edit Article'),
                'Page' => __('Edit Static page'),
                'WikiSection' => __('Edit Wiki Section'),
                'WikiArticle' => __('Edit Wiki Article'),
                'User' => __('Edit User'),
                'WorkLog' => __('Edit Work Log'),
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