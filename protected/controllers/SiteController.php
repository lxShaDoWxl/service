<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    public $cat;
    public $bread;
    public $seo='';
    public $base_url;
	public $archive_rbk;
	public $archive_and;
	public $seo_default='AND';

    public function init(){
        $this->cat['main']=0;
        $this->cat['sub']=0;
        $this->base_url=Yii::app()->request->baseUrl;
		$this->archive_rbk=Book::model()->find('status=1 order by `date` DESC');
		$this->archive_and=Book::model()->find('status=2 order by `date` DESC');
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
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->seo=Seo::model()->findByAttributes(array('page'=>'index'));
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        /*$seo=Seo::model()->findByAttributes(array('page'=>'index'));
        $this->seo_keywords=($seo->keywords)?$seo->keywords:'';
        $this->seo_title=($seo->title)?$seo->title:'';
        $this->seo_description=($seo->description)?$seo->description:'';*/
		$data['article_themes']=Catalog::model()->findAllByAttributes(array('isVisible'=>1),array('order'=>'date DESC', 'limit'=>2) );
		$data['debate']=Debats::model()->findAll(array('condition'=>'`isVisible`=1 AND `date_end`>:date','params'=>array(':date'=>date('Y-m-d')),'order'=>'date_start ASC'));
		$data['experts']=Question::model()->findAll(array('condition'=>'isVisible=1 AND answer is NOT NULL','limit'=>5));
		$data['webinars']=Webinar::model()->findAll(array('condition'=>'isVisible=1', 'limit'=>3));
		$this->render('index', $data);
	}
	//region Статьи
	public function actionArticles(){
		$this->seo=Seo::model()->findByAttributes(array('page'=>'articles'));

		$this->seo_default='Статьи';
		$data['art_cat']=0;
        $q = new CDbCriteria();
        if(Yii::app()->getRequest()->getQuery('cat')){

            $q->addCondition('cid='.Yii::app()->getRequest()->getQuery('cat'));
			$data['art_cat']=Yii::app()->getRequest()->getQuery('cat');

        }
		$q->addCondition('isVisible=1');
        $q->order='date DESC';
        $count= Catalog::model()->count($q);
        $data['pages']=new CPagination($count);
        // элементов на страницу
        $data['pages']->pageSize=7;
        $data['pages']->applyLimit($q);
        $data['articles']=Catalog::model()->findAll($q);
        $data['category']=Category::model()->findAll();
        $this->render('articles', $data);
    }
    public function actionArticle($id){
		$this->seo=Seo::model()->findByAttributes(array('id_article'=>$id));
	    $value_art = isset(Yii::app()->request->cookies['art']) ? Yii::app()->request->cookies['art']->value : '';
		$view=false;
	    if ($value_art==true){
			$art=explode(',',$value_art);

				if(in_array ($id, $art)){
					$value_art=implode(',', $art);
				}else{
					$value_art=implode(',', $art);
					$value_art.=','.$id;
					$view=true;

				}
		}else{
			$value_art=$id;
			$view=true;
		}

		if($view){
			$visible=Catalog::model()->findByPk($id);
			$visible->view=$visible->view+1;
			$visible->save();
		}
		$temp = new CHttpCookie('art',$value_art);
		$temp->expire = time()+60*60*24*365;
		Yii::app()->request->cookies['art'] = $temp;
		$data['favorits']=false;
	    $data['article']=Catalog::model()->findByPk($id);
		$this->seo_default=$data['article']->title;
	    $data['article_themes']=Catalog::model()->findAllByAttributes(array('isVisible'=>1, 'cid'=>$data['article']->cid),'`id` NOT IN (:id)', array(':id'=>$id));
       	$favorits=$data['article']->favorites;
		foreach ($favorits as $value) {
			if(Yii::app()->user->getId()==$value->id_user){
				$data['favorits']=true;
			}
		}
		if(Yii::app()->getRequest()->getQuery('lang')){
			$data['lang']=Yii::app()->getRequest()->getQuery('lang');
		} else{
			$data['lang']='ru';
		}
        $this->render('article', $data);
    }

	public function actionArticleComment()
	{
		if(Yii::app()->getRequest()->getPost('id')){
			$comment= new CommentCatalog;
			$comment->catalog_id = Yii::app()->getRequest()->getPost('id');
			$comment->date= date('Y-m-d H:i');
//			для отображения Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm', $value->date)
//			1 ноября 2012 в 13:30
			$comment->author_id= Yii::app()->user->getId();
			$comment->comment = CHtml::encode(Yii::app()->getRequest()->getPost('comment'));
			$comment->save();
		}
		$this->redirect(CHtml::normalizeUrl(array('site/article', 'id'=> Yii::app()->getRequest()->getPost('id'))));
	}
	public function actionArtCommentAnswer($id)
	{
		if($id){
			$comment= new CommentAnswer();
			$comment->id_comment = $id;
			$comment->date= date('Y-m-d H:i');
			$comment->author_id= Yii::app()->user->getId();
			$comment->answer = CHtml::encode(Yii::app()->getRequest()->getPost('answer'));
			$comment->save();
			//echo json_encode(array('m'=>'ok'));
			$this->redirect(CHtml::normalizeUrl(array('site/article', 'id'=> $comment->idComment->catalog->id)));
			Yii::app()->end();
		}
	}

	public function actionFavorites()
	{
		$value=Favorites::model()->findByAttributes(
			array(
				'id_article'=>Yii::app()->getRequest()->getPost('id'),
				'id_user'=>Yii::app()->user->getId()
			));
		if($value!=true){
			$favorite= new Favorites();
			$favorite->id_article = Yii::app()->getRequest()->getPost('id');
			$favorite->id_user= Yii::app()->user->getId();
			if($favorite->save()){
				echo json_encode(array('m'=>true));
			} else{

				echo json_encode(array('m'=>false));
			}
			Yii::app()->end();
		}
	}
	//endregion
	//region Debate
	public function actionDebates()
	{
		$this->seo=Seo::model()->findByAttributes(array('page'=>'debats'));
		$this->seo_default='Дискусии';
		$data['debates']= Debats::model()->findAll('isVisible=1 AND `date_end` >= :date ORDER by `date_start` ASC', array(':date'=>date('Y-m-d')));
		if($data['debates']){
			$data['debates']= Debats::model()->findAll('isVisible=1 ORDER by `date_end` DESC');
		}
		$this->render('debates', $data);
	}
	public function actionDebate($id)
	{
		$this->seo=Seo::model()->findByAttributes(array('id_debats'=>$id));
		$value_art = isset(Yii::app()->request->cookies['deb']) ? Yii::app()->request->cookies['deb']->value : '';
		$view=false;
		if ($value_art==true){
			$art=explode(',',$value_art);

			if(in_array ($id, $art)){
				$value_art=implode(',', $art);
			}else{
				$value_art=implode(',', $art);
				$value_art.=','.$id;
				$view=true;

			}
		}else{
			$value_art=$id;
			$view=true;
		}

		if($view){
			$visible=Debats::model()->findByPk($id);
			$visible->view=$visible->view+1;
			$visible->save();
		}

		$temp = new CHttpCookie('deb',$value_art);
		$temp->expire = time()+60*60*24*365;
		Yii::app()->request->cookies['deb'] = $temp;
		$data['debate']= Debats::model()->findByPk($id);
		$this->seo_default=$data['debate']->title;
		$q = new CDbCriteria();
		$data['pages']=new CPagination(count($data['debate']->commentsDebats));
		// элементов на страницу
		$data['pages']->pageSize=10;
		$data['pages']->applyLimit($q);
		$data['comments']=$data['debate']->commentsDebats($q);
		$data['article_themes']=false;
		Yii::app()->request->cookies['com-'.$id] = new CHttpCookie('com-'.$id,count($data['debate']->commentsDebats));
		$answer=count(AnswerCommentDebat::model()->with(array('commentDebat'=>array('condition'=>'`debat_id`=:id','params'=>array(':id'=>$id), 'order'=>'comment_debat_id ASC')))->findAll());
		Yii::app()->request->cookies['answercom-'.$id] = new CHttpCookie('answercom-'.$id, $answer);
		$this->render('debate', $data);
	}

	public function actionUpdateDebateCom($id)
	{
		$count_comment = isset(Yii::app()->request->cookies['com-'.$id]) ? Yii::app()->request->cookies['com-'.$id]->value : 0;

		$comments= CommentsDebat::model()->findAllByAttributes(array('debat_id'=>$id),array('offset'=>$count_comment, 'limit'=>100));
		$i=0;
		foreach ($comments as $comment) {
			$data[]=$this->renderPartial('//layouts/ajaxComment', array('value_c'=>$comment, 'debat'=>$id), true);
			$i++;
		}
		if (isset($data)) {
			Yii::app()->request->cookies['com-'.$id] = new CHttpCookie('com-'.$id,$count_comment+$i);
			echo json_encode($data);
		}
	}

	public function actionUpdateDebateAnsw($id)
	{

		$count_answer = isset(Yii::app()->request->cookies['answercom-'.$id]) ? Yii::app()->request->cookies['answercom-'.$id]->value : 0;
		$answers= AnswerCommentDebat::model()->with('commentDebat')->findAll(array('condition'=>'`commentDebat`.`debat_id` = :id', 'params'=>array(':id'=>$id),'offset'=>$count_answer, 'limit'=>100));
		$i=0;
		foreach ($answers as $answer) {
			$data[$answer->comment_debat_id]=$this->renderPartial('//layouts/ajaxAnswer', array('value'=>$answer, 'debat'=>$id), true);
			$i++;
		}
		if (isset($data)) {
			Yii::app()->request->cookies['answercom-'.$id] = new CHttpCookie('answercom-'.$id,$count_answer+$i);
			echo json_encode($data);
		}

	}
	public function actionDebateComment()
	{

		if(Yii::app()->getRequest()->getPost('id')){
			$comment= new CommentsDebat();
			$comment->debat_id = Yii::app()->getRequest()->getPost('id');
			$comment->date= date('Y-m-d H:i');
//			для отображения Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm', $value->date)
//			1 ноября 2012 в 13:30
			$comment->author_id= Yii::app()->user->getId();
			$comment->comment =CHtml::encode( Yii::app()->getRequest()->getPost('comment'));
			$comment->save();
			if(Yii::app()->request->isAjaxRequest){
				$count_comment = isset(Yii::app()->request->cookies['com-'.$comment->debat_id]) ? Yii::app()->request->cookies['com-'.$comment->debat_id]->value : 0;
				Yii::app()->request->cookies['com-'.$comment->debat_id] = new CHttpCookie('com-'.$comment->debat_id,$count_comment+1);
				$data[]=$this->renderPartial('//layouts/ajaxComment', array('value_c'=>$comment, 'debat'=>Yii::app()->getRequest()->getPost('id')), true);
				echo json_encode($data);
			}
			else {
				$this->redirect(CHtml::normalizeUrl(array('site/debate', 'id'=> Yii::app()->getRequest()->getPost('id'))));
			}
		}


	}
	public function actionDebCommentAnswer($id)
	{
		if($id){
			$comment= new AnswerCommentDebat();
			$comment->comment_debat_id = $id;
			$comment->date= date('Y-m-d H:i');
			$comment->author_id= Yii::app()->user->getId();
			$comment->answer = CHtml::encode(Yii::app()->getRequest()->getPost('answer'));
			$comment->save();
			//echo json_encode(array('m'=>'ok'));

			if(Yii::app()->request->isAjaxRequest){
				$count_answer = isset(Yii::app()->request->cookies['answercom-'.$comment->commentDebat->debat_id]) ? Yii::app()->request->cookies['answercom-'.$comment->commentDebat->debat_id]->value : 0;
				Yii::app()->request->cookies['answercom-'.$comment->commentDebat->debat_id] = new CHttpCookie('answercom-'.$comment->commentDebat->debat_id,$count_answer+1);

				$data[$id]=$this->renderPartial('//layouts/ajaxAnswer', array('value'=>$comment, 'debat'=>$comment->commentDebat->debat_id), true);

				echo json_encode($data);
			}
			else {
				$this->redirect(CHtml::normalizeUrl(array('site/debate', 'id'=> $comment->commentDebat->debat->id)));
			}
		}
	}
	//endregion
	//region Мероприятия
	public function actionEvents()
	{
		$this->seo=Seo::model()->findByAttributes(array('page'=>'events'));
		$this->seo_default='Мероприятия';
		$q = new CDbCriteria();
		$q->addCondition('isVisible=1 AND `date` >"'.date('Y-m-d').'"');
		$q->order='date DESC';
		$count= Catalog::model()->count($q);
		$data['pages']=new CPagination($count);
		// элементов на страницу
		$data['pages']->pageSize=7;
		$data['pages']->applyLimit($q);
		$data['events']=Events::model()->findAll($q);
		$data['old_events']=Events::model()->findAll('isVisible=1 AND `date` <"'.date('Y-m-d').'" ORDER By date DESC');
		$this->render('events', $data);
	}
	public function actionEvent($id){
		$this->seo=Seo::model()->findByAttributes(array('id_events'=>$id));
		$value_art = isset(Yii::app()->request->cookies['event']) ? Yii::app()->request->cookies['event']->value : '';
		$view=false;
		if ($value_art==true){
			$art=explode(',',$value_art);

			if(in_array ($id, $art)){
				$value_art=implode(',', $art);
			}else{
				$value_art=implode(',', $art);
				$value_art.=','.$id;
				$view=true;

			}
		}else{
			$value_art=$id;
			$view=true;
		}

		if($view){
			$visible=Events::model()->findByPk($id);
			$visible->view=$visible->view+1;
			$visible->save();
		}
		$temp = new CHttpCookie('event',$value_art);
		$temp->expire = time()+60*60*24*365;
		Yii::app()->request->cookies['event'] = $temp;
		$data['event']=Events::model()->findByPk($id);
		$this->seo_default=$data['event']->title;
		$this->render('event', $data);
	}
	public function actionEventComment()
	{
		if(Yii::app()->getRequest()->getPost('id')){
			$comment= new CommentEvents();
			$comment->events_id = Yii::app()->getRequest()->getPost('id');
			$comment->date= date('Y-m-d H:i');
//			для отображения Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm', $value->date)
//			1 ноября 2012 в 13:30
			$comment->author_id= Yii::app()->user->getId();
			$comment->comment =CHtml::encode( Yii::app()->getRequest()->getPost('comment'));
			$comment->save();
		}
		$this->redirect(CHtml::normalizeUrl(array('site/event', 'id'=> Yii::app()->getRequest()->getPost('id'))));
	}
	public function actionEventCommentAnswer($id)
	{
		if($id){
			$comment= new CommentEventsAnswer();
			$comment->comment_id = $id;
			$comment->date= date('Y-m-d H:i');
			$comment->author_id= Yii::app()->user->getId();
			$comment->answer = CHtml::encode(Yii::app()->getRequest()->getPost('answer'));
			$comment->save();
			//echo json_encode(array('m'=>'ok'));
			$this->redirect(CHtml::normalizeUrl(array('site/event', 'id'=> $comment->comment->events_id)));
			Yii::app()->end();
		}
	}
	//endregion
	//region Вебинары
	public function actionWebinars()
	{
		$this->seo=Seo::model()->findByAttributes(array('page'=>'webinars'));
		$this->seo_default='Вебинары';
		$data['art_cat']=false;
		$data['cats']=ThemeWebinar::model()->findAll();
		$q = new CDbCriteria();
		$q_new =new CDbCriteria();
		if(Yii::app()->getRequest()->getQuery('cat')){

			$q->addCondition('id_theme='.Yii::app()->getRequest()->getQuery('cat'));
			$q_new->addCondition('id_theme='.Yii::app()->getRequest()->getQuery('cat'));
			$data['art_cat']=Yii::app()->getRequest()->getQuery('cat');

		}
		$q->addCondition('isVisible=1');
		$q->order='`date_start` DESC';
		$count= Webinar::model()->count($q);
		$data['pages']=new CPagination($count);
		// элементов на страницу
		$data['pages']->pageSize=7;
		$data['pages']->applyLimit($q);
		$data['webinars']=Webinar::model()->findAll($q);
		$q_new->addCondition('`isVisible`=1 AND `date_start`> :date');
		$q_new->params=array(':date'=>date('Y-m-d'));
		$q_new->order='`date_start` ASC';
		$q_new->limit=3;
		$data['webinars_new']= Webinar::model()->findAll($q_new);
		$this->render('webinars/index', $data);
	}

	public function actionWebinar($num)
	{
		//$this->seo=Seo::model()->findByAttributes(array('id_webinars'=>$num));
		$data['webinar']=Webinar::model()->findByPk($num);
		$this->seo_default=$data['webinar']->title;
		$this->render('webinars/view', $data);
	}
	//endregion
	public function actionAbout()
	{
		$data['urls']=Page::model()->findAll(array('index'=>'id'));
		$data['jobs']=Jobs::model()->findAll('isVisible=1');
		if(Yii::app()->getRequest()->getQuery('url')){
			if (Yii::app()->getRequest()->getQuery('url')=='archive') {
				$this->seo_default='Архив';
				$data['index']='archive';
				$data['list']=(Yii::app()->getRequest()->getQuery('arc'))?Yii::app()->getRequest()->getQuery('arc'):2;
				$date= Book::model()->findAllByAttributes(array('status'=>$data['list']),array('select'=>'date', 'order'=>'`date` DESC'));
				$cont_date=count($date)-1;
				$data['number_old']=Yii::app()->dateFormatter->format('yyyy', $date[0]->date);
				$data['number_one']=Yii::app()->dateFormatter->format('yyyy', $date[$cont_date]->date);
				if (Yii::app()->getRequest()->getQuery('god')) {
					$data['god']=Yii::app()->getRequest()->getQuery('god');
					$data['archives'] = Book::model()->findAllByAttributes(array('status' => $data['list'], 'date'=>(int)Yii::app()->getRequest()->getQuery('god')),array('order'=>'date DESC'));
				} else {
					$data['god']=$data['number_old'];
					$data['archives'] = Book::model()->findAllByAttributes(array('status' => $data['list'], 'date'=>(int)$data['god']),array('order'=>'date DESC'));
				}
			} elseif(Yii::app()->getRequest()->getQuery('url')=='sub'){
				$this->seo_default='Подписка';
				$data['index']='sub';
				$data['page'] = Page::model()->findByAttributes(array('url' => Yii::app()->getRequest()->getQuery('url')));
				$record=new Subs();
				if(Yii::app()->getRequest()->getPost('Subs')){
					$subs=Yii::app()->getRequest()->getPost('Subs');
					$checkUserEmail = Subs::model()->findByAttributes(array('mail' => $subs['mail']));
					if ($checkUserEmail==false) {
						$record->attributes = $subs;
						if ($record->validate()) {
							$record->save();
							$errors['m'] = CHtml::normalizeUrl(array('site/about'));
							echo json_encode($errors);
						} else {
							echo CActiveForm::validate($record);
						}
						Yii::app()->end();
					} else {
						$errors['Subs_mail']='Данный е-mail уже подписан на рассылку';
						echo json_encode($errors);
						Yii::app()->end();
					}
				}
			} else {
				$data['page'] = Page::model()->findByAttributes(array('url' => Yii::app()->getRequest()->getQuery('url')));
				$this->seo_default=$data['page']->title;
				$data['index'] = Yii::app()->getRequest()->getQuery('url');
			}
		} elseif(Yii::app()->getRequest()->getQuery('job')){
			$data['page']=Jobs::model()->findByPk(Yii::app()->getRequest()->getQuery('job'));
			$data['index']='about';
			$data['job']=Yii::app()->getRequest()->getQuery('job');
		} else{
			$data['page']=Page::model()->findByAttributes(array('url'=> 'about'));
			$data['index']='about';
		}
		$this->render('about',$data);
	}
	public function actionBanner($id)
	{
		$banner=Banner::model()->findByPk($id);
		$state= new BannerStat();
		$state->data= time();
		$state->id_banner=$banner->id;
		$state->save();
		if(Yii::app()->request->isAjaxRequest){
			echo CHtml::encode($banner->url);
			// Завершаем приложение
			Yii::app()->end();
		}
		else {
			// если запрос не асинхронный, отдаём форму полностью
			$this->redirect($banner->url);
		}

	}
	public function actionSave()
	{
		if(Yii::app()->user->checkAccess('100')){
			$model=Yii::app()->getRequest()->getPost('model');
			$fields=Yii::app()->getRequest()->getPost('fields');
			$record=$model::model()->findByPk(Yii::app()->getRequest()->getPost('pk'));
			$record->attributes=$fields;
			$record->save();
		}
	}
	public function actionDel()
	{
		if(Yii::app()->user->checkAccess('100')){
			$model=Yii::app()->getRequest()->getPost('model');
			$model::model()->deleteByPk(Yii::app()->getRequest()->getPost('pk'));
		}
	}
	public function actionExperts()
	{
		$this->seo_default='Экспертный совет';
		$data['art_cat']=0;
		$q = new CDbCriteria();
		$q->addCondition('`privileges`=77');
		$q->limit=10;

		$data['experts']=Users::model()->findAll($q);
		$data['themes']=QuestionTheme::model()->findAll();
		$q2 = new CDbCriteria();
		if(Yii::app()->getRequest()->getQuery('cat')){
			$q2->addInCondition('id_theme',array(Yii::app()->getRequest()->getQuery('cat')) );
		}
		$q2->addCondition('isVisible=1');
		$q2->order='`date` DESC';
		$count= Question::model()->count($q2);
		$data['pages']=new CPagination($count);
		// элементов на страницу
		$data['pages']->pageSize=30;
		$data['pages']->applyLimit($q2);

		$data['quests']=Question::model()->findAll($q2);
		$this->render('expert/index', $data);
	}
	public function actionExpert($id)
	{
		$this->seo_default='Эксперт';
		$data['expert']= Users::model()->findByPk($id);
		$this->render('expert/expert', $data);
	}
	public function actionExpertForm()
	{
		$this->seo_default='Вопрос эксперту';
		if(Yii::app()->getRequest()->getPost('Quest')) {
			$session = new CHttpSession;
			$session->open();
			$captcha=false;
			if(Yii::app()->getRequest()->getPost('captcha') == $session['captcha']){
				$captcha=true;
			}else{
				$data['Users_captcha'][]='Заполните слово для защиты от ботов';
				echo json_encode($data);
				Yii::app()->end();
			}
			$data['themes']=false;
			$data['experts']=false;
			$quest= new Question();
			$quest_send=Yii::app()->getRequest()->getPost('Quest');
			$quest->attributes=$quest_send;
			$quest->body=CHtml::encode($quest_send['body']);

			if(!Yii::app()->user->isGuest){
				$user =Users::model()->findByPk(Yii::app()->user->getId());
				$quest->id_user=Yii::app()->user->getId();
				$quest->user_mail=$user->mail;

			}
			$quest->date=date('Y-m-d H:i');
			if (!(json_decode(CActiveForm::validate($quest))) && $captcha) {
				$quest->save();
				$template=MailTemplate::model()->findByAttributes(array('name'=>'new_quest'));
				$template->body= str_replace('{name}', $quest->user_name?:$user->name, $template->body);
				$template->body= str_replace('{mail}', $quest->user_mail?:$user->mail, $template->body);
				$template->body= str_replace('{body}', $quest->body, $template->body);
				$template->body= str_replace('{name_expert}', $quest->idExpert->name, $template->body);
				$template->body= str_replace('{mail_expert}', $quest->idExpert->mail, $template->body);
				SendMail::Send($template->body,'info@and.kz', $quest->idExpert->mail,$template->mail_title);
				//SendMail::Send($template->body,'info@and.kz', Settings::model()->get('e-mail'),$template->mail_title);
				$data2['m']='ok';
				echo json_encode($data2);
				Yii::app()->end();
			}else{
				echo CActiveForm::validate($quest);
				Yii::app()->end();
			}



		}else{
			$data['themes']= QuestionTheme::model()->findAll();
			$data['experts']=Users::model()->findAll('`privileges`=77');
			if(Yii::app()->getRequest()->getQuery('id')){
				$data['expert_quest']=Users::model()->findByPk(Yii::app()->getRequest()->getQuery('id'));
			}
			$this->render('expert/form', $data);
		}

	}
	public function actionReguestThemes($id)
	{
		$theme=QuestionTheme::model()->findByPk($id);
		foreach ($theme->questionThemeExperts as $expert) {
			echo "<option value='". $expert->idExpert->id."'>".$expert->idExpert->name."</option>";
		}
	}
	public function actionSearch($search){
		$this->seo_default='Результат поиска';
		$data['search']=$search;
		$match = addcslashes($search, '%_'); // escape LIKE's special characters
		$data['list']='catalog';
		if(Yii::app()->getRequest()->getQuery('list')){
			$data['list']=Yii::app()->getRequest()->getQuery('list');
			if($data['list']=='catalog' ||$data['list']=='events'){
				$criteria=array(
					'condition' => "full_description LIKE :match OR title LIKE :match OR small_description LIKE :match AND isVisible=1",         // no quotes around :match
					'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
				);
			} elseif($data['list']=='debats'){
				$criteria=array(
					'condition' => "body LIKE :match AND isVisible=1",         // no quotes around :match
					'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
				);
			}
		}else{
			$criteria=array(
				'condition' => "full_description LIKE :match OR title LIKE :match OR small_description LIKE :match AND isVisible=1",         // no quotes around :match
				'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
			);
		}
		$class=ucfirst($data['list']);
		$q = new CDbCriteria($criteria);
		$count=$class::model()->count($q);
		$data['pages']=new CPagination($count);
		// элементов на страницу
		$data['pages']->pageSize=20;
		$data['pages']->applyLimit($q);
		$data['items']=$class::model()->findAll($q);

		$this->render('search', $data);
	}
//	старое
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
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new OrderForm;
		if(isset($_POST['OrderForm']))
		{
			$model->attributes=$_POST['OrderForm'];
			if($model->validate()&& preg_match("/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/", $_POST['mail']))
			{
                $body= MailTemplate::model()->findByAttributes(array('name'=>'callback'))->body;


                $body= str_replace('{name}', $_POST['name'], $body);
                $body= str_replace('{phone}',$_POST['phone'], $body);
                $body= str_replace('{mail}', $_POST['mail'], $body);
                $body= str_replace('{message}', $_POST['message'], $body);
                $this->SendMail($body, $_POST['name'], Settings::get('e-mail')->value, 'Новый сообщение на сайте');
                echo 'OK';
			}
		} else {
            $this->render('contact',array('model'=>$model));
        }

	}


}