<?php

class SettingsController extends CController {
	public $baseUrl;
	public $isSettings;
	public $login;
	public $title;
	public $categories;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isSettings = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$groups=Settings::model()->findAll(array('select'=>'`group`', 'order'=>'`group`'));
		$this->title = 'Настройки';
		$this->categories = array(
				'index' => array('title' => 'Все', 'url' => CHtml::normalizeUrl(array('settings/'))),
                'mailTemplate'=>array('title'=> 'Шаблоны уведомлений', 'url'=> CHtml::normalizeUrl(array('settings/MailTemplate'))),
//                'slider' => array('title' => 'Слайдер', 'url' => CHtml::normalizeUrl(array('settings/slider'))),
				'EditSeo' => array('title' => 'SEO', 'url' => CHtml::normalizeUrl(array('settings/EditSeo')), 'ajax'=>true),
				'topMenu' => array('title' => 'Меню', 'url' => CHtml::normalizeUrl(array('settings/topMenu'))),
//				'bottomMenu' => array('title' => 'Нижнее Меню', 'url' => CHtml::normalizeUrl(array('settings/bottomMenu'))),
		);
		foreach ($groups as $group) {
			$this->categories[$group['group']] = array('title' => $group['group'], 'url' => CHtml::normalizeUrl(array('settings/', 'group'=>$group['group'])));
		}
	}

	public function actionIndex() {
		$data = array();

		if (!isset($_GET['group'])) {
			$this->categories['index']['active'] = true;
			$data['settings'] = Settings::model()->findAll(array('order' => '`title`'));
		} else {
			$this->categories[$_GET['group']]['active'] = true;
			$data['settings'] = Settings::model()->findAllByAttributes(array('group' => $_GET['group']), array('order' => '`title`'));
		}
		
		$this->render('settings', $data);
	}

    public function actionMailTemplate(){
        $this->categories['mailTemplate']['active'] = true;
        $data['mail']= MailTemplate::model()->findAll();
        $this->render('mail', $data);
    }
    public function actionEditMailTemplate($action, $id){
           if($action=='edit'){
               $data['mail'] = MailTemplate::model()->findByPk($id);
               $this->layout = "blank";
               $this->render('editMail', $data);
           }
           else if ($action=='save'){
               $mail = MailTemplate::model()->findByPk($id);
               $mail->attributes = $_POST;
               $mail->save();
               $this->redirect(CHtml::normalizeUrl(array('settings/MailTemplate')));
           }
           else if ($action=='deleted'){
               $model = MailTemplate::model()->findByPk($id);
               $model->delete();
               $this->redirect(CHtml::normalizeUrl(array('settings/MailTemplate')));
           }


    }
    public function actionUploadIcon() {
        foreach ($_FILES as $file) {
            if($file['tmp_name']) {
                echo $this->uploadImage($file, $_GET['f']);
            }
        }
    }
	public function actionUpdate() {
		$this->layout = "blank";
		$data['settings'] = Settings::model()->findByPk($_GET['id']);
		$this->render('edit', $data);
	}

	public function actionSave() {
		$settings = Settings::model()->findByPk($_GET['id']);
		if ($settings->type == "image") {
			if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']) {
				$settings->value = $this->uploadImage($_FILES['file'], 'settings');
			}
		} else {
			$settings->value = $_POST['value'];
		}
		$settings->save();	
		$this->redirect(CHtml::normalizeUrl(array('settings/')));
	}

	public function uploadImage($file, $directory) {
		$date = date('YmdHis');
		$i = rand(1, 100000);
		$ext = end(explode(".", $file['name']));
		move_uploaded_file($file['tmp_name'], 
		realpath(dirname(__FILE__)) . "/../../../../userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext);
		return "/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext;
	}

	public function actionTopMenu(){
		$this->categories['topMenu']['active'] = true;
		$data['topitems'] = Menu::model()->findAllByAttributes(array('location' => 'header'));
		$this->render('topMenu', $data);
	}	

	public function actionBottomMenu(){
		$this->categories['bottomMenu']['active'] = true;
		$data['bottomitems'] = Menu::model()->findAllByAttributes(array('location' => 'footer'));
		$this->render('bottomMenu', $data);
	}	

	public function actionAddToMenu(){
		$this->layout = "blank";
		$this->render('addToMenu', $_GET);
	}

	public function actionSaveToMenu($id){

		$menu = new Menu();
		if($id!='new'){
			$menu = Menu::model()->findByPk($id);
		}
		$menu->attributes = $_POST;
		$menu->save();
		if($_POST['location'] == 'header')
			$this->redirect(CHtml::normalizeUrl(array('settings/topMenu')));
		else if($_POST['location'] == 'footer')
			$this->redirect(CHtml::normalizeUrl(array('settings/bottomMenu')));
	}

	public function actionEditMenu(){
		$data['pos'] = $_GET['pos'];
		$data['menu'] = Menu::model()->findByPk($_GET['id']);
		$this->renderPartial('addToMenu', $data);
	}
    public function actionEditSeo(){
		$this->categories['EditSeo']['active'] = true;
        $data['main'] = Seo::model()->findAll('page is not null');
        $data['articles']= Catalog::model()->findAll();
		$data['debats']= Debats::model()->findAll();
		$data['events']=Events::model()->findAll();

        $this->renderPartial('editSeo', $data);
    }
    public function actionSaveSeo(){
		$seos=Yii::app()->getRequest()->getPost('seo');
		foreach ($seos as $seo) {
			if(isset($seo['id'])){
				$record=Seo::model()->findByPk($seo['id']);
			} else{
				$record= new Seo();
			}
			$record->attributes=$seo;
			$record->save();
		}

		$this->redirect(CHtml::normalizeUrl(array('settings/')));
    }
	public function actionDeleteMenu($id){
		$model = Menu::model()->findByPk($id);
		$model->delete();
		if($model->location == 'header')
			$this->redirect(CHtml::normalizeUrl(array('settings/topMenu')));
		else if($model->location == 'footer')
			$this->redirect(CHtml::normalizeUrl(array('settings/bottomMenu')));
	}
    public function actionSelect($location){
        $data = Menu::model()->findAllByAttributes(array('location' => $location), array('order'=>'position'));
        $this->layout = "blank";
        $this->render('SelectMenu', array('items'=>$data, 'location'=>$location));
    }
    public function actionSaveSelect($location){

        foreach ($_POST as $key => $value )
        {
//            $menu = Menu::model()->findByPk($key);
            Menu::model()->updateByPk($key, array('position'=>$value));
//            $menu->position = $value;
//            $menu->save();
        }
        if($location == 'header')
            $this->redirect(CHtml::normalizeUrl(array('settings/topMenu')));
        else if($location == 'footer')
            $this->redirect(CHtml::normalizeUrl(array('settings/bottomMenu')));

    }
}		
