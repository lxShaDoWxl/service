<h2 class="art_title" style="width: 100%;">Регистрация</h2>
<div class="form_register">
	<form action="" class="personal-form pf" method="post" id="registration">
			<fieldset>
				<span class="fields-note"><span style="font-size:14px">*</span> Все поля, отмеченные этим знаком, обязательны для заполнения!</span>
				<div class="row" id="Users_name">
					<label>Ваше Имя<span>*</span></label>
					<input type="text" class="text uname" name="Users[name]" />
					<span class="error_reg" ></span>
				</div>
				<div class="row">
					<label>Должность</label>
					<input type="text" class="text " name="Users[position]" />
				</div>
				<div class="row">
					<label>Организация</label>
					<input type="text" class="text " name="Users[company]" />
				</div>
				<div class="row">
					<label>Контактный телефон</label>
					<input type="text" class="text utel1" name="Users[phone]"/>
				</div>
				<div class="row"  id="Users_mail">
					<label>E-mail (логин)<span>*</span></label>
					<input type="email" class="text uemail" name="Users[mail]"/>
					<span class="error_reg"></span>
				</div>

				<div class="row" id="Users_password">
					<label>Пароль<span>*</span></label>
					<input type="password" class="text upass" name="Users[password]"/>
					<span class="error_reg" ></span>
				</div>
				<div class="row" id="Users_repassword">
					<label>Подтвердите пароль<span>*</span></label>
					<input type="password" class="text urepass" name="Users[repassword]"/>
					<span class="error_reg" ></span>
				</div>
				<div class="capcha-wrap" id="Users_captcha">
					<label>Код с картинки<span>*</span></label>
					<input type="text" class="text code-text" id="captcha_text" name="captcha" />
					<div class="image-wrap">
						<div class="image"  style="position: relative;">
							<img src="<?= CHtml::normalizeUrl(array('user/captcha')) ?>" alt="image description" width="100" height="30" id="captcha" />
						</div>
						<a class="other">Показать другой код</a>
					</div>
					<span class="error_reg" ></span>
				</div>
				<div style="padding: 2% 0 0 18%;">
					<input id="send" value="Зарегистрироваться" type="button" >
				</div>

			</fieldset>
	</form>


<script type="text/javascript">

	$(function() {
		$('.register-submit').click(function() {
			$('.pf').submit();
		});

		$('.other').click(function() {
			d = new Date();
			$("#captcha").attr("src", "<?= CHtml::normalizeUrl(array('user/captcha'))?>?"+d.getTime());
		});


		$('.remember').click(function() {
			$('.forgot-form').hide();
			$('.autorize').show();
		});

	});

		$('.form_register').on('click', '#send', function(){
		if($('.upass').val()==$('.urepass').val()){

			var item =$(this).parent(1);
			item.toggleClass('loader');
			var html_old =item.html();
			loader(item);
			$.ajax({
				url:  "<?= CHtml::normalizeUrl(array('user/Registration'))?>",
				type: "POST",
				data: jQuery('#registration').serialize(),
				async:false,
				success: function(data){
					$('.personal-form span.error_reg').text('');
					$('.personal-form input').css({'border':'1px solid #DDD'});
					var json_obj;
					var json=JSON.parse(data);

					if(!json['m']){
						for ( json_obj in json ) {
							var text=json[json_obj];
							if(json_obj=='Users_password'){
								$('#Users_repassword span.error_reg').text(text);
								$('#Users_repassword input').css({'border':'1px solid #F76C6C'});
							}
							$('#'+json_obj+' span.error_reg').text(text);
							$('#'+json_obj+' input').css({'border':'1px solid #F76C6C'});
						}
						loader_end(item, html_old);
					}
					if(json['m']=='ok'){
						loader_end(item, html_old);
						document.location.reload();
					}
				}
			});
		} else{
			$('#Users_repassword span.error_reg').text('Пароли не совпадают');
			$('#Users_repassword input').css({'border':'1px solid #F76C6C'});
			$('#Users_password span.error_reg').text('Пароли не совпадают');
			$('#Users_password input').css({'border':'1px solid #F76C6C'});
		}
	});
</script>