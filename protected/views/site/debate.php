<div class="grid_m_left"> <!-- LEFT COLUMN -->
<p class="breadcrumbs"><a href="<?= CHtml::normalizeUrl(array('site/debates'))?>" style="font-size: 13px">Дискуссии</a></p>
<ul class="clearfix" style="font-size: 13px">
	<li style="float: left;color: #262626; width: 29%; font: 11px/13px Arial;">
		<?=Yii::app()->dateFormatter->format('d MMMM', $debate->date_start) .' — '. Yii::app()->dateFormatter->format('d MMMM', $debate->date_end)?>
		<!--			<div style="font-size: 13px;float: right;"><a href="article.html"> Казакша </a>  <a href="article.html"> English </a></div>-->
	</li>
	<li style="float: right;color: #262626; width: 31%; font: 11px/13px Arial;">
		<div class="widgets">

			<a class="widget" >X<span style="padding: 0px 10px 0 5px;"><?= $debate->view?></span></a>
			<a class="widget" href="#" id="comment_scroll">s<span><?=count($debate->commentsDebats)?></span></a>
		</div>
	</li>
</ul>
	<? if ($debate->tag): ?>
		<div class="clearfix" style="color: #737373; font-size:12px;font-family: 'PTSans', sans-serif;">
			Теги: <?= $debate->tag ?></div>
	<? endif ?>
<div class="grid_m_left_left" <?=($article_themes==true)? '':'style="width: initial;"'?>>
	<div class="discussion_box clearfix" ><!-- START DISCUSSINS -->
		<div class="grid_m_left_left" style="width: 100%;margin-top: 5%;">
			<h2 class="art_title_debate"><?= $debate->title?></h2>
			<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
				<div><img src="<?=$debate->img?>" width="100%">
					<br>
					<p style="color: #000000; font-size: 13px; margin-top: 12px;">
						<?=$debate->body?>
					</p>
				</div>
				<? if ($debate->connectDebats): ?>
					<div style="padding-top: 16px;">
						<div class="title-quest">
							<h3>Спикеры</h3>
						</div>
						<ul class="db_n_s_speakers">
							<? foreach ($debate->connectDebats as $expert): ?>
								<li style="width: 45%;display: inline-block;padding-bottom: 16px;">
									<div class="db_speaker">
										<div class="db_s_img"><img
												src="<?= CHtml::normalizeUrl(array('image/resize', 'w' => '54', 'h' => '54', 'img_url' => $expert->idUser->img())); ?>"
												width="54px" height="54px"/></div>
										<div class="db_s_inf">
											<h4>
												<a href="<?= CHtml::normalizeUrl(array('site/expert', 'id' => $expert->idUser->id)) ?>"><?= $expert->idUser->name ?></a>
											</h4>

											<p><?= $expert->idUser->position ?></p>
										</div>
									</div>
								</li>
							<? endforeach ?>
						</ul>
					</div>
				<? endif ?>

			</div>

		</div>


	</div><!-- END DISCUSSINS -->

	<div class="comments">
		<div class="title_comment"><h3>Дискуссия</h3></div>
		<div class="comments_section">
			<? if ($comments):?>

				<ul class="commentl_box"><!-- START ACTUAL -->
					<? foreach($comments as $value_c): ?>
						<li class="comment">
							<div style=" padding: 10px; border-bottom: 1px solid #E3E3E3; <?=($value_c->author->connectDebats(array('id_debat'=>$debate->id)))?'background-color: #F9F4E8;':''?>" >
							<div class="author_com">
								<div class="author_img"><img width="54px" height="54px" src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value_c->author->img())); ?>">
								</div>
								<h4><?=$value_c->author->name?></h4>
								<p class="position"><?= isset($value_c->author->position)?$value_c->author->position:'' ?></p>
								<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value_c->date) ?></p>
							</div>
							<div style="float: left;width: 69%;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentsDebat" data-pk="'.$value_c->id.'" data-field="comment"':''?>><?=$value_c->comment?></p>
								<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
							<? if (!Yii::app()->user->isGuest && !($value_c->author->id==Yii::app()->user->getId())): ?>
								<div class="send_comment"><a href="#" data-id="<?= $value_c->id ?>"
															 class="answer_comment">Ответить</a></div>
							<? endif ?>
							<div id="answer_comment-<?=$value_c->id?>" class="comment-block js-comment-form js-dynamic-form" style="float: right; display: none;width: 69%;">
								<form method="post" enctype="multipart/form-data" action="<?= CHtml::normalizeUrl(array('site/DebCommentAnswer', 'id'=>$value_c->id)) ?>" class="add-comments-container" id="add-comments-<?=$value_c->id?>">
									<div class="add-comments-field">
										<div class="add-comments-field-inner">
											<textarea cols="30" rows="10" placeholder="Ваш ответ..." name="answer" class="js-text"></textarea>
										</div>
									</div>
									<div class="add-comments-buttons" style="width: 85%;">
										<input type="button" value="Ответить" data-id="<?=$value_c->id?>" class="js-send">
										<a href="#" class="js-close" data-id="<?=$value_c->id?>">Отмена</a>
									</div>
								</form>
							</div>
							<div style="width: 100%; height: 0px; clear: both">
							</div>
						</div>
						<div id="answer-<?=$value_c->id?>">
							<? if ($value_c->answerCommentDebats): ?>
								<? foreach($value_c->answerCommentDebats as $value): ?>
									<div class="author_answer" style="<?=($value->author->connectDebats(array('id_debat'=>$debate->id)))?'background-color: #F9F4E8;':''?>">
										<div class="author_com" style="padding-top: 1%; overflow: hidden;">
											<div class="author_img"><img width="54px" height="54px"  src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value->author->img())); ?>"> </div>
											<h4><?= $value->author->name ?></h4>

											<p class="position"><?= isset($value->author->position) ? $value->author->position : '' ?></p>

											<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date) ?></p>
										</div>
										<div style="float: left;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="AnswerCommentDebat" data-pk="'.$value->id.'" data-field="answer"':''?>><?= $value->answer ?></p>
											<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
									</div>

								<?endforeach ?>

							<? endif ?>

						</div>
						</li>
					<? endforeach ?>

				</ul>

				<? $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
				'contentSelector' => '.commentl_box',
				'itemSelector' => '.comment',
				'loadingText' => 'Loading...',
				'donetext' => '<!-- -->',
				'errorCallback'=>'js:function(){comment_add=true;}',
				'pages' => $pages,
			)); ?>
			<? else: ?>
				<div class="comment">
				</div>
			<? endif ?>
		</div>
		<div class="add_comment">
			<? if (!Yii::app()->user->isGuest): ?>
			<p style="margin-bottom: 8px;font: 14px FTN55;text-transform: uppercase;letter-spacing: 1px;">Комментарий:</p>
			<form action="<?= CHtml::normalizeUrl(array('site/debateComment'))?>" class="auth-form" id="send-comment" method="post">
				<input type="hidden" name="id" value="<?= $debate->id ?>">
				<textarea id="text_comment" name="comment" style="width: 100%; height: 20%"></textarea>
				<input class="comment_buttom" type="button" value="Отправить" id="submit_comment">
				<? else: ?>
					<p style="font-size: 13px;"><input class="login send " type="submit" value="Авторизоваться">чтобы оставить комментарии.</p>
				<? endif ?>

		</div>
	</div>
