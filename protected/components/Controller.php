<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    public $base_url;

    public function __construct($id,$module=null){
        parent::__construct($id,$module);
        $this->base_url=Yii::app()->request->baseUrl;
//		$cs = Yii::app()->getClientScript();
//		$cs->registerScriptFile('/js/main.js');
//		$cs->registerScriptFile('/js/humane.min.js');
//		$cs->registerScriptFile('/js/jquery.slideshow.js');
//		$cs->registerScriptFile('/js/jquery.infinitescroll.min.js');
//		$cs->registerCoreScript('jquery');
//		 if (Yii::app()->user->checkAccess('100')){
//			 $cs->registerScriptFile('/js/admin.js');
//		 }

    }
}