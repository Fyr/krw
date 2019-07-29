<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
	
	public $validate = array(
		'username' => array(
			'checkNotEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Field is mandatory',
			),
			'checkNameLen' => array(
				'rule' => array('between', 3, 15),
				'message' => 'User name must be between 3 and 15 characters'
			),
			'checkIsUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This name is already used'
			)
		),
		'email' => array(
			'checkEmail' => array(
				'rule' => 'email',
				'message' => 'Email is incorrect'
			),
			'checkIsUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This email is already used'
			)
		),
		'password' => array(
			'checkNotEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is mandatory'
			),
			'checkPswLen' => array(
				'rule' => array('between', 4, 20),
				'message' => 'The password must be between 4 and 20 characters'
			),
			'checkMatchPassword' => array(
				'rule' => array('matchPassword'),
				'message' => 'Your password and its confirmation do not match',
			)
		),
		'confirm_password' => array(
			'notempty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is mandatory',
			)
		)
	);

	public function matchPassword($data){
		if($data['password'] == $this->data['User']['confirm_password']){
			return true;
		}
		$this->invalidate('password_confirm', 'Your password and its confirmation do not match');
		return false;
	}
	
	public function beforeValidate($options = array()) {
		if (Hash::get($options, 'validate')) {
			if (!Hash::get($this->data, 'User.password')) {
				$this->validator()->remove('password');
				$this->validator()->remove('confirm_password');
			}
		}
	}

	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

}
