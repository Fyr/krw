<?php
App::uses('AppModel', 'Model');
class SkillsCategory extends AppModel {

    public function getOptions() {
        return $this->find('list', array('order' => 'sorting'));
    }
}
