
<div class="grid_m_left"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left">
		<h2 class="art_title">Вебинары</h2>

		<div class="webinar_box clearfix"><!-- START DISCUSSINS -->
			<? if ($webinars_new): ?>
				<div style="color: #000000;font-size: 13px;padding-bottom: 15px;">
					<strong>Ближайшие</strong>
				</div>
			<ul class="vb_speakers">
				<? foreach ($webinars_new as $webinar_new): ?>
					<li>
						<? if ($webinar_new->connectWebinars): ?>
							<div class="vb_s_img_wr">
								<div class="vb_s_img"><img
										src="<?= CHtml::normalizeUrl(array('image/resize', 'w' => '137', 'h' => '137', 'img_url' => $webinar_new->connectWebinars[0]->idPred->img())); ?>"/>
								</div>
							</div>
							<div class="vb_s_inf">
								<h4><?= $webinar_new->connectWebinars[0]->idPred->name ?></h4>

								<p><?= $webinar_new->connectWebinars[0]->idPred->position ?></p>
							</div>
						<? endif ?>
						<p class="vb_s_date"><?= Yii::app()->dateFormatter->format('d MMMM', $webinar_new->date_start) . ' — ' . Yii::app()->dateFormatter->format('d MMMM', $webinar_new->date_end) ?></p>

						<p class="vb_s_title"><a href="<?= CHtml::normalizeUrl(array('site/webinar', 'num'=>$webinar_new->id))?>"><?= $webinar_new->title ?></a></p>

						<p class="vb_s_price">
							<? if ($webinar_new->price != 0): ?>
								<? $price = str_replace(array("\r", "\n", " "), '', $webinar_new->price);
								$price = number_format($price, 0, '.', ' ');
								?>
								<?= $price . ' тг' ?>
							<? else: ?>
								БЕСПЛАТНО
							<? endif; ?>

						</p>
					</li>
				<? endforeach ?>
			</ul>
			<? endif ?>
			<div style="color: #000000;font-size: 13px;padding-bottom: 15px;">
				<strong>Все вебинары</strong>
			</div>
			<ul class="vb_speakers" id="all_webinars">
				<? foreach ($webinars as $webinar): ?>
					<li class="item_webinars">
						<? if ($webinar->connectWebinars): ?>
							<div class="vb_s_img_wr">
								<div class="vb_s_img"><img
										src="<?= CHtml::normalizeUrl(array('image/resize', 'w' => '137', 'h' => '137', 'img_url' => $webinar->connectWebinars[0]->idPred->img())); ?>"/>
								</div>
							</div>
							<div class="vb_s_inf">
								<h4><?= $webinar->connectWebinars[0]->idPred->name ?></h4>

								<p><?= $webinar->connectWebinars[0]->idPred->position ?></p>
							</div>
						<? endif ?>
						<p class="vb_s_date"><?= Yii::app()->dateFormatter->format('d MMMM', $webinar->date_start) . ' — ' . Yii::app()->dateFormatter->format('d MMMM', $webinar->date_end) ?></p>

						<p class="vb_s_title"><a href="<?= CHtml::normalizeUrl(array('site/webinar', 'num'=>$webinar->id))?>"><?= $webinar->title ?></a></p>

						<p class="vb_s_price">
							<? if ($webinar->price != 0): ?>
								<? $price = str_replace(array("\r", "\n", " "), '', $webinar->price);
								$price = number_format($price, 0, '.', ' ');
								?>
								<?= $price . ' тг' ?>
							<? else: ?>
								БЕСПЛАТНО
							<? endif; ?>

						</p>
					</li>
				<? endforeach ?>
			</ul>
			<? $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
				'contentSelector' => '#all_webinars',
				'itemSelector' => '.item_webinars',
				'loadingText' => 'Loading...',
				'donetext' => ' ',
				'pages' => $pages,
			)); ?>
		</div><!-- END DISCUSSINS -->

	</div>

	<div class="grid_m_left_right">
		<h2 class="art_title" style="font-size: 13px;padding-bottom: 9px;">Темы</h2>

		<ul class="article_box"><!-- START ACTUAL -->
			<? foreach($cats as $cat): ?>
				<li><a href="<?= CHtml::normalizeUrl(array('site/webinars', 'cat'=>$cat->id));?>" class="<?=($art_cat==$cat->id)?'actual_box_active':''?>"><?=$cat->title ?></a></li>
			<? endforeach ?>
		</ul><!-- END ACTUAL -->

	</div>
</div>
<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>