<script type="text/javascript" src="<?= $this->base_url ?>/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".items_themes").chosen({
			disable_search_threshold: 10,
			width:'400px'
		});
		$(".items_experts").chosen({
			disable_search_threshold: 10,
			width:'400px'
		});
	});
</script>
<div class="grid_m_left"> <!-- LEFT COLUMN -->

	<div class="grid_m_left_left" style="width: 97%;">
		<h2 class="art_title">Задайте вопрос эксперту</h2>

		<div class="discussion_box clearfix"><!-- START DISCUSSINS -->
			<? if ($experts && $themes): ?>
				<div class="form_register">
					<form action="" class="personal-form pf" method="post" id="sub_form">
						<fieldset>
							<div class="row">
								<label>Тема вопроса</label>

								<select name="Quest[id_theme]" id="themes" class="items_themes">
									<? foreach ($themes as $theme): ?>
										<option value="<?= $theme->id ?>" <?= isset($expert_quest)?($expert_quest->questionThemeExperts(array('id_theme'=>$theme->id)))? 'selected':'':''?>><?= $theme->name ?></option>
									<? endforeach ?>
								</select>
							</div>
							<div class="row">
								<label>Эксперт</label>
								<select name="Quest[id_expert]" id="experts" class="items_experts">
									<? $i=0;
									 foreach($themes as $theme): ?>

									    <? foreach ($theme->questionThemeExperts as $expert): ?>
											 <? if($i>0 && !(isset($expert_quest)&& $expert_quest->questionThemeExperts(array('id_theme'=>$expert->idTheme)))):continue; endif;?>
    										<option value="<?= $expert->idExpert->id ?>" <?= isset($expert_quest)?($expert->idExpert->id==$expert_quest->id)?'selected':'':''?>><?= $expert->idExpert->name ?></option>
    									<? endforeach ?>
										 <?$i++;?>
									<? endforeach ?>
								</select>
							</div>
							<div class="row" id="Question_body">
								<label>Вопрос</label>
								<textarea class="text" name="Quest[body]" style="height: 100px"></textarea>
								<span class="error_reg" ></span>
							</div>
							<? if (Yii::app()->user->isGuest): ?>
								<div class="row"  id="Question_user_name">
									<label>Ваше Имя</label>
									<input type="text" class="text uname" name="Quest[user_name]"/>
									<span class="error_reg" ></span>
								</div>
								<div class="row" id="Question_user_mail">
									<label>E-mail</label>
									<input type="email" class="text uemail" name="Quest[user_mail]"/>
									<span class="error_reg" ></span>
								</div>
							<? endif ?>
							<div class="capcha-wrap" id="Users_captcha">
								<label>Код с картинки</label>
								<input type="text" class="text code-text" id="captcha_text" name="captcha"/>

								<div class="image-wrap">

									<div class="image" style="position: relative;">
										<img src="<?= CHtml::normalizeUrl(array('user/captcha')) ?>"
											 alt="image description" width="100" height="30" id="captcha"/>
									</div>
									<a class="other">Показать другой код</a>
								</div>
								<span class="error_reg" ></span>

							</div>
							<div style="padding: 2% 18%;">
								<input id="send_quest" class="quest_buttom" value="Задать вопрос " type="button" onclick="submitHandler()">
								<a href="<?= CHtml::normalizeUrl(array('site/experts')) ?>"
								   style="font-size: 12px;padding-left: 10px;">Назад к вопросам</a>
							</div>

						</fieldset>
					</form>


					<script type="text/javascript">
					//	$('.items').trigger('liszt:updated');
						$(function () {

							$('.other').click(function () {
								d = new Date();
								$("#captcha").attr("src", "<?= CHtml::normalizeUrl(array('user/captcha'))?>?" + d.getTime());
							});
							$('.forgot-submit').click(function (e) {
								$.post('<?= CHtml::normalizeUrl(array('user/forgot'))?>', {email: $('#email').val()}, function (data) {
									alert(data);
								});
								return false;
							});
						});
					$("#themes").change(function() {
						$.get("<?= CHtml::normalizeUrl(array('site/reguestthemes'))?>", {id: $(this).val()},  function(data) {
							$('#experts').html(data);
							$('.items_experts').trigger('liszt:updated');
						});
					});
					$('.form_register').on('click', '#send_quest', function(){
						var item =$(this).parent(1);
						item.toggleClass('loader');
						var html_old =item.html();
						loader(item);
							$.ajax({
								url:  "<?= CHtml::normalizeUrl(array('site/expertForm'))?>",
								type: "POST",
								data: jQuery('#sub_form').serialize(),
								async:false,
								success: function(data){
									$('.personal-form span.error_reg').text('');
									$('.personal-form input').css({'border':'1px solid #DDD'});
									var json_obj;
									var json=JSON.parse(data);

									if(!json['m']){
										for ( json_obj in json ) {
											var text=json[json_obj];
											$('#'+json_obj+' span.error_reg').text(text);
											$('#'+json_obj+' input').css({'border':'1px solid #F76C6C'});
										}
										loader_end(item, html_old);
									}
									if(json['m']=='ok'){
										loader_end(item, html_old);
										$('.discussion_box').html('<p>Ваш вопрос успешно отправлен <a href="<?= CHtml::normalizeUrl(array('site/experts')) ?>" style="font-size: 12px;padding-left: 10px;">Назад к вопросам</a></p>')
									}
								}
							});
						});
					</script>
				</div>
			<? else: ?>
			<p>Ваш вопрос успешно отправлен <a href="<?= CHtml::normalizeUrl(array('site/experts')) ?>" style="font-size: 12px;padding-left: 10px;">Назад к вопросам</a></p>
			<? endif ?>
		</div><!-- END DISCUSSINS -->

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