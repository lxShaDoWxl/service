
<div class="grid_m_left"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left" <?=(!$old_events)?'style="width: initial;"':''?>>
		<h2 class="art_title">Мероприятия</h2>

		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->

			<div>
				<h5 style="color: #000000"><?=($events)?'Анонсы мероприятий':'Скоро тут появятся анонсы мероприятий'?> </h5></div>
			<? foreach($events as $event): ?>
				<div style="float: left;border: 1px solid;padding-bottom: 3%;' ?>" >
					<p class="date_event"><?= Yii::app()->dateFormatter->format('d MMMM, HH:mm', $event->date); ?></p>
					<h3 style="padding-bottom: 2%;"><a href="<?= CHtml::normalizeUrl(array('site/event', 'id'=>$event->id));?>" style="font-size: 90%;"><?= $event->title ?></a></h3>
					<img src="<?= $event->img ?>" style="float: left;width: 190px;padding-right: 2%;">

					<p><?= $event->small_description ?> </p>
					<a class="widget" >X<span style="padding: 0px 10px 0 5px;"><?= $event->view?></span></a>
					<a class="widget">s<span><?=count($event->commentEvents)?></span></a>
				</div>
				<?  endforeach ?>
			<? $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
				'contentSelector' => '.discussion_box',
				'itemSelector' => '.item_catalog',
				'loadingText' => 'Loading...',
				'donetext' => '',
				'pages' => $pages,
			)); ?>
		</div><!-- END DISCUSSINS -->

	</div>

	<? if ($old_events): ?>
		<div class="grid_m_left_right">
			<h2 class="art_title" style="font-size: 13px">Материалы предыдущих мероприятий</h2>

			<ul class="actual_box"><!-- START ACTUAL -->
				<? foreach ($old_events as $old_event): ?>
					<li>
						<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM', $old_event->date); ?></p>

						<div class="ab_img"><a
								href="<?= CHtml::normalizeUrl(array('site/event', 'id' => $old_event->id)); ?>"><img
									src="<?= $old_event->img ?>"></a></div>

						<h3><a href="<?= CHtml::normalizeUrl(array('site/event', 'id' => $old_event->id)); ?>"
							   style="font-size: 90%;"><?= $old_event->title ?></a></h3>


					</li>
				<? endforeach ?>
			</ul>
			<!-- END ACTUAL -->
		</div>
	<? endif ?>
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