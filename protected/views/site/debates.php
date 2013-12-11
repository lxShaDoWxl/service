
<div class="grid_m_left"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left" style="width: 97%;">
		<h2 class="art_title">Дискуссии</h2>

		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->

			<? if ($debates): ?>
				<div style="color: #000000;font-size: 13px;padding-bottom: 15px;"><strong>Активное
						обсуждение</strong> <?= Yii::app()->dateFormatter->format('d MMMM', $debates[0]->date_start) . ' — ' . Yii::app()->dateFormatter->format('d MMMM', $debates[0]->date_end) ?>
				</div>

				<div class="db_img">
					<a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debates[0]->id)); ?>"><img src="<?= $debates[0]->img ?> "></a>
				</div>
				<? if ($debates[0]->commentsDebats): ?>
					<div class="db_agenda">
						<h3><a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debates[0]->id)); ?>"
							   style="font-size: 90%;"><?= $debates[0]->title ?></a></h3>

						<div class="db_speaker">
							<div class="db_s_img"><img width="54px" height="54px"
													   src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$debates[0]->commentsDebats[0]->author->img())); ?>"></div>
							<div class="db_s_inf">
								<h4><?= $debates[0]->commentsDebats[0]->author->name ?></h4>

								<p><?= $debates[0]->commentsDebats[0]->author->position ?></p>
							</div>
						</div>
					</div>
					<div class="db_comment">
						<p class="db_c_title"><?= $debates[0]->commentsDebats[0]->comment ?></p>

						<p class="db_c_participants">Участники дискуссии:

							<? for ($i = 0;
							$i < count($debates[0]->commentsDebatsIndex);
							$i++): ?>

							<? if ($i == (count($debates[0]->commentsDebatsIndex) - 1)): ?>
							<a href="#"><?= $debates[0]->commentsDebatsIndex[$i]->author->name ?></a>...</p>
						<? else: ?>
							<a href="#"><?= $debates[0]->commentsDebatsIndex[$i]->author->name ?></a>,
						<?
						endif; ?>
						<? endfor; ?>

					</div>
					<div class="db_connecting">
						<a class="db_con_button"
						   href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debates[0]->id)); ?>">Присоединиться
							прямо сейчас</a>
						<!--						<ul class="pager">-->
						<!--							<li> </li>-->
						<!--							<li class="current"></li>-->
						<!--							<li></li>-->
						<!--							<li></li>-->
						<!--						</ul>-->
					</div>
				<? else: ?>
					<h3 style="margin-bottom: 6px;"><a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debates[0]->id)); ?>"
						   style="font: 24px/24px FTN55;color: #3C3CC8;"><?= $debates[0]->title ?></a></h3>
										<p><?= $debates[0]->body ?> </p>
					<div class="db_connecting">
						<a class="db_con_button"
						   href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debates[0]->id)); ?>">Присоединиться
							прямо сейчас</a>
						<!--						<ul class="pager">-->
						<!--							<li> </li>-->
						<!--							<li class="current"></li>-->
						<!--							<li></li>-->
						<!--							<li></li>-->
						<!--						</ul>-->
					</div>
				<?endif; ?>
				<? unset($debates[0]) ?>
			<? endif ?>

			<? if ($debates): ?>
				<div class="db_next_speakers">
					<p class="db_n_s_title">
						Другие открытые дискусии
					</p>
					<? foreach ($debates as $debate): ?>

						<div class="others_debates" style="/*float: right;*/">
							<div class="db_img" style="width: 40%;float: left;margin-right: 10px;">
								<a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate->id)); ?>"><img
										src="<?= $debate->img ?>"></a>
							</div>
							<div
								style="color: #000000;font-size: 12px;"> <?= Yii::app()->dateFormatter->format('d MMMM', $debate->date_start) . ' — ' . Yii::app()->dateFormatter->format('d MMMM', $debate->date_end) ?> </div>
							<h3><a
									href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate->id)); ?>"
									style="font-size: 90%;"><?= $debate->title ?></a></h3>

							<p><?= $debate->body ?> </p>
						</div>
						<? if ($debate->commentsDebats): ?>
							<div style="float: left; width: 100%;">
								<div class="db_agenda">
									<div class="db_speaker" style="float: none;width: initial;">
										<div class="db_s_img"><img width="54px" height="54px"
																   src="<?= $debate->commentsDebats[0]->author->img() ?>">
										</div>
										<div class="db_s_inf">
											<h4><?= $debate->commentsDebats[0]->author->name ?></h4>

											<p><?= $debate->commentsDebats[0]->author->position ?></p>
										</div>
									</div>
								</div>
								<div class="debate_comment">
									<p class="db_c_title"><?= $debate->commentsDebats[0]->comment ?></p>
								</div>
							</div>
						<? endif; ?>
					<? endforeach; ?>
				</div>
			<? endif ?>
				</div>


		</div><!-- END DISCUSSINS -->
	<div class="grid_m_left_center">

		<div class="horizontal_bunner"><!-- START HORIZONTAL BUNNER -->
			<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'620x130'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));


			?>
			<? if ($banner_header): ?>
				<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
				<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
					<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>" target="_blank">
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
<? $this->beginContent('//layouts/columnRight'); ?>
<? $this->endContent(); ?>