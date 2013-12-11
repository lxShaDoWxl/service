<?php

class MediaController extends Controller
{
	public $cat;
	public $bread;
	public $seo='';
	public $seo_default='AND';
	public $base_url;
	public $archive_rbk;
	public $archive_and;

	public function init(){
		$this->cat['main']=0;
		$this->cat['sub']=0;
		$this->base_url=Yii::app()->request->baseUrl;
		$this->archive_rbk=Book::model()->find('status=1 order by `date` ASC');
		$this->archive_and=Book::model()->find('status=2 order by `date` ASC');
	}
	public function actionIndex($id)
	{
		$data['media']= EventMedia::model()->findByPk($id);
		$this->render('index', $data);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}