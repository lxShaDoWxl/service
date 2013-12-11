
<div class="grid_m_left"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left" style="width: 97%;">
		<h2 class="art_title">Результаты поиска «<?=$search?>»</h2>

		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
			<ul class="clearfix about" style="font-size: 13px">
				<li style="float: left;">
					<? if ($list=='catalog'): ?>
						<span>Статьи</span>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('site/search', 'search'=>$search, 'list'=>'catalog')) ?>">Статьи</a>
					<? endif; ?>
				</li>
				<li style="float: left;">
					<? if ($list=='debats'): ?>
						<span>Дискуссии</span>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('site/search','search'=>$search, 'list'=>'debats')) ?>">Дискуссии</a>
					<? endif; ?>

				</li>
				<li style="float: left;">
					<? if ($list=='events'): ?>
						<span>Business events</span>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('site/search', 'search'=>$search, 'list'=>'events')) ?>">Business events</a>
					<? endif; ?>

				</li>

			</ul>
			<?
				$search2 =mb_strtoupper(mb_substr($search, 0, 1, 'utf-8'), 'utf-8') . mb_strtolower(mb_substr($search, 1, mb_strlen($search), 'utf-8'), 'utf-8');
			$search_array=array($search,$search2);
			?>
			<div class="quest-section" style="padding-top: 2%;">
				<ul style="-webkit-margin-start: 0px;">


						<? foreach ($items as $value): ?>
							<li style="border-top: none;">
								<? if ($list=='catalog'): ?>
								<div
									style="float: left;width: 100%;max-width: 708px;font-family: 'PT Sans', sans-serif;font-size: 12px;">
									<p style="float: left;font: 12px/20px Arial;"><?= Yii::app()->dateFormatter->format('d MMMM', $value->date) ?></p>
									<a href="<?= CHtml::normalizeUrl(array('site/articles', 'cat' => $value->cid)) ?>"
									   style="float: left;padding-right: 10px;padding-left: 10px;color: #c79533;"><?= $value->c->title ?></a>
									<? if ($value->author0): ?>
										<span>Автор:<?= $value->author0->name ?></span>
									<? endif ?>
									<a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $value->id)) ?>"
									   style="color: #c79533;"><?= $value->title ?></a>
									<span
										style="padding-top: 5px;float: left;margin-bottom: 20px;padding-bottom: 10px;padding-right: 8%;border-bottom: 1px solid #dddddd;"><?= str_replace($search_array, '<em style="background-color: #f9eb93;">' . $search . ' </em>', strripos($value->small_description, $search) ? $value->small_description : $value->full_description); ?> </span>
								</div>
								<? endif ?>
								<? if ($list=='debats'): ?>
									<div
										style="float: left;width: 100%;max-width: 708px;font-family: 'PT Sans', sans-serif;font-size: 12px;overflow: hidden;">
										<p style="float: left;font: 12px/20px Arial;"><?= Yii::app()->dateFormatter->format('d MMMM yyyy', $value->date_start).' - '.Yii::app()->dateFormatter->format('d MMMM yyyy', $value->date_end) ?></p>
										<a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $value->id)) ?>" style="color: #c79533;width: 100%;float: left;"><?= $value->title ?></a>
									<span style="width: 100%;padding-top: 5px;float: left;margin-bottom: 20px;padding-bottom: 10px;padding-right: 8%;border-bottom: 1px solid #dddddd;"><?= str_replace($search_array, '<em style="background-color: #f9eb93;">' . $search . ' </em>', $value->body) ?> </span>
									</div>
								<? endif ?>
								<? if ($list=='events'): ?>
									<div
										style="float: left;width: 100%;max-width: 708px;font-family: 'PT Sans', sans-serif;font-size: 12px;overflow: hidden;">
										<p style="float: left;font: 12px/20px Arial;"><?= Yii::app()->dateFormatter->format('d MMMM yyyy в HH:mm', $value->date) ?></p>
										<a href="<?= CHtml::normalizeUrl(array('site/event', 'id' => $value->id)) ?>" style="color: #c79533;width: 100%;float: left;"><?= $value->title ?></a>
										<span style="width: 100%;padding-top: 5px;float: left;margin-bottom: 20px;padding-bottom: 10px;padding-right: 8%;border-bottom: 1px solid #dddddd;"><?= str_replace($search_array, '<em style="background-color: #f9eb93;">' . $search . ' </em>', strripos($value->small_description, $search) ? $value->small_description : $value->full_description) ?> </span>
									</div>
								<? endif ?>
							</li>
						<? endforeach ?>

				</ul>
			</div>
		</div>


	</div><!-- END DISCUSSINS -->
	<div class="grid_m_left_center">

		<div class="horizontal_bunner"><!-- START HORIZONTAL BUNNER -->
			<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'620x130'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));?>
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