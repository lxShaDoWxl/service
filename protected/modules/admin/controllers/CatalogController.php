<?php

class CatalogController extends CController
{
	public $baseUrl;
	public $isCatalog;
	public $login;
	public $title, $categories;

	public function init() {

		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isCatalog = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$this->title = 'Каталог';
		$this->categories = array(
			'index' => array('title' => 'Статьи', 'url' => CHtml::normalizeUrl(array('catalog/'))),
			'webinars' => array('title' => 'Вебинары', 'url' => CHtml::normalizeUrl(array('catalog/webinars'))),
			'debats' => array('title' => 'Дискусии', 'url' => CHtml::normalizeUrl(array('catalog/debats'))),
			'events' => array('title' => 'Мероприятия', 'url' => CHtml::normalizeUrl(array('catalog/events'))),
			'banners'=> array('title' => 'Баннеры', 'url' => CHtml::normalizeUrl(array('catalog/banners')))

		);
	}

	public function actionIndex() {
		$this->categories['index']['active'] = true;
		$data['categories'] = Category::model()->findAll();
		$this->render('catalog', $data);
	}
	public function actionFilter() {
		if(isset($_POST['filter'])){

			$filter = $_POST['filter'];
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
			$data['itemCount'] = $this->count($params);
			$criteria = new CDbCriteria();
			$criteria->order = 'date desc';
			if(isset($params['limit'])) $criteria->limit = $params['limit'];
			if(isset($params['offset'])) $criteria->offset = $params['offset'];
			if(isset($params['category'])){
				$criteria->addCondition('cid = '. $params['category']);

			}
			if(isset($params['subcategory'])) $criteria->addCondition('cid = '.$params['subcategory']);
			$menu = null;
			$data['items'] = Catalog::model()->findAll($criteria);
			$this->renderPartial('loaditems',$data);
		}
	}
	private function count($params){
		$criteria = new CDbCriteria();
		$criteria->order = 'id desc';
		if(isset($params['category'])){

			$criteria->addCondition('cid = '. $params['category']);

		}
		if(isset($params['subcategory'])) $criteria->addCondition('cid = '.$params['subcategory']);
		$menu = null;
		$data['items'] = Catalog::model()->findAll($criteria);
		return count($data['items']);
	}

	//region Управление категориями
	public function actionCreateCategory() {
	//	$this->layout = "blank";
		//$this->render('createCategory');
		$this->renderPartial('createCategory');
	}
	public function actionEditCategory() {
		$data['category'] = Category::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$this->renderPartial('editCategory', $data);
	}
    public function actionSaveCategory() {
        if(Yii::app()->getRequest()->getQuery('id') == 'new')
            $record = new Category;
        else $record = Category::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
        $record->attributes = $_POST;
        $record->save();
        $this->redirect(CHtml::normalizeUrl(array('catalog/')));
    }
    public function actionDeleteCategory() {
        Category::model()->deleteByPk(Yii::app()->getRequest()->getQuery('id'));

        $this->redirect(CHtml::normalizeUrl(array('catalog/')));
    }
	//endregion

