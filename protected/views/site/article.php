<div class="grid_m_left"> <!-- LEFT COLUMN -->
	<p class="breadcrumbs"><a href="<?= CHtml::normalizeUrl(array('site/articles'))?>" style="font-size: 13px">Статьи</a>
	<ul class="clearfix" style="font-size: 13px">
		<li style="width: 30%;  margin-right: 0; float: left;">
			<? if ($article->author): ?>
				<div class="db_speaker" style="float:left;width: 100%;">
					<? if ($article->author0->usersImage): ?>
						<div class="db_s_img"><img width="54px" height="54px" src="<?= $article->author0->img() ?>">
						</div>
					<? endif ?>
					<div class="db_s_inf" style="float: left;width: 66%;">
						<h4><?= $article->author0->name ?></h4>

						<p><?= $article->author0->position ?></p>
					</div>
				</div>
			<? endif ?>
		</li>
		<li style="float: left;color: #262626; width: 29%; font: 11px/13px Arial;">
			<?= Yii::app()->dateFormatter->format('d MMMM yyyy', $article->date) ?>
			<div style="font-size: 13px;float: right;">
				<? if ($article->full_description_kz): ?>
					<? if ($lang == 'kz'): ?>
						<a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $article->id)) ?>"
						   style="padding-right: 10px;">Русский </a>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $article->id, 'lang' => 'kz')) ?>"
						   style="padding-right: 10px;">Казакша </a>
					<?endif ?>
				<? endif ?>

				<? if ($article->full_description_en): ?>
					<? if ($lang == 'en'): ?>
						<a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $article->id)) ?>">Русский </a>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $article->id, 'lang' => 'en')) ?>">
							English </a>
					<? endif ?>
				<? endif ?>
			</div>
		</li>
		<li style="float: right;color: #262626; width: 31%; font: 11px/13px Arial;">
			<div class="widgets">
				<?if(!Yii::app()->user->isGuest): ?>
					<a data-id="<?=$article->id?>" <?=($favorits)?'':'id="favorites"'?> class="widget" href="#" <?=($favorits)?'style="color: #3b3bc7;"':''?>>t<span id="favor" <?=($favorits)?'style="color: #3b3bc7;"':''?>><?=($favorits)?'В избранном':'В избранное'?></span></a>
				<? endif; ?>
				<a class="widget" >X<span><?= $article->view?></span></a>
				<a class="widget" href="#" id="comment_scroll">s<span><?=count($article->commentCatalogs)?></span></a>
			</div>
		</li>
	</ul>
    <div class="grid_m_left_left" <?=($article_themes==true)? '':'style="width: 97%;"'?>>
        <div class="discussion_box clearfix" ><!-- START DISCUSSINS -->
            <div class="grid_m_left_left" style="width: 100%;margin-top: 5%;">
                <h2 class="art_title_main"><?= $article->title?></h2>
                <div class="discussion_box clearfix"><!-- START DISCUSSINS -->
                    <div style="float: left;"><img src="<?=$article->img()?>" width="100%">
						<?
						switch($lang):
							case 'ru':
								echo $article->full_description;
								break;
							case 'en':
								echo $article->full_description_en;
								break;
							case 'kz':
								echo $article->full_description_kz;
								break;
						endswitch;
						?>

						<? if ($article->bookArticle): ?>
							<div class="book_art">
								<div class="book">
									<div class="img_book"><img width="69px" src="<?=$article->bookArticle->book->img?>">
									</div>
									<a href="<?=$article->bookArticle->book->url?>" style="font: 16px/18px FTN65;text-decoration: underline;">Читать дальше</a>
									<h4>в издании <?=$article->bookArticle->book->stats()?> №<?=$article->bookArticle->book->number?> от <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $article->bookArticle->book->date) ?></h4>
									<p style="font: 11px/16px Arial;color: #808080;"><?= $article->bookArticle->book->exist() .', '. $article->bookArticle->book->formatSize();?></p>
								</div>
							</div>
						<? endif ?>
						<div class="soc_box">
							<ul>
								<li style="width: 100%;
