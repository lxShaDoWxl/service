<div class="grid_m_left"> <!-- LEFT COLUMN -->
	<p class="breadcrumbs"><a href="#" style="font-size: 13px">о нас</a></p>
	<ul class="clearfix about" style="font-size: 13px">

		    <li>
				<? if ($index==$urls[1]->url): ?>
					<span><?=$urls[1]->title?></span>
				<? else: ?>
					<a href="<?= CHtml::normalizeUrl(array('site/about', 'url' => 'about')) ?>"><?=$urls[1]->title?></a>
				<? endif; ?>
			</li>

		<li>
			<? if ($index == 'archive'): ?>
				<span>Архив номеров</span>
			<? else: ?>
				<a href="<?= CHtml::normalizeUrl(array('site/about', 'url' => 'archive')) ?>">Архив номеров</a>
			<? endif; ?>
		</li>
		<? unset($urls[1]);
		foreach($urls as $url): ?>
		<li >
			<? if ($index == $url->url): ?>
				<span><?=$url->title?></span>
			<? else: ?>
				<a href="<?= CHtml::normalizeUrl(array('site/about', 'url' => $url->url)) ?>" ><?=$url->title?></a>
			<? endif ?>
		</li>
		<? endforeach ?>
	</ul>
	<div class="grid_m_left_left" style=" <?=($index=='archive'||('about'&&!$jobs)||'sub')?'width: initial;':''?> margin-top: 5%;">
		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
					<? if ($index=='archive'): ?>
						<div class="archive">
							<div class="archive_status" style="text-align: center;">
								<div class="archive_status_and <?=($list==2)?'archive_status_active':''?>"><a href="<?= CHtml::normalizeUrl(array('site/about', 'url'=>'archive', 'arc'=>2)) ?>" >Бизнес &amp;Власть</a></div>
								<div class="archive_status_rbk <?=($list==1)?'archive_status_active':''?>"><a href="<?= CHtml::normalizeUrl(array('site/about', 'url'=>'archive', 'arc'=>1)) ?>" >РБК </a></div>
							</div>
							<div style="float: right;width: 100%;padding-top: 3%;">
								<ul class="date_arch">
									<?for($i=$number_old ; $i>=$number_one; $i--): ?>
									<li style="float: left;padding-right: 4%;">
										<? if ($i==$god): ?>
											<span><?=$i?></span>
										<? else: ?>
											<a href="<?= CHtml::normalizeUrl(array('site/about', 'url'=>'archive', 'arc'=>$list, 'god'=>$i)) ?>"  ><?=$i?></a>
										<? endif ?>
									</li>
									<? endfor;?>
								</ul>
								<div class="discussion_box clearfix">
									<?$i=0;?>
									<ul>
									<? foreach($archives as $archive): ?>
										<li style="<?= ($i==0)?'':'width: 48%;display: inline-block; padding-right: 1%;padding-bottom: 3%;'?>">
									<div style="<?= ($i==0)?'float: left;display: inline-block;padding-bottom: 3%;padding-top: 15px;':'/*float: left;*/ /*width: 45%;*/' ?>" >
										<div class="mb_img" style="float: left;  width: <?= ($i==0)?'36%':'45%'?>;  margin-right: 8px;">
											<img src="<?= $archive->img ?>"  style="float: left;max-width: 100%;">
										</div>
										<div class="mb_inf" style="float: right;width: <?= ($i==0)?'62%':'52%'?>;">
											<?= ($i==0)?'<span style="color: #c79533;font-family: PTSans, sans-serif;font-size: 12px;"> Свежий номер</span>':'' ?>
											<h3 style="padding-top: 1%;color: #262626;font-family: FTN65;font-size: <?= ($i==0)?'21px':'17px'?>;font-weight: normal;padding-bottom: 1%;"><?= $archive->title ?></h3>
											<p style="font-family: PTSans, sans-serif;font-size: 12px;padding-bottom: 3%;"><?$archive->stats()?> №<?=$archive->number?> <br/>
											От <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $archive->date) ?></p>
											<?= ($i==0)?'<p> '.$archive->body .' </p>':'' ?>
											<br>
											<a href="<?= $archive->url ?>"  style="font: 16px/18px FTN65;" target="_blank">Скачать номер</a>
											<p style=" font: 11px/16px Arial;color: #808080;"><?= $archive->Exist() ?>, <?= $archive->formatSize() ?></p>
										</div>
									</div>
										</li>
									<? $i++; endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					<? elseif($index=='sub'): ?>
						<div class="form_register">
							<form action="<?= CHtml::normalizeUrl(array('site/about','url'=>'sub')) ?>" class="" id="sub-form" method="post">
								<fieldset>
									<span class="fields-note"><strong>Подписка на издание</strong></span>
									<span class="fields-note"><?=$page->body?></span>
									<span class="fields-note"><strong>Подписка на электронную рассылку</strong></span>
									<div class="row" id="Subs_name">
										<label style="width: 100%;">Ваше Имя</label>
										<input type="text" class="text"  name="Subs[name]" style="max-width: 200px;width: 100%;">
										<span class="error_reg" style="float: left;width: inherit;"></span>
									</div>
									<div class="row" id="Subs_mail" >
										<label style="width: 100%;">Электронная почта</label>
										<input type="text" class="text"  name="Subs[mail]" style="max-width: 200px;width: 100%;">
										<span class="error_reg"  style="float: left;width: inherit;"></span>
									</div>
									<div style="padding: 2% 0;" id="subs_send">
										<input class="send" value="Подписаться" type="button">
									</div>

								</fieldset>
							</form>
						</div>
						<script type="application/javascript">
							$(function() {
								$('#sub-form').on('click', '.send', function(){
									var item =$(this).parent(1)
									item.toggleClass('loader');
									var html_old =item.html();
									loader(item);
								$.ajax({
									url:  "<?= CHtml::normalizeUrl(array('site/about','url'=>'sub'))?>",
									type: "POST",
									data: jQuery('#sub-form').serialize(),
									async:false,
									success: function(data){
										$('#sub-form span.error_reg').text('');
										$('#sub-form  input').css({'border':'1px solid #DDD'});
										var json_obj;
										var json=JSON.parse(data);

										if(!json['m']){
											for ( json_obj in json ) {
												var text=json[json_obj];
												$('#'+json_obj+' span.error_reg').text(text);
												$('#'+json_obj+' input').css({'border':'1px solid #F76C6C'});
												loader_end(item, html_old);
											}
										}
										if(json['m']){
											loader_end(item, html_old);
											$('#subs_send').html('<p>Спасибо! Вы успешно подписались на нашу электронную рассылку</p>');
											//document.location.replace(json['m']);
										}
									}
								});
								});
							});
						</script>
					<? else:?>
						<div class="about-text">
							<?= $page->body ?>
						</div>
					<? endif; ?>
					</div>


		</div><!-- END DISCUSSINS -->


	<? if ($index=='about'): ?>
		<? if ($jobs): ?>
			<div class="grid_m_left_right" style="margin-top: 45px;">
				<h4 class="art_title" style="font-size: 12px;">Вакансии</h4>
				<ul class="actual_box"><!-- START ACTUAL -->
					<? foreach($jobs as $value): ?>
					    <li>
    						<h3><a href="<?= CHtml::normalizeUrl(array('site/about', 'job'=>$value->id))?>" style="font-size: 90%;"><?=$value->name?></a></h3>
    					</li>
					<? endforeach ?>
				</ul>
			</div>
		<? endif ?>
	<? endif ?>

	<div class="grid_m_left_center">
		<? if ($index=='about'): ?>
			<div id="map" class="map-container" style="width:100%; height: 80%;padding-top: 25px;"></div>

			<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU&coordorder=longlat"
					type="text/javascript"></script>
			<script type="text/javascript">
				ymaps.ready(init);
				var myMap;

				// Создаем собственную метку

				function init() {
					myMap = new ymaps.Map("map", {
						center: [<?=Settings::get('ymap')->value; ?>],
						zoom: 16,
						type: 'yandex#map',
						autoFitToViewport: 'ifNull'
					});

					myMap.controls
						.add('smallZoomControl', {right: 5, top: 75})
						.add('typeSelector')
						.add('mapTools');
					metka = new ymaps.Placemark([<?php echo Settings::get('ymap')->value; ?>], {
						balloonContent: '<?=Settings::get('ymap_text')->value; ?>'}, {
						//				iconImageHref:'/img/metka.png',
						//				iconImageSize: [34, 48]
						// Смещение левого верхнего угла иконки относительно
						// её "ножки" (точки привязки).
						// iconImageOffset: [-3, -42]


					});
					myMap.geoObjects.add(metka);
				}

			</script>
		<? endif ?>

	</div>
</div>

<?php $this->beginContent('//layouts/columnRight'); ?>
<?php $this->endContent(); ?>