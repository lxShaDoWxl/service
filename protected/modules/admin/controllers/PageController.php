

<?php

class PageController extends CController {
	public $baseUrl;
	public $isContent;
	public $login;
	public $title;
	public $categories;

	public function init() {
		$this->baseUrl = Yii::app()->request->baseUrl;
		$this->isContent = true;
		$session = new CHttpSession;
		$session->open();
		$this->login = $session['login'];
		$session->close();

		$this->title = 'Контент';
		$this->categories = array(
			'index' => array('title' => 'Страницы', 'url' => CHtml::normalizeUrl(array('page/'))),
			'jobs' => array('title' => 'Вакансии', 'url' => CHtml::normalizeUrl(array('page/jobs'))),
//            'actions' => array('title' => 'Акции', 'url' => CHtml::normalizeUrl(array('page/info', 'info'=>'actions'))),
//			'news' => array('title' => 'Новости', 'url' => CHtml::normalizeUrl(array('page/info', 'info'=>'news'))),
//			'article' => array('title' => 'Статьи', 'url' => CHtml::normalizeUrl(array('page/info', 'info'=>'article'))),
		);
	}

	public function actionIndex() {
		$this->categories['index']['active'] = true;
		$data['pages'] = Page::model()->findAll(array('order' => '`title`'));
		$this->render('pages', $data);
	}

	public function actionEditPage($id) {
		$data['page'] = Page::model()->findByPk($id);
		$this->renderPartial('editPage', $data);
	}

	public function actionSavePage($id) {
		$page = new Page;
		if(isset($id) && $id){
			$page = Page::model()->findByPk($id);
		}
		$page->attributes = $_POST;
        if (isset($_POST['img'])){
            $page->img= str_replace(array("\r", "\n", ""), '', $_POST['img']);
        }
		/*while(Page::model()->findByAttributes(array('url'=>$page->url))){
			$page->url = $this->increment_string($page->url, '_');
		}*/
		$page->save();

		$this->redirect(CHtml::normalizeUrl(array('page/')));
	}

	public function actionCreatePage() {
		$this->renderPartial('createPage');
	}

	public function actionDeletePage($id) {
		Page::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('page/')));
	}

	public function actionJobs()
	{
		$data['jobs']=Jobs::model()->findAll();
		$this->render('jobs', $data);
	}
	public function actionCreateJob()
	{
		$this->renderPartial('job');
	}
	public function actionEditJob($id)
	{
		$data['job']=Jobs::model()->findByPk($id);
		$this->renderPartial('job', $data);
	}
	public function actionSaveJob($id)
	{
		$page = new Jobs();
		if(isset($id) && $id){
			$page = Jobs::model()->findByPk($id);
		}
		$page->attributes = $_POST;
		/*while(Page::model()->findByAttributes(array('url'=>$page->url))){
			$page->url = $this->increment_string($page->url, '_');
		}*/
		$page->save();
		$this->redirect(CHtml::normalizeUrl(array('page/jobs')));
	}

	public function actionDeletedJob($id)
	{
		Jobs::model()->deleteByPk($id);
		$this->redirect(CHtml::normalizeUrl(array('page/jobs')));
	}
	public function actionStatusJob($id, $status)
	{
		$item = Jobs::model()->findByPk($id);
		$item->isVisible = $status;
		$item->save();
	}
	public function actionCreateExcel(){
		$subs=Subs::model()->findAll();

		foreach ($subs as $sub) {
			$results = $sub->name .';'. $sub->mail;
			unlink(YiiBase::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.'subs.csv');
			file_put_contents('subs.csv', $results."\n", FILE_APPEND);
		}
		rename('subs.txt', 'subs.csv');

		Yii::app()->end();
		return 'subs.csv';
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