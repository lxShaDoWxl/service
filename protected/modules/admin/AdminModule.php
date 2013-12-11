<?php

class AdminModule extends CWebModule
{

	public function init()
	{
		$this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
		$this->layout = 'main';
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
//		if (!Yii::app()->user->checkAccess('admin')){
//			if(Yii::app()->user->isQuest){
//				Yii::app()->user->loginRequired();
//			}else{
//				throw new CHttpException(403,'Доступ запрещен!');
//			}
//		}
		if(parent::beforeControllerAction($controller, $action))
		{
			$session = new CHttpSession;
			$session->open();
			if (isset($controller->title) && !isset($session['id'])) {
				header("Location: ". CHtml::normalizeUrl(array('/admin')));
			} 
			return true;
		}
		else
			return false;
	}
}
