<div class="grid_m_left"> <!-- LEFT COLUMN -->
	<p class="breadcrumbs"><a href="<?= CHtml::normalizeUrl(array('site/events'))?>" style="font-size: 13px">Мероприятия</a>
		<a style="font-size: 13px" href="theme.php?theme_id=1"> </a></p>
	<ul class="clearfix" style="font-size: 13px">
		<li style="float: left;color: #262626; width: 29%; font: 11px/13px Arial;">
			<?= Yii::app()->dateFormatter->format('d MMMM, HH:mm', $event->date); ?>
			<?=$event->place?>
			<!--			<div style="font-size: 13px;float: right;"><a href="article.html"> Казакша </a>  <a href="article.html"> English </a></div>-->
		</li>
		<li style="float: right;color: #262626; width: 31%; font: 11px/13px Arial;">
			<div class="widgets">

				<a class="widget" >X<span style="padding: 0px 10px 0 5px;"><?= $event->view?></span></a>
				<a class="widget" href="#" id="comment_scroll">s<span><?=count($event->commentEvents)?></span></a>
			</div>
		</li>
	</ul>
<!--	<div class="clearfix" style="color: #737373; font-size:12px;font-family: 'PTSans', sans-serif;">Теги:</div>-->
	<div class="grid_m_left_left" <?=($event->eventsMains==true)? '':'style="width: initial;"'?>>
		<div class="discussion_box clearfix" ><!-- START DISCUSSINS -->
			<div class="grid_m_left_left" style="width: 100%;margin-top: 5%;">
				<h2 class="art_title_debate"><?= $event->title?></h2>
				<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
<!--						<p style="color: #000000; font-size: 13px; margin-top: 12px;"></p>-->
							<?=$event->full_description?>>

					</div>

			</div>




		</div><!-- END DISCUSSINS -->
	<? if ($event->type==0): ?>
		<div class="media">
			<div class="title-media"><h3>Медиа-отчеты</h3></div>
			<div class="media-section">
				<ul>
					<? foreach ($event->eventMedias as $value): ?>
						<li>
							<? if ($value->type == 'video'): ?>
								<?php preg_match('/.*watch\?v=(.*)/', $value->url, $matches) ?>

								<a href="<?= CHtml::normalizeUrl(array('media/index', 'id' => $value->id)) ?>"><img
										src="http://img.youtube.com/vi/<?php echo $matches['1'] ?>/1.jpg"
										/></a>
							<? else: ?>
								<a href="<?= CHtml::normalizeUrl(array('media/index', 'id' => $value->id)) ?>"><img
										src="<?= $value->url ?>" /></a>
							<? endif ?>

						</li>
					<? endforeach ?>
				</ul>
			</div>
		</div>
	<? endif ?>
		<div class="comments" style="color: #000000;">
			<div class="title_comment"><h3>Комментарии к мероприятию (<?=count($event->commentEvents)?>)</h3></div>
			<div class="comments_section">
				<? if ($event->commentEvents): ?>
					<ul class="commentl_box"><!-- START ACTUAL -->
						<? foreach($event->commentEvents as $value_c): ?>

							<li>
								<div class="author_com">
									<div class="author_img"><img width="54px" height="54px" src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value_c->author->img())); ?>">
									</div>
									<h4><?=$value_c->author->name?></h4>
									<p class="position"><?= isset($value_c->author->position)?$value_c->author->position:'' ?></p>
									<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value_c->date) ?></p>
								</div>
								<div style="float: left;width: 69%;"><p style="margin:4px;float: left " <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentsEvents" data-pk="'.$value_c->id.'" data-field="comment"':''?>><?=$value_c->comment?></p>
									<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
								<? if (!Yii::app()->user->isGuest && !($value_c->author->id==Yii::app()->user->getId())): ?>
									<div class="send_comment"><a href="#" data-id="<?= $value_c->id ?>"
																 class="answer_comment">Ответить</a></div>
								<? endif ?>
								<? if ($value_c->commentEventsAnswers): ?>
									<? foreach($value_c->commentEventsAnswers as $value): ?>
										<div class="author_answer">
											<div class="author_com" style="padding-top: 1%; overflow: hidden;">
												<div class="author_img"><img width="54px" height="54px"  src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value->author->img())); ?>"> </div>
												<h4><?= $value->author->name ?></h4>

												<p class="position"><?= isset($value->author->position) ? $value->author->position : '' ?></p>

												<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date) ?></p>
											</div>
											<div style="float: left;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentsEventsAnswer" data-pk="'.$value->id.'" data-field="answer"':''?>><?= $value->answer ?></p>
												<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
										</div>
									<? endforeach ?>
								<? endif ?>
								<div id="answer_comment-<?=$value_c->id?>" class="comment-block js-comment-form js-dynamic-form" style="float: right; display: none;width: 69%;">
									<form method="post" enctype="multipart/form-data" action="<?= CHtml::normalizeUrl(array('site/EventCommentAnswer', 'id'=>$value_c->id)) ?>" class="add-comments-container">
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
					</div>
				<? endif ?>
			</div>
			<div class="add_comment">
				<? if (!Yii::app()->user->isGuest): ?>
				<p style="margin-bottom: 8px;font: 14px FTN55;text-transform: uppercase;letter-spacing: 1px;">Комментарий:</p>
				<form action="<?= CHtml::normalizeUrl(array('site/eventComment'))?>" class="auth-form" method="post">
					<input type="hidden" name="id" value="<?= $event->id ?>">
					<textarea id="text_comment" name="comment" style="width: 100%; height: 20%"></textarea>
					<input class="comment_buttom" type="submit" value="Отправить" id="submit_comment">
					<? else: ?>
						<p style="font-size: 13px;"><input class="login send " type="submit" value="Авторизоваться">чтобы оставить комментарии.</p>
					<? endif ?>

			</div>
		</div>
	</div>


	<? if ($event->eventsMains): ?>
		<div class="grid_m_left_right" style="margin-top: 45px;">
			<h4 class="art_title" style="font-size: 12px;">Статьи по теме</h4>
			<ul class="actual_box"><!-- START ACTUAL -->
				<? foreach ($event->eventsMains as $theme): ?>
					<? if ($article->id == $theme->id) continue; ?>
					<li>
						<div class="ab_img"><a
								href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $theme->id)); ?>"><img
									src="<?= $theme->img() ?>"></a></div>
						<br>

						<h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $theme->id)); ?>"
							   style="font-size: 90%;"><?= $theme->title ?></a></h3>

						<p><?= $theme->small_description ?> </p>

					</li>
				<? endforeach ?>
			</ul>
		</div>
	<? endif ?>

</div>
<script type="text/javascript">
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