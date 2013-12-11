<?php $this->pageTitle = Yii::app()->name . " - Вход и регистрация"; ?>
<?php $baseUrl = Yii::app()->request->baseUrl ?>

			<div class="intro-box">
				<div class="reg-box">
					<div class="forms-wrap">
						<form action="<?= CHtml::normalizeUrl(array('user/login'))?>" class="auth-form" method="post">
							<fieldset class="autorize">
								<h3>Авторизация</h3>
								
								<?php if($error != 'none') {
									echo $error2;
									echo "<p style='color: #D00000'>Вы ввели неверный пароль и/или имя пользователя. Попытайтесь еще раз.</p>";
								} else { ?>
								<p>Если Вы уже создали свой личный кабинет, авторизуйтесь здесь. </p>
								<?php } ?>
								<div class="row">
									<label>E-mail:</label>
									<input type="text" class="text" name="LoginForm[mail]" />
								</div>
								<div class="row">
									<label>Пароль:</label>
									<input type="password" class="text" name="LoginForm[password]" />
									<input type="submit" class="submit" value="Вход" />
								</div>
								<a href="#" class="forgot forgot-hide">Забыли пароль?</a>
							</fieldset>
							<fieldset class="forgot-form hidden">
								<h3>Восстановление пароля</h3>
								<p>Для восстановления пароля, пожалуйста, введите E-mail, на который был зарегистрирован Ваш личный кабинет.</p>
								<div style="height: 15px"></div>
								<div class="row">
									<span style="float: left; position: relative; top: 1px">E-mail: &nbsp;&nbsp;&nbsp;</span>
									<input type="text" id="email" class="text">
									<button class="forgot-submit ">Восстановить</button>
								</div>
								<a href="#" class="remember forgot" style="left: -55px">Вспомнили пароль?</a>
							</fieldset>
						</form>
						<form action="#" class="reg-form">
							<fieldset>
								<h3>Регистрация</h3>
								<a class="create">Создать кабинет</a>
							</fieldset>
						</form>
					</div>
					<div class="image-holder">
						<img src="<?php echo $baseUrl; ?>/images/img39.jpg" alt="image description" width="292" height="312" />
					</div>
					<div class="reg-info">

						<!-- <p>Все выбранные Вами косметические средства по уходу ДО ПОДТВЕРЖДЕНИЯ ЗАКАЗА проходят предварительное соответствие с данными Вашего Персонального Профайла - тип, фототип кожи лица и тела, структура волос, степень их повреждения, цветовой нюанс, состояние кожи головы, а также состояние кутикулы и ногтевой пластины. </p>
						<p>Мы настоятельно рекомендуем ОБНОВЛЯТЬ Ваш профайл каждый раз при авторизации в целях максимально эффективного индивидуального подбора средств. </p> -->
					</div>
				</div>
			</div>

			<div class="popup" id="popup">
				<form action="<?php echo $baseUrl; ?>/user/login" class="personal-form pf" method="post">
					<div class="step1">
					<fieldset>
						<div class="title-holder">
							<span class="step">Шаг 1</span>
							<strong>Личные данные</strong>
						</div>
						<span class="fields-note"><span style="font-size:14px">*</span> Все поля, отмеченные этим знаком, обязательны для заполнения!</span>
						<div class="row">
							<label>Имя<span>*</span>:</label>
							<input type="text" class="text uname" name="user[name]" />
						</div>
						<div class="row">
							<label>Фамилия<span>*</span>:</label>
							<input type="text" class="text usurname" name="user[surname]" />
						</div>
						<div class="row">
							<label>Отчество:</label>
							<input type="text" class="text ufname" name="user[fname]"/>
						</div>
						<div class="row">
							<label>Пол<span>*</span>:</label>
							<select class="usex" name="user[sex]">
								<option value="2">Женский</option>
								<option value="1">Мужской</option>
							</select>
						</div>
						<div class="row row-type">
							<label>Дата рождения<span>*</span>:</label>
							<select class="select1 uday" name="user[day]">
								<?php for ($i=1; $i < 32; $i++) { 
									echo "<option>$i</option>\n";
								} ?>
							</select>
							<select class="select1 umonth" name="user[month]">
								<?php for ($i=1; $i < 13; $i++) { 
									echo "<option>$i</option>\n";
								} ?>
							</select>
							<select class="select2 uyear" name="user[year]">
								<?php for ($i=date('Y') - 75; $i < date('Y') - 15; $i++) { 
									echo "<option>$i</option>\n";
								} ?>
							</select>
						</div>
						<div class="row">
							<label>E-mail (логин)<span>*</span>:</label>
							<input type="email" class="text uemail" name="user[email]"/>
						</div>
						<div class="row">
							<label>Подтвердите e-mail<span>*</span>:</label>
							<input type="email" class="text ucheck" name="user[check]"/>
						</div>
						<div class="row">
							<label>Пароль<span>*</span>:</label>
							<input type="password" class="text upass" name="user[password]"/>
							<span class="note">(не менее 6 символов)</span>
						</div>
						<div class="row">
							<label>Подтвердите пароль<span>*</span>:</label>
							<input type="password" class="text urepass" name="user[repassword]"/>
						</div>
						<div style="height: 15px"></div>
						<div class="row">
							<label>Контактный телефон 1<span>*</span>:</label>
							<input type="text" class="text utel1" name="user[tel1]"/>
						</div>
						<div class="row">
							<label>Контактный телефон 2<span>*</span>:</label>
							<input type="text" class="text utel2" name="user[tel2]"/>
						</div>
						<div class="row row-type">
							<label>Контактный телефон 3:</label>
							<input type="text" class="text" name="user[tel3]"/>
						</div>
						<div class="capcha-wrap">
							<span class="label" style="position: relative; left: -7px">Защита от автоматической регистрации:</span>
							<div class="image-wrap">

								<div class="image"  style="position: relative;">
									<img src="<?php echo $baseUrl; ?>/user/captcha" alt="image description" width="85" height="17" id="captcha" />
								</div>
								<a class="other">Показать другой код</a>
							</div>
							<input type="text" class="text code-text" id="captcha_text" />
							<span class="note">Введите код, указанный на картинке.</span>
						</div>
						<div class="row check-holder">
							<input type="checkbox" class="checkbox" id="id1" name="user[subscibed]" checked/>
							<label for="id1">Я согласна/-ен получать информацию о специальных предложениях и новостях от COSMETIQUE.</label>
						</div>
						<div class="row">
							<a class="next-step">Шаг 2</a>
							<p>Регистрируясь на сайте, Вы автоматически соглашаетесь с <a href="<?= $baseUrl ?>/site/page/8" target="_blanks">Пользовательским Соглашением</a>.</p>
						</div>
					</fieldset>
					</div>
				</form>

				<a class="close">Закрыть</a>
			</div>

