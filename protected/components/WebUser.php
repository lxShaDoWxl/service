<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 14.11.13
 * Time: 17:07
 */
class WebUser extends CWebUser {
	private $_model = null;

	function getRole() {
		if($user = $this->getModel()){
			// в таблице User есть поле role
			return $user->privileges;
		}
	}

	private function getModel(){
		if (!$this->isGuest && $this->_model === null){
			$this->_model = Users::model()->findByPk($this->id, array('select' => 'privileges'));
		}
		return $this->_model;
	}
}