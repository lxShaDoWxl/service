<div class="grid_m_left"> <!-- LEFT COLUMN -->
<p class="breadcrumbs"><a href="<?= CHtml::normalizeUrl(array('site/webinars'))?>" style="font-size: 13px">Вебинары</a>
<div style="width: 97%;">
		<div class="webinar_info">
			<p>Дата проведения: <?= Yii::app()->dateFormatter->format('d MMMM', $webinar->date_start) . ' — ' . Yii::app()->dateFormatter->format('d MMMM', $webinar->date_end) ?></p>
			<p>Время проведения: <? $time=explode('-',$webinar->time); echo 'c '.$time[0].' до '.$time[1]?></p>
			<p>Стоимость участия: <? if ($webinar->price != 0): ?>
					<? $price = str_replace(array("\r", "\n", " "), '', $webinar->price);
					$price = number_format($price, 0, '.', ' ');
					?>
					<?= $price . ' тг' ?>
				<? else: ?>
					бесплатно
				<? endif; ?></p>
			<p>Преподаватель:
				<?$count=count($webinar->connectWebinars)?>
				<? foreach($webinar->connectWebinars as $connectWebinar): ?>
					<? if ($count>1): ?>
						<?= $connectWebinar->idPred->name . ', ' ?>
					<? else: ?>
						<?= $connectWebinar->idPred->name ?>
					<? endif ?>
					<? $count--;?>
				<? endforeach ?>
			</p>
		</div>
		<div style="float: right;padding-top: 17px;padding-bottom: 10px;">
			<a href="<?=$webinar->url?>" class="quest_buttom">Принять участие</a>
		</div>
</div>
<div class="grid_m_left_left" style="width: 97%;">
	<div class="discussion_box clearfix" ><!-- START DISCUSSINS -->
		<div class="grid_m_left_left" style="width: 100%;margin-top: 3%;">
			<h2 class="art_title_main"><?= $webinar->title?></h2>
			<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
				<div style="float: left;">
					<?=$webinar->body?>
				</div>

			</div>

		</div>
	</div><!-- END DISCUSSINS -->
</div>
</div>

<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>