<script type="text/javascript">

	$(function() {
		$('.register-submit').click(function() {
			$('.pf').submit();
		});

		$('.other').click(function() {
			d = new Date();
			$("#captcha").attr("src", "<?= $baseUrl ?>/user/captcha?"+d.getTime());
		});

		$('.forgot-hide').click(function() {
			$('.forgot-form').show();
			$('.autorize').hide();
		});

		$('.remember').click(function() {
			$('.forgot-form').hide();
			$('.autorize').show();
		});

		$('.forgot-submit').click(function(e) {
			$.post('<?= $baseUrl ?>/user/forgot', {email : $('#email').val()}, function(data) {
				alert(data);
			});
			return false;
		});


		$(".create").click(function() {

		
		$(".step2", ".popup").hide();
		$(".step1", ".popup").show();

		showPopup();

		var $checkFields = "";

		$(".next-step", $(".step1", ".popup")).click(function() {
			checker(this);
		});

		$(".back", $(".step2", ".popup")).click(function() {
			$(".step2", ".popup").hide();
			$(".step1", ".popup").show();
		});
	});
	});

	function checker(e) {
		$checkFields = ""			
		if($('.uname').val() == "") $checkFields = "Заполните поле имени";
		if($('.usurname').val() == "") $checkFields = "Заполните поле фамилии";
		if($('.usex').val() == "") $checkFields = "Укажите свой пол";
		if($('.uemail').val() == "" || $(".uemail").val() != $(".ucheck").val()) $checkFields = "Неправильно заполнено поле E-mail";
		if($('.upass').val().length < 6 || $(".upass").val() != $(".urepass").val()) {
			$checkFields = "Неправильно заполнено поле с паролем";
		} 
		if($('.utel1').val() == "" || $('.utel2').val == "" || $('.utel1').val() == $('.utel2').val()) $checkFields = "Укажите как минимум 2 контактных телефона";

		captchaCheck = "";
		$.ajax({
        	url:  "<?= $baseUrl ?>/user/captchaCheck",
	        type: "POST",
	        data: {'captcha': $('#captcha_text').val()},
	        async:false,
			success: function(data){
				captchaCheck=data;
			}
		});

		if(captchaCheck != 'ok') $checkFields = "Заполните слово для защиты от ботов";
			

		if($checkFields == "") {
			$(".step1", ".popup").hide();
			$(".step2", ".popup").show();
		} else {
		 	alert($checkFields);
		}
	}

	function submitHandler() {
		// if(checker(this) == "") return true;
		// else return false;
		return true;
	}
</script>