	//region Управление статьями
	public function actionCreateArticle() {

		$data['cat_id'] = Yii::app()->getRequest()->getQuery('cat_id');
		$data['authors']= Users::model()->findAll();
		$data['archives']= Book::model()->findAll();
		$this->renderPartial('article/createArticle', $data);
	}
    public function actionEditArticle() {

        $data['cats'] = Category::model()->findAll();
        $data['item'] = Catalog::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		$data['authors']= Users::model()->findAll();
		$data['archives']= Book::model()->findAll();
        $this->renderPartial('article/editArticle', $data);
    }
    public function actionSaveArticle(){
        if(Yii::app()->getRequest()->getQuery('id') == 'new'){
			$record = new Catalog;
		}
        else {
			$record = Catalog::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
			$old=true;
		}

        $record->attributes = $_POST;
        $record->save();
       // if ($_POST['img_url']) $record->img_url= str_replace(array("\r", "\n", ""), '', $_POST['img_url']);
		if(Yii::app()->getRequest()->getPost('archive')){
			if($record->bookArticle){
				$archive=$record->bookArticle;
				$archive->book_id= Yii::app()->getRequest()->getPost('archive');
				$archive->save();
			} else{
				$archive=new BookArticle();
				$archive->article_id=$record->id;
				$archive->book_id= Yii::app()->getRequest()->getPost('archive');
				$archive->save();
			}
		} elseif(isset($old) && !Yii::app()->getRequest()->getPost('archive')){
			if($record->bookArticle){
				$archive=$record->bookArticle;
				$archive->delete();
			}
		}
        if(isset($_POST['imgs_url'])){
            $images = strtok($_POST['imgs_url'], ',');
            while($images) {
                $imageRecord = new ItemImage;
                $imageRecord->desc = $record->small_description;
                if ($images) {
                    $imageRecord->img_url =str_replace(array("\r", "\n", ""), '', $images);

                }
                $imageRecord->title = $record->title;
                $imageRecord->item_id = $record->id;
                $imageRecord->position = 0;
                $imageRecord->save();
                $images = strtok(',');
            }
        }
        if (isset($_POST['images']) && $_POST['images']) {
            foreach ($_POST['images'] as $key => $value) {
                $id = $key;
                if ($_POST['images'][$id]['is_deleted'] == 1) {
                    ItemImage::model()->deleteByPk($id);
                    continue;
                }
                $itemImage = ItemImage::model()->findByPk($id);
                $itemImage->position = $_POST['images'][$id]['position'];
                $itemImage->save();
            }
        }

        $this->redirect(CHtml::normalizeUrl(array('catalog/')));
    }
    public function actionDeleteArticle(){
        $item =Catalog::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
        if(isset($item->itemImages[0]->img_url)&& file_exists(YiiBase::getPathOfAlias('webroot').$item->itemImages[0]->img_url)){
            unlink(YiiBase::getPathOfAlias('webroot').$item->itemImages[0]->img_url);
        }

            $item->delete();
            $this->redirect(CHtml::normalizeUrl(array('catalog/')));
    }
	//endregion

	//region Дискусии
	public function actionDebats()
	{
		$this->categories['debats']['active'] = true;
		$data['debats'] = Debats::model()->findAll();
		$this->render('debate/debats', $data);
	}
	public function actionCreateDebat()
	{
		$data['experts']=Users::model()->findAll('privileges=77');
		$this->renderPartial('debate/createDebat', $data);
	}

