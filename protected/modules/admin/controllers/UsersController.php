<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 14.11.13
 * Time: 12:06
 */

class UsersController extends CController {
	public $baseUrl;
	public $isUsers;
	public $login;
	public $title;
	public $categories;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isUsers = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$this->title = 'Контент';
		$this->categories = array(
			'index' => array('title' => 'Все пользователи', 'url' => CHtml::normalizeUrl(array('users/'))),
			'experts' => array('title' => 'Эксперты', 'url' => CHtml::normalizeUrl(array('users/experts'))),
		);
	}
	public function actionIndex() {
		$this->categories['index']['active'] = true;
		$data['users'] = Users::model()->findAll();
		$this->render('users', $data);
	}
	public function actionExperts()
	{
		$this->categories['experts']['active'] = true;
		$data['users'] = Users::model()->findAll('privileges=77');
		$this->render('users', $data);
	}
	public function actionEdit($id) {
		$data['users'] = Users::model()->findByPk($id);
		$this->renderPartial('edit', $data);
	}

	public function actionCreate()
	{
		$data['users']=false;
		$this->renderPartial('edit', $data);
	}
	public function actionSave($id) {
		if($id=='new'){
			$user=new Users();
		}else{
			$user= Users::model()->findByPk($id);
		}
		$user->attributes = $_POST;
		if (Yii::app()->getRequest()->getPost('img')){
			if($user->usersImage){
				$img=$user->usersImage;
				$img->url= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('img'));
				$img->save();
			} else{
				$img=new UsersImage();
				$img->id_user=$user->id;
				$img->url= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('img'));
				$img->save();
			}

		}
		if(Yii::app()->getRequest()->getPost('newpassword')){
			$user->password=md5(Yii::app()->getRequest()->getPost('newpassword'));
		}
		$user->save();
		$this->redirect(CHtml::normalizeUrl(array('users/')));
	}

	public function actionDeleted($id) {
		Users::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('users/')));
	}
	/*
	 * Добавление картинки
	 */
	public function uploadImage($file, $directory) {
		$date = date('YmdHis');
		$i = rand(1, 100000);
		$ext = end(explode(".", $file['name']));
		move_uploaded_file($file['tmp_name'],
			realpath(dirname(__FILE__)) . "/../../../../userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext);
		return "/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext;
	}

	public function actionUploadIcon() {
		foreach ($_FILES as $file) {
			if($file['tmp_name']) {
				echo $this->uploadImage($file, $_GET['f']);
			}
		}
	}
	protected function increment_string($str, $separator = '_', $first = 1)
	{
		preg_match('/(.+)'.$separator.'([0-9]+)$/', $str, $match);
		return isset($match[2]) ? $match[1].$separator.($match[2] + 1) : $str.$separator.$first;
	}

}