</div>


<? if ($article_themes): ?>
	<div class="grid_m_left_right" style="margin-top: 45px;">
		<h4 class="art_title" style="font-size: 12px;">Статьи по теме</h4>
		<ul class="actual_box"><!-- START ACTUAL -->
			<? foreach ($article_themes as $theme): ?>
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

		$('#submit_comment').click(function(){
			$.ajax({
				url:  "<?= CHtml::normalizeUrl(array('site/debateComment'))?>",
				type: "POST",
				data: jQuery('#send-comment').serialize(),
				async:false,
				success: function(data){
					if (data) {
						$('#text_comment').val('');
						var json = JSON.parse(data);
							var text = json[0];
							$('.commentl_box').append(text);
					}
				}
			});
		});
		$('.commentl_box').on('click', '.js-send', function(){
			$.ajax({
				url:  "<?= CHtml::normalizeUrl(array('site/DebCommentAnswer'))?>/id/"+$(this).data('id'),
				type: "POST",
				data: jQuery('#add-comments-'+$(this).data('id')).serialize(),
				async:false,
				success: function(data){
					if (data) {
						var json_obj;
						var json = JSON.parse(data);
						for (json_obj in json) {
							var text = json[json_obj];
							$('#answer_comment-'+json_obj+' textarea').val('');
							$('#answer-' + json_obj).append(text);
							$('#answer_comment-'+json_obj).fadeOut();
						}
					}

				}
			});
		});
		$('#comment_scroll').click(function(e){
			e.preventDefault();
			var cords=$('.comments').offset();
			var scroll = cords.top;
			$('body').animate({'scrollTop':scroll-30}, 1000);

		});
	});
	var comment_add=false;
	var cyrl;
	cyrl = new PeriodicalExecuter(function() {
		if (comment_add==true) {
		$.ajax({
			url:  "<?= CHtml::normalizeUrl(array('site/updatedebateCom'))?>",
			type: "GET",
			data: {'id':<?=$debate->id?>},
			async:false,
			success: function(data){
				if (data) {
					var json_obj;
					var json = JSON.parse(data);
					for (json_obj in json) {
						var text = json[json_obj];
						$('.commentl_box').append(text);
					}
				}

			}
		});
		}
			$.ajax({
				url: "<?= CHtml::normalizeUrl(array('site/updatedebateAnsw'))?>",
				type: "GET",
				data: {'id':<?=$debate->id?>},
				async: false,
				success: function (data) {
					if (data) {
						var json_obj;
						var json = JSON.parse(data);
						for (json_obj in json) {
							var text = json[json_obj];


							if ($('div').is('#answer-' + json_obj)) {
								$('#answer-' + json_obj).append(text)

							}else{
								var count= $.cookie('answercom-<?=$debate->id?>');
								$.cookie('answercom-<?=$debate->id?>',count-1);
							}

						}
					}

				}
			});

	},10);
	function textChange() {
		alert('check textbox content against database here');
		cyrl.stop();
	}
</script>
<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>