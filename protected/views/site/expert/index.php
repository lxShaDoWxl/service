<div class="grid_m_left" xmlns="http://www.w3.org/1999/html"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left">
		<h2 class="art_title">Задайте вопрос эксперту</h2>

		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
			<ul class="db_n_s_speakers">
			<? foreach($experts as $expert): ?>
					<li style="width: 45%;display: inline-block;padding-bottom: 16px;padding-right: 16px;">
						<div class="db_speaker">
							<div class="db_s_img"><img src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$expert->img())); ?>"  width="54px" height="54px"/></div>
							<div class="db_s_inf">
								<h4><a href="<?= CHtml::normalizeUrl(array('site/expert', 'id'=>$expert->id))?>" ><?=$expert->name?></a></h4>
								<p><?=$expert->position?></p>
							</div>
						</div>
					</li>
			<?  endforeach ?>
				</ul>

		</div><!-- END DISCUSSINS -->

	</div>

	<div class="grid_m_left_right">
		<h2 class="art_title" style="font-size: 13px;padding-top: 5px;">Темы</h2>

		<ul class="article_box"><!-- START ACTUAL -->
			<? foreach($themes as $theme): ?>
				<li>
				<a href="<?= CHtml::normalizeUrl(array('site/experts', 'cat'=>$theme->id));?>" class="<?=($art_cat==$theme->id)?'actual_box_active':''?>"><?=$theme->name ?></a>
				</li>
			<? endforeach ?>
		</ul>
		<!-- END ACTUAL -->

	</div>
	<div class="quest">
		<div class="title-quest">
			<h3>Вопросы и Ответы</h3>
			<div style="float: right;padding-top: 17px;padding-bottom: 10px;">
				<a href="<?= CHtml::normalizeUrl(array('site/expertForm'));?>" class="quest_buttom">Задать свой вопрос</a>
			</div>
		</div>
		<div class="quest-section">
			<ul>
				<? foreach($quests as $value): ?>
				    <li>
						<a href="<?= CHtml::normalizeUrl(array('site/experts', 'cat'=>$value->id_theme));?>"><?=$value->idTheme->name?></a>
						<div style="padding: 2% 0% 1%;font: 14px/18px 'Times New Roman';"><?=$value->body?> </div>
						<div style="color: #a6a6a6;padding: 1% 0 2%;"><?=(isset($value->idUser->name)?$value->idUser->name:$value->user_name)?>, <?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date); ?></div>
						<? if ($value->answer): ?>
							<div class="answer-expert" id="answer-expert-<?= $value->id ?>">
								<div class="db_speaker">
									<div class="db_s_img"><img src="<?=$value->idExpert->img()?>" width="54px" height="54px"></div>
									<div class="db_s_inf">
										<h4><?=$value->idExpert->name?></h4>

										<p><?=$value->idExpert->position?></p>
									</div>
								</div>
								<div style="padding: 4% 0 0 0;font: 14px/18px 'Times New Roman';"> <?=$value->answer?></div>
							</div>
							<a class="expert" href="#" data-id="<?= $value->id ?>">Ответ эксперта</a>
						<? endif ?>
					</li>
				<? endforeach ?>
			</ul>
		</div>
		<div style="padding: 16px;">
			<?$this->widget('CLinkPager', array(
				'header' => '', // пейджер без заголовка
				'firstPageLabel' => '>>',
				'prevPageLabel' => '<',
				'nextPageLabel' => '>',
				'lastPageLabel' => '<<',
				'pages' => $pages,
			))?>
		</div>
	</div>
	<div class="grid_m_left_center">

		<div class="horizontal_bunner"><!-- START HORIZONTAL BUNNER -->
			<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'620x130'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));
			?>
			<? if ($banner_header): ?>
				<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
				<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
					<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>">
						<img style="display: inline;"  src="<?= $banner_header[$number_ban]->img ?>"/></a>
				<? endif ?>
				<? if ($banner_header[$number_ban]->exist()=='swf'): ?>
					<div class="banner" data-id="<?=$banner_header[$number_ban]->id?>">
						<object type="application/x-shockwave-flash" width="100%" height="130px">
							<param name="movie" value="<?= $banner_header[$number_ban]->img ?>"></param>
							<param name="wmode" value="opaque"></param>
						</object>
					</div>
				<? endif ?>
			<? endif ?>
		</div><!-- END HORIZONTAL BUNNER -->
	</div>
</div>
<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>