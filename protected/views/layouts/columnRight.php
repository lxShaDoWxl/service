<div class="grid_m_right"> <!-- RIGHT COLUMN -->
	<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'240x400'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));?>

	<? if ($banner_header): ?>
	<div class="grid_m_right_top">
		<div class="publicity_box"><!-- START PUBLICITY -->
			<div class="pb_container">
					<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
					<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
						<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>" target="_blank">
							<img style="display: inline;"  src="<?= $banner_header[$number_ban]->img ?>"/></a>
					<? endif ?>
					<? if ($banner_header[$number_ban]->exist()=='swf'): ?>
						<div class="banner" data-id="<?=$banner_header[$number_ban]->id?>">
							<object type="application/x-shockwave-flash" width="100%" height="400px">
								<param name="movie" value="<?= $banner_header[$number_ban]->img ?>"></param>
								<param name="wmode" value="opaque"></param>
							</object>
						</div>
					<? endif ?>
			</div>
			<p class="pb_description"><a href="#">Реклама на сайте</a></p>
		</div><!-- END PUBLICITY -->

	</div>
<? endif ?>
	<div class="grid_m_right_bottom">

		<div class="media_box"><!-- START MEDIA -->
			<ul>
				<? if ($this->archive_rbk== true): ?>
					<li>
						<div class="mb_img">
							<a href="<?= $this->archive_rbk->url ?>" target="_blank"><img src="<?= $this->archive_rbk->img ?>"></a>
						</div>
						<div class="mb_inf">
							<div class="mb_i_inf">
								<img src="/images/media_media_img_small_1.png">
							</div>
							<h3><a href="<?=$this->archive_rbk->url ?>" target="_blank">Скачать свежий номер</a></h3>

							<p><?= $this->archive_rbk->Exist() ?>, <?= $this->archive_rbk->formatSize() ?></p>
						</div>
					</li>
				<? endif ?>
				<? if ($this->archive_and==true): ?>
					<li>
						<div class="mb_img">
							<a href="<?= $this->archive_and->url ?>" target="_blank"><img src="<?= $this->archive_and->img ?>"></a>
						</div>
						<div class="mb_inf">
							<div class="mb_i_inf">
								<img src="/images/media_media_img_small_2.png">
							</div>
							<h3><a href="<?= $this->archive_and->url ?>" target="_blank">Скачать свежий номер</a></h3>

							<p><?= $this->archive_and->Exist() ?>, <?= $this->archive_and->formatSize() ?></p>
						</div>
					</li>
				<? endif ?>
			</ul>
		</div><!-- END MEDIA -->

		<div class="bussiness_events_box"><!-- START BUSSINESS EVENT -->
			<h2 class="art_title">Business Events</h2>
			<ul>
				<?$event_col=Events::model()->findAll(array('order'=>'date DESC', 'limit'=>4))?>
				<? foreach($event_col as $value): ?>
				    <li>
    					<div class="beb_img">
    						<a href="<?= CHtml::normalizeUrl(array('site/event', 'id'=>$value->id)) ?>"><img src="<?=$value->img?>"></a>
    					</div>
    					<div class="beb_inf">
    						<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM', $value->date); ?></p>
    						<h3 class="tatle"><a href="<?= CHtml::normalizeUrl(array('site/event', 'id'=>$value->id)) ?>"><?=$value->title?></a></h3>
    						<p class="place"><?=$value->place?></p>
    					</div>
    				</li>
				<? endforeach ?>
			</ul>
			<div class="beb_last_events"><a href="#">Материалы предыдущих мероприятий</a></div>
		</div><!-- END BUSSINESS EVENT -->

		<div class="social_box">
			<iframe src="https://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2F%25D0%2591%25D0%25B8%25D0%25B7%25D0%25BD%25D0%25B5%25D1%2581%25D0%2592%25D0%25BB%25D0%25B0%25D1%2581%25D1%2582%25D1%258C%2F241583739251151&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowtransparency="true"></iframe>

			<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>

			<!-- VK Widget -->
			<div id="vk_groups"></div>
			<script type="text/javascript">
				VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "260", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 61496325);
			</script>
		</div>

	</div>
</div>