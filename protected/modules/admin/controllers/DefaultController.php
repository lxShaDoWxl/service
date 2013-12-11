<?php

class DefaultController extends CController
{
	public $baseUrl;
	public $homeUrl;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->layout = 'login';

		$this->homeUrl =  CHtml::normalizeUrl(array('catalog/'));
	}

	public function actionIndex()
	{
		$session = new CHttpSession;
		$session->open();
		if (isset($session['id'])) {
			$this->redirect($this->homeUrl);
		}

		$data = array();
		if (isset($_POST) && $_POST && isset($_POST['login']) && isset($_POST['pass'])) {
			//$record = MUser::model()->findByAttributes(array("login" => strtolower($_POST['login']), "pass" => md5($_POST['pass'])));
			$identity=new UserIdentity(Yii::app()->getRequest()->getPost('login'), Yii::app()->getRequest()->getPost('pass'));
			if($identity->authenticate()) {
				Yii::app()->user->login($identity);
				if (Yii::app()->user->checkAccess('100')) {
					$this->redirect($this->homeUrl);
				} else {
					$data['login_error'] = "Вход запрещён";
				}

			} else {
				$data['login_error'] = "Неверный логин/пароль";
			}


//			if ($record !== null) {
//				if () {
//					$session['id'] = $record->id;
//					$session['name'] = $record->name;
//					$session['login'] = $record->login;
//					$session['email'] = $record->email;
//					$session['phone'] = $record->phone;
//					$session['privileges'] = $record->privileges;
//					$this->redirect($this->homeUrl);
//				} else {
//				}
//			} else
//
		}

		$session->close();
		$this->render('login', $data);
	}
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}