<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 13.11.13
 * Time: 9:46
 */


class UserController extends Controller
{
	public $seo_default='AND';
	public $seo='';
	/**
	 * Declares class-based actions.
	 */

	public function publishMessage($message) {
		$session = new CHttpSession;
		$session->open();
		$session['usermessage'] = $message;
	}

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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

	public function actionLk()
	{
		$this->seo_default='Личный кабинет';
		if(!Yii::app()->user->isGuest){
			$data['index']='main';
			if(Yii::app()->getRequest()->getPost('user')) {
				$record=Users::model()->findByPk(Yii::app()->user->getId());
				$record->attributes=Yii::app()->getRequest()->getPost('user');
				if (isset($_FILES['img']['tmp_name']) && $_FILES['img']['tmp_name']) {
					if($record->usersImage){
						$img=$record->usersImage;
						$img->url= str_replace(array("\r", "\n", ""), '', $this->uploadImage($_FILES['img'], 'users'));
						$img->save();
					} else{
						$img=new UsersImage();
						$img->id_user=$record->id;
						$img->url= str_replace(array("\r", "\n", ""), '', $this->uploadImage($_FILES['img'], 'users'));
						$img->save();
					}
				}
				$record->save();
			} elseif(Yii::app()->getRequest()->getQuery('action')) {
				if(Yii::app()->getRequest()->getQuery('action')=='password'){
					$data['index']='password';
					if(Yii::app()->getRequest()->getPost('newpassword')){
						$record=Users::model()->findByPk(Yii::app()->user->getId());
						if($record->password==md5(Yii::app()->getRequest()->getPost('password'))){
							$record->password=md5(Yii::app()->getRequest()->getPost('newpassword'));
							$record->save();
						}
					}
				} elseif(Yii::app()->getRequest()->getQuery('action')=='favorits'){
					$data['index']='favorits';
					$data['user']=Users::model()->findByPk(Yii::app()->user->getId());
				}elseif(Yii::app()->getRequest()->getQuery('action')=='quest'){
					$data['index']='quest';
					$q2 = new CDbCriteria();
					if (Yii::app()->user->checkAccess('77')) {
						if (Yii::app()->getRequest()->getQuery('sub_q')=='answer') {
							$data['index_sub'] = 'answer';
							$q2->addCondition('`id_expert`=:id AND answer is NOT NULL');
						} else {
							$data['index_sub'] = 'quests';
							$q2->addCondition('`id_expert`=:id AND answer is NULL');
						}
					} else {

						$q2->addCondition('`id_user`=:id');
					}
					$q2->params=array(':id'=>Yii::app()->user->getId());
					$q2->order='`date` DESC';
					$count= Question::model()->count($q2);
					$data['pages']=new CPagination($count);
					// элементов на страницу
					$data['pages']->pageSize=30;
					$data['pages']->applyLimit($q2);
					$data['quests']=Question::model()->findAll($q2);

				} elseif(Yii::app()->getRequest()->getQuery('action')=='comment'){
					$data['index']='comment';
					$q2 = new CDbCriteria();
					$q2->addCondition('`author_id`=:id');
					$q2->params=array(':id'=>Yii::app()->user->getId());
					$q2->order='`date` DESC';
					$data['articles']=CommentCatalog::model()->findAll($q2);
				}

			}
			$data['user']=Users::model()->findByPk(Yii::app()->user->getId());
			$this->render('lk', $data);
		}else{
			$this->redirect(CHtml::normalizeUrl('/site/'));
		}

	}
	/*
	 * Добавление картинки
	 */
	public function uploadImage($file, $directory) {
		$date = date('YmdHis');
		$i = rand(1, 100000);
		$ext = end(explode(".", $file['name']));
		move_uploaded_file($file['tmp_name'],
			YiiBase::getPathOfAlias('webroot')."/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext);
		return "/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext;
	}
	public function actionRegistration()
	{
		$this->seo_default='Регистрация';
		if(Yii::app()->user->isGuest){
		$form = new Users;

		if(Yii::app()->getRequest()->getPost('Users')) {
			$captcha=false;
			$session = new CHttpSession;
			$session->open();
			if(Yii::app()->getRequest()->getPost('captcha') == $session['captcha']){
				$captcha=true;
			}else{
				$data['Users_captcha'][]='Заполните слово для защиты от ботов';
				echo json_encode($data);
				Yii::app()->end();
			}

			if(!(json_decode(CActiveForm::validate($form))) && $captcha){
				$user = Yii::app()->getRequest()->getPost('Users');
				$form->attributes = $user;
				$form->name = $user['name'];
				$form->password = md5($user['password']);
				if (isset($user['position'])) {
					$form->position = $user['position'];
				}
				if (isset($user['company'])) {
					$form->company = $user['company'];
				}
				if (isset($user['phone'])) {
					$form->phone = $user['phone'];
				}
				$form->mail=$user['mail'];
				$form->privileges=0;
				$checkUserEmail = Users::model()->findByAttributes(array('mail' => $user['mail']));
				if($checkUserEmail==true){
					$data['Users_mail'][]='Под данным E-Mail зарегистрированы';
					echo json_encode($data);
					Yii::app()->end();
				} else{
					if($form->save()){
						//$this->SendMail('111', "Регистрация ", $form->mail);
						$template=MailTemplate::model()->findByAttributes(array('name'=>'reg'));
						foreach ($form->attributes as $key=>$value) {
							$template->body= str_replace('{'.$key.'}', $value, $template->body);
						}
						SendMail::Send($template->body,'info@and.kz', $form->mail,$template->mail_title);
						$identity=new UserIdentity($form->mail, $user['password']);
						if($identity->authenticate()){
							Yii::app()->user->login($identity);
						}
						$data2['m']='ok';
						echo json_encode($data2);
						Yii::app()->end();
					}
				}
			} else{
				echo CActiveForm::validate($form);
			}

		} else
			$this->render('regist');
		} else{
			$this->redirect(Yii::app()->homeUrl);
		}

	}
	public function actionLogin()
	{
		$model=new LoginForm;
		$data['error'] = 'none';
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$identity=new UserIdentity($_POST['LoginForm']['mail'], $_POST['LoginForm']['password']);
			if($identity->authenticate()) {
				Yii::app()->user->login($identity);
				$session = new CHttpSession;
				$session->open();
			} else {
				$data['error'] = $identity->errorCode;
				$data['error2']=$identity->errorMessage;
			}
		}
		// display the login form
		echo (CActiveForm::validate($model));
		//$this->render('login', $data);
	}

