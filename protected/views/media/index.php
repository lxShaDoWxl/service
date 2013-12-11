<div class="grid_m_left"> <!-- LEFT COLUMN -->
	<p class="breadcrumbs"><a href="<?= CHtml::normalizeUrl(array('site/event', 'id'=>$media->idEvent->id))?>" style="font-size: 13px"><?=$media->idEvent->title?></a>
		</p>

	<!--	<div class="clearfix" style="color: #737373; font-size:12px;font-family: 'PTSans', sans-serif;">Теги:</div>-->
	<div class="grid_m_left_left" style="width: initial;padding-bottom: 3%; float:none">
		<div class="discussion_box clearfix" ><!-- START DISCUSSINS -->
			<div class="grid_m_left_left" style="width: 100%;">
				<h2 class="art_title_debate"><?= $media->idEvent->title?></h2>
				<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
					<? if ($media->type=='video'): ?>
						<? preg_match('/.*watch\?v=(.*)/', $media->url, $matches) ?>
						<div width="100%">
							<iframe class='video_popup'   src="http://www.youtube.com/embed/<?php echo (isset($matches))? $matches['1']:''?>?rel=0" allowfullscreen="" frameborder="0"></iframe>
						</div>
					<? else: ?>
					<img src="<?=$media->url?>" style="width: 100%;">
					<? endif ?>
				</div>
			</div>
		</div>
	</div><!-- END DISCUSSINS -->
	<div class="media">
		<div class="title-media"><h3>Медиа</h3></div>
		<div class="media-section">
			<ul>
				<? foreach($media->idEvent->eventMedias as $value): ?>
					<li>
						<? if ($value->type=='video'): ?>
							<? preg_match('/.*watch\?v=(.*)/', $value->url, $matches) ?>

							<a href="<?= CHtml::normalizeUrl(array('media/index', 'id'=>$value->id)) ?>"><img src="http://img.youtube.com/vi/<?php echo $matches['1'] ?>/1.jpg" /></a>
						<? else: ?>
							<a href="<?= CHtml::normalizeUrl(array('media/index', 'id'=>$value->id)) ?>"><img src="<?=$value->url?>" /> </a>
						<? endif ?>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	</div>

</div>
</div>
<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>