<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 15.11.13
 * Time: 12:13
 */

class ArchiveController extends CController
{
	public $baseUrl;
	public $isArchive;
	public $login;
	public $title, $categories;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isArchive = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$this->title = 'Архив';
		$this->categories = array(
			'index' => array('title' => 'Издания', 'url' => CHtml::normalizeUrl(array('archive/'))),
			'subs' => array('title' => 'Подписчики', 'url' => CHtml::normalizeUrl(array('archive/subs')))
		);

	}

	//region Издание
	public function actionIndex() {
		$this->categories['index']['active'] = true;
		$data['archives'] = Book::model()->findAll(array('order'=>'`date` DESC'));
		$cont_date=count($data['archives'])-1;
		$data['number_old']=Yii::app()->dateFormatter->format('yyyy', $data['archives'][0]->date);
		$data['number_one']=Yii::app()->dateFormatter->format('yyyy', $data['archives'][$cont_date]->date);
		$this->render('index', $data);
	}
	public function actionCreate() {

		$this->renderPartial('create');
	}
	public function actionEdit() {
		$data['archive'] = Book::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$this->renderPartial('edit', $data);
	}
	public function actionSave() {
		if(Yii::app()->getRequest()->getQuery('id') == 'new')
			$record = new Book();
		else $record = Book::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$record->attributes = $_POST;
		if(isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']){
			if(Yii::app()->getRequest()->getQuery('id')=='new'){
				$record->url= $this->uploadBook($_FILES['file'], 'books');
			} else{
				if(isset($record->url)&& file_exists(YiiBase::getPathOfAlias('webroot').$record->url)){
					unlink(YiiBase::getPathOfAlias('webroot').$record->url);
					$record->url= $this->uploadBook($_FILES['file'], 'books');
				}
			}

		}
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('archive/')));

	}
	public function actionDelete() {
		$book=Book::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		if(isset($book->url)&& file_exists(YiiBase::getPathOfAlias('webroot').$book->url)){
			unlink(YiiBase::getPathOfAlias('webroot').$book->url);
		}
		if(isset($book->img)&& file_exists(YiiBase::getPathOfAlias('webroot').$book->img)){
			unlink(YiiBase::getPathOfAlias('webroot').$book->img);
		}

		$book->delete();
		$this->redirect(CHtml::normalizeUrl(array('archive/')));
	}
	public function uploadBook($file, $directory) {
		$date = date('YmdHis');
		$ext = end(explode(".", $file['name']));
		move_uploaded_file($file['tmp_name'],
			realpath(dirname(__FILE__)) . "/../../../../userfiles/".$directory."/x" . $file['name'] .'d'.$date . '.' . $ext);
		return "/userfiles/".$directory."/x" . $file['name'] .'d'.$date . '.' . $ext;
	}
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
	//endregion
	public function actionSubs()
	{$this->categories['subs']['active'] = true;
		$data['subs']=Subs::model()->findAll();
		if (file_exists(YiiBase::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.'userfiles'.DIRECTORY_SEPARATOR.'subs.csv')) {
			unlink(YiiBase::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR .'userfiles'.DIRECTORY_SEPARATOR. 'subs.csv');
		}
		$this->render('subs', $data);
	}

	public function actionDeleted_sub($id)
	{
		Subs::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('archive/subs')));
	}
}