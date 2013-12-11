<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 14.11.13
 * Time: 12:06
 */

class QuestController extends CController {
	public $baseUrl;
	public $isQuest;
	public $login;
	public $title;
	public $categories;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isQuest = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$this->title = 'Вопросы';
		$this->categories = array(
			'index' => array('title' => 'Новые', 'url' => CHtml::normalizeUrl(array('quest/'))),
			'old' => array('title' => 'Отвеченные', 'url' => CHtml::normalizeUrl(array('quest/old'))),
		);
	}

	public function filter($filter) {
		$filterSet = explode('&',$filter);
		$params = array();
		$params['filter'] = array();
		foreach ($filterSet as $f) {
			$a = explode('=',$f);
			if(isset($a[1])){
				if(strpos($f,'filter') !== false){
					if($a[1] == 'true'){
						$temp = explode('-', $a[0]);
						if(!isset($params['filter'][$temp[1]]))
							$params['filter'][$temp[1]] = array();
						array_push($params['filter'][$temp[1]],$temp[2]);
					}
				}else{
					$params[$a[0]] = $a[1];
				}
			}

		}
		return $params;
	}

	public function actionIndex() {
		if(isset($_POST['filter'])){
			$params=$this->filter($_POST['filter']);
			$criteria = new CDbCriteria();
			$criteria->order = 'id desc';
			if(isset($params['limit'])) $criteria->limit = $params['limit'];
			if(isset($params['offset'])) $criteria->offset = $params['offset'];
			if(isset($params['category'])){
				$criteria->addCondition('id_theme = '. $params['category']);

			}
			$criteria->addCondition('answer is NULL','AND');
			$menu = null;
			$data['itemCount'] = Question::model()->count($criteria);
			$data['items'] = Question::model()->findAll($criteria);
			$this->renderPartial('loaditems',$data);
		} else{
			$this->categories['index']['active'] = true;
			$data['cats']=QuestionTheme::model()->findAll();
			$this->render('quests', $data);
		}


	}
	public function actionOld()
	{
		if(isset($_POST['filter'])){
			$params=$this->filter($_POST['filter']);
			$criteria = new CDbCriteria();
			$criteria->order = 'id desc';
			if(isset($params['limit'])) $criteria->limit = $params['limit'];
			if(isset($params['offset'])) $criteria->offset = $params['offset'];
			if(isset($params['category'])){
				$criteria->addCondition('id_theme = '. $params['category']);

			}
			$criteria->addCondition('answer is NOT NULL','AND');
			$menu = null;
			$data['itemCount'] = Question::model()->count($criteria);
			$data['items'] = Question::model()->findAll($criteria);
			$this->renderPartial('loaditems',$data);
		} else{
		$this->categories['old']['active'] = true;
		$data['cats']=QuestionTheme::model()->findAll();
		$this->render('quests', $data);
		}
	}

	public function actionChangeVisible()
	{
		$record=Question::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$record->isVisible=Yii::app()->getRequest()->getQuery('status');
		$record->save();
	}
//region Темы вопросов
	public function actionCreateCat()
	{
		$data['experts']=Users::model()->findAll('privileges=77');
		$this->renderPartial('createCat', $data);
	}
	public function actionEditCat() {
		$data['cats'] = QuestionTheme::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$data['experts']=Users::model()->findAll('privileges=77');
		$this->renderPartial('editCat', $data);
	}
	public function actionSaveCat()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new')
			$record = new QuestionTheme;
		else $record = QuestionTheme::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$record->attributes = $_POST;

		if(Yii::app()->getRequest()->getPost('experts')){
			$experts=Yii::app()->getRequest()->getPost('experts');
				if ($record->questionThemeExperts) {
					QuestionThemeExpert::model()->deleteAllByAttributes(array('id_theme'=>$record->id));
				}
			foreach ($experts as $value) {
				$expert = new QuestionThemeExpert();
				$expert->id_expert=$value;
				$expert->id_theme=$record->id;
				$expert->save();
			}

		}
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('quest/')));
	}

	public function actionDeleteCat() {
		QuestionTheme::model()->deleteByPk(Yii::app()->getRequest()->getQuery('id'));
		$this->redirect(CHtml::normalizeUrl(array('quest/')));
	}
	//endregion
	public function actionEditQuest($id)
	{
		$data['quest']=Question::model()->findByPk($id);
		$data['quest_themes']= QuestionTheme::model()->findAll();
		$data['experts']=Users::model()->findAll('`privileges`=77');
		$this->renderPartial('editQuest', $data);
	}
	public function actionSaveQuest($id)
	{
		$record=Question::model()->findByPk($id);
		$record->attributes=$_POST;
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('quest/')));
	}

	public function actionDeleteQuest($id)
	{
		Question::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('quest/')));
	}
	public function actionSend()
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
		SendMail::Send($template->body,'info@and.kz', $record->user_mail?:$record->idUser->mail, $template->mail_title);
		//SendMail::Send($record->answer,'info@and.kz', Settings::model()->get('e-mail'),$template->mail_title);
	}
}