	public function actionEditDebat($id)
	{
		$data['experts']=Users::model()->findAll('privileges=77');
		$data['debat']= Debats::model()->findByPk($id);
		$this->renderPartial('debate/editDebat', $data);
	}
	public function actionSaveDebat()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new'){
			$record = new Debats();
		}
		else {
			$record = Debats::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}

		$record->attributes = $_POST;
		if(Yii::app()->getRequest()->getPost('experts')){
			$experts=Yii::app()->getRequest()->getPost('experts');
			if ($record->connectDebats) {
				ConnectDebat::model()->deleteAllByAttributes(array('id_debat'=>$record->id));
			}
			foreach ($experts as $value) {
				$expert = new ConnectDebat();
				$expert->id_user=$value;
				$expert->id_debat=$record->id;
				$expert->save();
			}
		} else{
			ConnectDebat::model()->deleteAllByAttributes(array('id_debat'=>$record->id));
		}
		 if (Yii::app()->getRequest()->getPost('img')) $record->img= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('img'));
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('catalog/debats')));
	}

	public function actionDeletedDebat($id)
	{
		$item =Debats::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		if(isset($item->img)&& file_exists(YiiBase::getPathOfAlias('webroot').$item->img)){
			unlink(YiiBase::getPathOfAlias('webroot').$item->img);
		}

		$item->delete();
		$this->redirect(CHtml::normalizeUrl(array('catalog/debats')));
	}
	//endregion

	//region Управление баннерами
	public function actionBanners()
	{
		$this->categories['banners']['active'] = true;
		$data['banners']=Banner::model()->findAll(array('order'=>'date_end DESC'));
		$this->render('banner/banners', $data);
	}

	public function actionCreateBanner()
	{
		$this->renderPartial('banner/createBanner');
	}

	public function actionEditBanner($id)
	{
		$data['banner']=Banner::model()->findByPk($id);
		$this->renderPartial('banner/editBanner', $data);
	}

	public function actionSaveBanner()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new'){
			$record = new Banner();
		}
		else {
			$record = Banner::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}

		$record->attributes = $_POST;
		if (Yii::app()->getRequest()->getPost('img')) $record->img= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('img'));
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('catalog/banners')));
	}
	public function actionDeletedBanner($id)
	{
		$item =Banner::model()->findByPk($id);
		if(isset($item->img)&& file_exists(YiiBase::getPathOfAlias('webroot').$item->img)){
			unlink(YiiBase::getPathOfAlias('webroot').$item->img);
		}

		$item->delete();
		$this->redirect(CHtml::normalizeUrl(array('catalog/banners')));
	}
	//endregion

	//region Управление мероприятиями
	public function actionEvents()
	{
		$this->categories['events']['active'] = true;
		$data['events']=Events::model()->findAll();
		$this->render('event/events', $data);
	}
	public function actionCreateEvent()
	{
		$this->renderPartial('event/create');
	}

	public function actionEditEvent($id)
	{
		$data['event']=Events::model()->findByPk($id);
		$this->renderPartial('event/edit', $data);
	}
	public function actionSaveEvent()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new'){
			$record = new Events();
		}
		else {
			$record = Events::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}
		$record->attributes = $_POST;
		if (Yii::app()->getRequest()->getPost('img')) $record->img= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('img'));
		$record->save();
		if(Yii::app()->getRequest()->getPost('video')){
			$video=Yii::app()->getRequest()->getPost('video');
			if ($video['new']) {
				foreach ($video['new'] as $value) {
					$media_record = new EventMedia();
					$media_record->type = 'video';
					$media_record->id_event = Yii::app()->getRequest()->getQuery('id');
					$media_record->url = $value;
					$media_record->save();
				}
			}
			if (isset($video['old'])) {
				foreach ($video['old'] as $key => $value) {
					$media_record = EventMedia::model()->findByPk($key);
					if ($value) {
						$media_record->url = $value;
					} else {
						$media_record->delete();
					}
					$media_record->save();
				}
			}
		}
		$this->redirect(CHtml::normalizeUrl(array('catalog/events')));
	}

	public function actionEventMedia()
	{
//'data':{'id':id,'action':e,'url':url, 'id_event':<?=$event->id

		if(Yii::app()->getRequest()->getPost('action')=='add'){
			$record= new EventMedia();
			$record->id_event=Yii::app()->getRequest()->getPost('id_event');
			$record->url= str_replace(array("\r", "\n", ""), '', Yii::app()->getRequest()->getPost('url'));
			$record->type='img';
			$record->save();
		}
		if(Yii::app()->getRequest()->getPost('action')=='del'){
			$record= EventMedia::model()->findByPk(Yii::app()->getRequest()->getPost('id'));
			if(isset($record->url)&& file_exists(YiiBase::getPathOfAlias('webroot').$record->url)){
				unlink(YiiBase::getPathOfAlias('webroot').$record->url);
			}
			$record->delete();
		}
	}
	public function actionDeletedEvent($id)
	{
		$del=Events::model()->findByPk($id);
		if(isset($del->img)&& file_exists(YiiBase::getPathOfAlias('webroot').$del->img)){
			unlink(YiiBase::getPathOfAlias('webroot').$del->img);
		}
		$del->delete();
		$this->redirect(CHtml::normalizeUrl(array('catalog/events')));
	}
	//endregion

	//region Вебинары
	public function actionWebinars()
	{
		$this->categories['webinars']['active'] = true;
		$data['themes']=ThemeWebinar::model()->findAll();
		$this->render('webinar/webinars', $data);
	}
	public function actionFilterWebinar() {
		if(isset($_POST['filter'])){

			$filter = $_POST['filter'];
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
			$data['itemCount'] = $this->countWebinar($params);
			$criteria = new CDbCriteria();
			$criteria->order = 'id desc';
			if(isset($params['limit'])) $criteria->limit = $params['limit'];
			if(isset($params['offset'])) $criteria->offset = $params['offset'];
			if(isset($params['category'])){
				$criteria->addCondition('id_theme = '. $params['category']);

			}
			$data['items'] = Webinar::model()->findAll($criteria);
			$this->renderPartial('webinar/loaditems',$data);
		}
	}
	private function countWebinar($params){
		$criteria = new CDbCriteria();
		$criteria->order = 'id desc';
		if(isset($params['category'])){

			$criteria->addCondition('id_theme = '. $params['category']);

		}
		$data['items'] = Webinar::model()->findAll($criteria);
		return count($data['items']);
	}
	public function actionWebinar()
	{
		if(Yii::app()->getRequest()->getQuery('id')){
			$data['item']= Webinar::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}
		if(Yii::app()->getRequest()->getQuery('theme_id')){
			$data['id_theme']=Yii::app()->getRequest()->getQuery('theme_id');
		}
		$data['experts']=Users::model()->findAll('privileges=77');
		$this->renderPartial('webinar/webinar', $data);
	}

	public function actionWebinarVisible($id,$status)
	{
		$item = Webinar::model()->findByPk($id);
		$item->isVisible = $status;
		$item->save();
	}
	public function actionDeletedWebinar($id)
	{
		Webinar::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('catalog/webinars')));
	}
	public function actionSaveWebinar()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new')
			$record = new Webinar();
		else {
			$record = Webinar::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}
		$record->attributes = Yii::app()->getRequest()->getPost('item');
		$record->time=implode('-',Yii::app()->getRequest()->getPost('time'));
		$record->save();

		if(Yii::app()->getRequest()->getPost('experts')){
			$experts=Yii::app()->getRequest()->getPost('experts');
			if ($record->connectWebinars) {
				ConnectWebinar::model()->deleteAllByAttributes(array('id_webinar'=>$record->id));
			}
			foreach ($experts as $value) {
				$expert = new ConnectWebinar();
				$expert->id_pred=$value;
				$expert->id_webinar=$record->id;
				$expert->save();

			}
		} else{
			ConnectWebinar::model()->deleteAllByAttributes(array('id_webinar'=>$record->id));
		}
		$this->redirect(CHtml::normalizeUrl(array('catalog/webinars')));
	}
	public function actionThemeWebinar()
	{
		$data=false;
		if(Yii::app()->getRequest()->getQuery('id')){
			$data['theme']= ThemeWebinar::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
		}
		$this->renderPartial('webinar/theme', $data);
	}

	public function actionDeletedThemeWebinar($id)
	{
		ThemeWebinar::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('catalog/webinars')));
	}
	public function actionSaveThemeWebinar()
	{
		if(Yii::app()->getRequest()->getQuery('id') == 'new')
			$record = new ThemeWebinar();
		else $record = ThemeWebinar::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));

		$record->attributes = Yii::app()->getRequest()->getPost('theme');
		$record->save();
		$this->redirect(CHtml::normalizeUrl(array('catalog/webinars')));
	}
	//endregion
	public function uploadImage($file, $directory) {
		$date = date('YmdHis');
		$i = rand(1, 100000);
		$ext = end(explode(".", $file['name']));
		move_uploaded_file($file['tmp_name'],
		YiiBase::getPathOfAlias('webroot') . "/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext);
		return "/userfiles/".$directory."/x" . $i .'d'.$date . '.' . $ext;
	}
	public function actionUploadIcon() {
		foreach ($_FILES as $file) {
			if($file['tmp_name']) {
				echo $this->uploadImage($file, $_GET['f']);
			}
		}
	}
	public function actionUpdateCategoryOrder() {
		$record = Category::model()->findByPk($_GET['id']);
		$record->order = $_GET['order'];
		$record->save();
	}

	public function actionChangeItemVisibility() {
		$id = $_GET['id'];
		$status = $_GET['status'];
		$item = Catalog::model()->findByPk($id);
		$item->isVisible = $status;
		$item->save();
	}
}