<div class="grid_m_left"> <!-- LEFT COLUMN -->
	<p class="breadcrumbs">
		<a href="<?= CHtml::normalizeUrl(array('site/experts'))?>" style="font-size: 13px">ЭКСПЕРТНЫЙ СОВЕТ</a>
	</p>
	<div class="grid_m_left_left" style="width: 97%;">
		<div class="discussion_box clearfix" ><!-- START DISCUSSINS -->

				<h2 class="name-expert"><?= $expert->name?></h2>
			<div style="float: right;padding-top: 17px;padding-bottom: 10px;">
				<a href="<?= CHtml::normalizeUrl(array('site/expertForm', 'id'=>$expert->id))?>" class="quest_buttom">Задать вопрос</a>
			</div>
				<div class="clearfix position-expert"><?= $expert->position?></div>
				<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
					<div class="info-expert">
						<div class="img-expert"><img src="<?=$expert->img()?>"> </div>
						<div class="body-expert">
							<div class="stats-expert">
								<ul>
									<li>
										Статей:<a href="#"><?=count($expert->catalogs)?></a>
									</li>
									<li>
										Консультаций:<a href="#"><?=count($expert->questions1)?></a>
									</li>
								</ul>
							</div>
							<?=$expert->body?>
						</div>
					</div>
				</div>

		</div><!-- END DISCUSSINS -->
		<? if ($expert->questions1(array('condition'=>'isVisible=1'))): ?>
		<div class="comments" style="color: #000000;">
			<div class="title_comment"><h3>Советы эксперта</h3></div>
			<div class="comments_section">
					<ul class="commentl_box"><!-- START ACTUAL -->
						<? foreach($expert->questions1 as $value): ?>
							<li>
								<a style="font-family: 'PT Sans', sans-serif;font-size: 12px;color: #C79533;" href="<?= CHtml::normalizeUrl(array('site/experts', 'cat'=>$value->id_theme));?>"><?=$value->idTheme->name?></a>
								<div class="article-expert-body"><?=$value->body?> </div>
								<div class="article-expert-date"><?=(isset($value->idUser->name)?$value->idUser->name:$value->user_name)?>, <span><?= Yii::app()->dateFormatter->format('d MMMM, HH:mm', $value->date); ?></span></div>
								<? if ($value->answer): ?>
									<div class="answer-expert" id="answer-expert-<?= $value->id ?>">
										<div class="db_speaker">
											<div class="db_s_img"><img src="<?=$value->idExpert->img()?>" width="54px" height="54px"></div>
											<div class="db_s_inf">
												<h4><?=$value->idExpert->name?></h4>

												<p><?=$value->idExpert->position?></p>
											</div>
										</div>
										<div style="padding: 4% 4% 0;"> <?=$value->answer?></div>
									</div>
									<a class="expert" href="#" data-id="<?= $value->id ?>">Ответ эксперта</a>
								<? endif ?>
							</li>
						<? endforeach ?>
					</ul>
			</div>
		</div>
		<? endif ?>
		<? if ($expert->catalogs): ?>
		<div class="comments" style="color: #000000;">
			<div class="title_comment"><h3>Статьи</h3></div>
			<div class="comments_section">

					<ul class="commentl_box"><!-- START ACTUAL -->
						<? foreach($expert->catalogs as $value): ?>
							<li>
								<div class="article-expert-date"><span><?= Yii::app()->dateFormatter->format('d MMMM yyyy', $value->date); ?></span><a href="<?= CHtml::normalizeUrl(array('site/articles', 'cat'=>$value->cid));?>" style="font-family: 'PT Sans', sans-serif;font-size: 12px;color: #C79533;"><?=$value->c->title?></a> </div>
								<h3 style="margin-bottom: 0;"><a class="article-expert-title11" href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$value->id));?>"><?=$value->title?></a></h3>
								<div class="article-expert-body"><?=$value->small_description?> </div>
							</li>
						<? endforeach ?>
					</ul>
			</div>
		</div>
		<? endif ?>
	</div>



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