	public function actionSendAnswer()
	{
		$record=Question::model()->findByPk(Yii::app()->getRequest()->getPost('id'));
		$record->answer=Yii::app()->getRequest()->getPost('answer');
		$record->date_answer=date('Y-m-d H:i');
		$record->save();
		$template=MailTemplate::model()->findByAttributes(array('name'=>'quest_answer'));
		$template->body= str_replace('{name}', $record->user_name?:$record->name, $template->body);
		$template->body= str_replace('{mail}', $record->user_mail?:$record->mail, $template->body);
		$template->body= str_replace('{body}', $record->body, $template->body);
		$template->body= str_replace('{body_2}', $record->answer, $template->body);
		$template->body= str_replace('{name_expert}', $record->idExpert->name, $template->body);
		$template->body= str_replace('{mail_expert}', $record->idExpert->mail, $template->body);
		SendMail::Send($template->body,'info@and.kz', $record->user_mail?:$record->idUser->mail,$template->mail_title);
		//SendMail::Send($record->answer,'info@and.kz', Settings::model()->get('e-mail'),$template->mail_title);
		$this->redirect(CHtml::normalizeUrl(array('user/lk')));
	}
	public function actionDelFavorit()
	{
		if(!Yii::app()->user->isGuest){
			$del= Favorites::model()->findByAttributes(array('id'=>	Yii::app()->getRequest()->getPost('id'), 'id_user'=>Yii::app()->user->getId()));
			$del->delete();
		}
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCaptcha() {
		$session = new CHttpSession;
		$session->open();
		$length = 6;
		$chars = array_merge(range(0,9), range('a','z'));
		shuffle($chars);
		$captcha = implode(array_slice($chars, 0, $length));
		$session['captcha'] = $captcha;


		$img=imagecreatefromjpeg("img/texture.jpeg");

		$red=rand(100,255);
		$green=rand(100,255);
		$blue=rand(100,255);

		$text_color=imagecolorallocate($img,0,0,0);
		// $text_color=imagecolorallocate($img,255-$red,255-$green,255-$blue);

		$text=imagettftext($img, 27, rand(-5,5), rand(5,10), rand(25,35), $text_color,
			"fonts/calibrib.ttf", $captcha);

		header("Content-type:image/jpeg");
		header("Content-Disposition:inline ; filename=secure.jpg");
		imagejpeg($img);
	}

	public function actionCaptchaCheck() {
		$session = new CHttpSession;
		$session->open();

		if($_POST['captcha'] == $session['captcha'])
			echo "ok";
		else
			echo "error";
	}

	public function actionForgot() {
		$record = Users::model()->findByAttributes(array('mail' => Yii::app()->getRequest()->getPost('mail')));
		if($record !== null) {
			$length = 6;
			$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
			shuffle($chars);
			$password = implode(array_slice($chars, 0, $length));
			$record->password = md5($password);
			$record->save();
			SendMail::Send("Дорогой ".$record->name."! <br> По Вашей просьбе мы сбросили ваш пароль на ".$password.
				". Если Вы не сбрасывали свой пароль, то мы советуем Вам поменять ваши пароли на почтовом ящике и на нашем сайте.",'info@sugarfish.kz', $record->mail,'Сброс пароля на And.kz');
			$data2['m']="ok";
						// echo $password;
		} else{
			$data2['m']= "Пользователь с данным E-mail не зарегистрирован у нас на сайте";
		}
		echo json_encode($data2);

	}
}