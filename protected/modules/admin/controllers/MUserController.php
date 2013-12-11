
<?php

class MUserController extends CController {
	public $baseUrl;
	public $name, $email, $login, $phone;
	public $category, $title, $items;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
	}

	public function actionLogout() {
		$session = new CHttpSession;
		$session->open();
		$session->destroy();
		$this->redirect(CHtml::normalizeUrl(array('/admin')));
	}

	//Ajax validation
	public function actionEmailExists() {
		$record = Users::model()->findAllByAttributes(array('email' => $_GET['email']));
		if($record) {
			echo 1;
		} else
			echo 0;
	}
	public function actionLoginExists() {
		$record = Users::model()->findAllByAttributes(array('login' => $_GET['login']));
		if($record) {
			echo 1;
		} else
			echo 0;
	}
}