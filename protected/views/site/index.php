
<div class="grid_m_left"> <!-- LEFT COLUMN -->

<div class="grid_m_left_left">
    <h2 class="art_title">дискуссия</h2>

    <div class="discussion_box clearfix"><!-- START DISCUSSINS -->
        <!--------------------------------------->
		<? if ($debate): ?>
			<div class="db_img">
				<a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate[0]->id)); ?>"><img
						src="<?= $debate[0]->img ?>"/></a>
			</div>
			<!--------------------------------------->
			<div class="db_agenda">
				<h3 <?= (!$debate[0]->commentsDebats) ? 'style="width: 100%;"' : '' ?> > <a href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate[0]->id)); ?>"><?= $debate[0]->title ?></a></h3>

					<? if ($debate[0]->commentsDebats): ?>
					<div class="db_speaker">
						<div class="db_s_img"><img width="54px" height="54px"
												   src="<?= $debate[0]->commentsDebats[0]->author->img() ?>"/></div>
						<div class="db_s_inf">
							<h4><?= $debate[0]->commentsDebats[0]->author->name ?></h4>

							<p><?= $debate[0]->commentsDebats[0]->author->position ?></p>
						</div>
					</div>
				<? endif; ?>
			</div>
			<!--------------------------------------->

			<div class="db_comment">
				<? if ($debate[0]->commentsDebats): ?>
					<p class="db_c_title"><?= $debate[0]->commentsDebats[0]->comment ?></p>
					<p class="db_c_participants">Участники дискуссии:

					<? for ($i = 0; $i < count($debate[0]->commentsDebatsIndex); $i++): ?>

						<? if ($i == (count($debate[0]->commentsDebatsIndex) - 1)): ?>
							<a href="#"><?= $debate[0]->commentsDebatsIndex[$i]->author->name ?></a>...</p>
						<? else: ?>
							<a href="#"><?= $debate[0]->commentsDebatsIndex[$i]->author->name ?></a>,
						<? endif; ?>
					<? endfor; ?>
				<? else: ?>
					<?= $debate[0]->body ?>
				<?endif ?>
			</div>

			<!--------------------------------------->
			<div class="db_connecting">
				<a class="db_con_button"
				   href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate[0]->id)); ?>">Присоединиться прямо
					сейчас</a>
				<!--            <ul class="pager">-->
				<!--                <li></li>-->
				<!--                <li class="current">/li>-->
				<!--                <li></li>-->
				<!--                <li></li>-->
				<!--            </ul>-->
			</div>
			<!--------------------------------------->
			<? if (isset($debate[1])): ?>
				<div class="db_next_speakers">
					<p class="db_n_s_title">
						<span>Скоро:</span><a
							href="<?= CHtml::normalizeUrl(array('site/debate', 'id' => $debate[1]->id)); ?>"><?= $debate[1]->title ?></a>
					</p>
					<ul class="db_n_s_speakers">
						<? foreach ($debate[1]->connectDebats as $expert): ?>
							<li>
								<div class="db_speaker">
									<div class="db_s_img"><img
											src="<?= CHtml::normalizeUrl(array('image/resize', 'w' => '54', 'h' => '54', 'img_url' => $expert->idUser->img())); ?>"/>
									</div>
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
			<!--------------------------------------->
		<? endif ?>
    </div><!-- END DISCUSSINS -->

	<? if ($webinars): ?>
		<div class="vebinars_box"><!-- START VEBINARS BOX -->
			<h2 class="art_title">вебинары</h2>
			<ul class="vb_speakers">
				<? foreach ($webinars as $webinar): ?>
					<li>
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
		</div><!-- END VEBINARS BOX -->
	<? endif ?>

</div>

<div class="grid_m_left_right">
    <h2 class="art_title">актуально</h2>

    <ul class="actual_box"><!-- START ACTUAL -->
		<? foreach($article_themes as $theme): ?>
		<li>
			<div class="ab_img"><a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$theme->id));?>"><img src="<?= $theme->img() ?>"></a></div>
		<h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$theme->id));?>"><?= $theme->title ?></a></h3>
				<p><?= $theme->small_description ?> </p>

		</li>
		<? endforeach ?>

    </ul><!-- END ACTUAL -->

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
	<? if ($experts): ?>
		<div class="slider_wr"><!-- START SLIDER -->
			<h2 class="sw_title">экспертный совет</h2>
			<!--        <h3 class="sw_second_title">Как открыть интернет-магазин?</h3>-->
			<ul class="sliders">

				<? foreach($experts as $value): ?>
				    <li class="slide">
    					<ul class="slider clearfix">
    						<li>
    							<div class="slider_top_img"><img src="/images/slider_question.png"/></div>
    							<div class="slider_content">
    								<p class="slider_content_text"><?=$value->body?></p>

    								<div class="db_speaker">
										<? if (isset($value->idUser)): ?>
											<div class="db_s_img"><img src="<?= $value->idUser->img() ?>" width="54px" height="54px"></div>
										<? endif ?>
    									<div class="db_s_inf">
    										<h4><?=(isset($value->idUser->name)?$value->idUser->name:$value->user_name)?></h4>

											<? if (isset($value->idUser->position)): ?>
												<p><?= $value->idUser->position ?></p>
											<? endif ?>
    									</div>
    								</div>
    							</div>
    						</li>
    						<li class="odd">
    							<div class="slider_top_img"><img src="/images/slider_exclamation.png"/></div>
    							<div class="slider_content">
    								<div class="slider_content_text"><?=$value->answer?></div>

    								<div class="db_speaker">
    									<div class="db_s_img"><img src="<?=$value->idExpert->img()?>" width="54px" height="54px"></div>
    									<div class="db_s_inf">
    										<h4><?=$value->idExpert->name?></h4>

    										<p><?=$value->idExpert->position?></p>
    									</div>
    								</div>
    							</div>
    						</li>
    					</ul>
    				</li>
				<? endforeach ?>
			</ul>
			<ul class="slider_pagination">
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li><!-- --></li>
				<li class="current"><!-- --></li>
			</ul>
			<ul class="slider_nav">
				<li class="sl_n_left"><span>&#210;</span><span class="hover">&#211;</span></li>
				<li class="sl_n_right"><span>&#213;</span><span class="hover">&#214;</span></li>
			</ul>
		</div><!-- END SLIDER -->
	<? endif ?>

    <div class="popular_box"><!-- START POPULAR -->
        <h2 class="art_title">Популярное</h2>
        <ul class="clearfix">
			<? $populars=Catalog::model()->findAll('isVisible=1 ORDER BY view DESC LIMIT 3')?>

			<? foreach($populars as $popular): ?>
				<li>
					<div class="pop_b_img"><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><img src="<?=$popular->img()?>"></a></div>
					<div class="pop_b_inf">
						<span><?=$popular->c->title?></span>
						<h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><?=$popular->title?></a></h3>
						<p><?=$popular->small_description?></p>
					</div>
				</li>
			<? endforeach ?>
        </ul>
    </div><!-- END POPULAR -->

</div>
</div>
<? $this->beginContent('//layouts/columnRight'); ?>
<? $this->endContent(); ?>