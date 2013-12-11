<?php

Yii::import('admin.models._base.BaseUsers');

class Users extends BaseUsers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function img(){
		if(isset($this->usersImage->url)){
			if(file_exists(YiiBase::getPathOfAlias('webroot').$this->usersImage->url)){
			return $this->usersImage->url;
			} else{
				return '/img/no_img.jpg';
			}

		} else
			return '/img/no_img.jpg';
	}
	public function rules() {
		return array(
			array('mail','email','message'=>'не является правильным E-Mail адресом'),
			array('name, mail, password', 'required','message'=> 'Заполните поле'),
			array('privileges', 'numerical', 'integerOnly'=>true),
			array('name, position, company, phone, mail, password', 'length', 'max'=>255),
			array('body', 'safe'),
			array('position, company, phone, privileges, body', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, position, company, phone, mail, password, privileges, body', 'safe', 'on'=>'search'),
		);
	}
}