padding-bottom: 2%;">
									<div class="fb-like" data-width="100%"  data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
								</li>
								<li style="padding-right: 1%;">
									<a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
								</li>
								<li style="padding-right: 1%;">
									<? $this->widget('application.components.ysc.vkontakte.VkontakteShareButton', array('text'=>'Мне Нравится'));?>
								</li>
								<li style="width: 26%;">
									<a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{'cm' : '1', 'sz' : '20', 'st' : '2', 'tp' : 'mm'}">Нравится</a>
									<script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
								</li>
							</ul>


						</div>
                    </div>

                </div>

            </div>


        </div><!-- END DISCUSSINS -->

        <div class="comments">
            <div class="title_comment"><h3>Комментарии к статье (<?=($article->commentCatalogs)? count($article->commentCatalogs):0?>)</h3></div>
            <div class="comments_section">
	            <? if ($article->commentCatalogs): ?>
					<ul class="commentl_box"><!-- START ACTUAL -->
		            <? foreach($article->commentCatalogs as $value_c): ?>

							<li>
								<div class="author_com">
									<div class="author_img"><img width="54px" src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value_c->author->img())); ?>">
									</div>
									<h4><?=$value_c->author->name?></h4>
									<p class="position"><?= isset($value_c->author->position)?$value_c->author->position:'' ?></p>
									<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value_c->date) ?></p>
								</div>
								<div style="float: left;width: 69%;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentCatalog" data-pk="'.$value_c->id.'" data-field="comment"':''?>><?=$value_c->comment?></p>
									<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
								<? if (!Yii::app()->user->isGuest && !($value_c->author->id==Yii::app()->user->getId())): ?>
									<div class="send_comment">
										<a href="#" data-id="<?= $value_c->id ?>" class="answer_comment">Ответить</a>
									</div>
								<? endif ?>
								<? if ($value_c->commentAnswers): ?>
										<? foreach($value_c->commentAnswers as $value): ?>
    											<div class="author_answer">
													<div class="author_com" style="padding-top: 1%; overflow: hidden;">
														<div class="author_img"><img width="54px" src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value->author->img())); ?>"> </div>
														<h4><?= $value->author->name ?></h4>

														<p class="position"><?= isset($value->author->position) ? $value->author->position : '' ?></p>

														<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date) ?></p>
													</div>
    											<div style="float: left;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentAnswer" data-pk="'.$value->id.'" data-field="answer"':''?>><?= $value->answer ?></p> <?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
												</div>
										<? endforeach ?>
								<? endif ?>
								<div id="answer_comment-<?=$value_c->id?>" class="comment-block js-comment-form js-dynamic-form" style="float: right; display: none;width: 69%;">
									<form method="post" enctype="multipart/form-data" action="<?= CHtml::normalizeUrl(array('site/ArtCommentAnswer', 'id'=>$value_c->id)) ?>" class="add-comments-container">
										<div class="add-comments-field">
											<div class="add-comments-field-inner">
												<textarea cols="30" rows="10" placeholder="Ваш ответ..." name="answer" class="js-text"></textarea>
											</div>
										</div>
										<div class="add-comments-buttons" style="width: 85%;">
											<input type="submit" value="Ответить" class="js-send">
											<a href="#" class="js-close" data-id="<?=$value_c->id?>">Отмена</a>
										</div>
									</form>
								</div>
								<div style="width: 100%; height: 0px; clear: both">
								</div>
							</li>

		            <? endforeach ?>
					</ul>
	            <? else: ?>
		            <div class="comment">

			            <div style="width: 100%; height: 0px; clear: both">
			            </div>
		            </div>
	            <? endif ?>
            </div>
            <div class="add_comment">
				<? if (!Yii::app()->user->isGuest): ?>
					<p style="margin-bottom: 8px;font: 14px FTN55;text-transform: uppercase;letter-spacing: 1px;">Комментарий:</p>
					<form action="<?= CHtml::normalizeUrl(array('site/articleComment'))?>" class="auth-form" method="post">
					<input type="hidden" name="id" value="<?= $article->id ?>">
					<textarea id="text_comment" name="comment" style="width: 100%; height: 20%"></textarea>
					<input class="comment_buttom" type="submit" value="Отправить" id="submit_comment">
				<? else: ?>
					<p style="font-size: 12px;"><input class="login send " type="submit" value="Авторизоваться">чтобы оставить комментарии.</p>
				<? endif ?>

            </div>
        </div>
    </div>


	<? if ($article_themes): ?>
		<div class="grid_m_left_right" style="margin-top: 45px;">
			<h4 class="art_title" style="font-size: 13px;">Статьи по теме</h4>
			<ul class="actual_box"><!-- START ACTUAL -->
				<? foreach ($article_themes as $theme): ?>
					<? if ($article->id == $theme->id) continue; ?>
					<li>
						<div class="ab_img"><a
								href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $theme->id)); ?>"><img src="<?= $theme->img() ?>"></a></div>

						<h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $theme->id)); ?>"
							   style="font-size: 90%;"><?= $theme->title ?></a></h3>

						<p><?= $theme->small_description ?> </p>

					</li>
				<? endforeach ?>
			</ul>
		</div>
	<? endif ?>

    <div class="grid_m_left_center">


        <div class="popular_box"><!-- START POPULAR -->
            <h2 class="art_title">Популярное</h2>
            <ul class="clearfix">
				<? $populars=Catalog::model()->findAll('isVisible=1 ORDER BY view DESC LIMIT 3')?>

                <? foreach($populars as $popular): ?>
                    <li>
                        <div class="pop_b_img"><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><img src="<?=$popular->img()?>"></a></div>
                        <div class="pop_b_inf">
                            <span><?=$popular->c->title?></span>
                            <h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><?=$popular->title?></a></h3>
                            <p><?=$popular->small_description?></p>
                        </div>
                    </li>
                <? endforeach ?>
            </ul>
        </div><!-- END POPULAR -->
    </div>
</div>
<script type="text/javascript">
	jQuery(function($) {
		jQuery('body').on('click','#favorites',function(){jQuery.ajax({'type':'POST','data':{'id':$(this).data("id")},'success':function(data){
			var json = JSON.parse(data);
			if(json.m){
				$("#favor").text("В избранном");
			}
		},'url':'<?= CHtml::normalizeUrl(array('site/Favorites', 'id' => $popular->id)); ?>','cache':false});return false;});
	});

	$(document).ready(function() {
		$('#comment_scroll').click(function(e){
			e.preventDefault();
			var cords=$('.comments').offset();
			var scroll = cords.top;
			$('body').animate({'scrollTop':scroll-30}, 1000);
		});
	});
</script>
<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>