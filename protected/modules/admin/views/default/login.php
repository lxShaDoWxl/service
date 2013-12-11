<link href='http://fonts.googleapis.com/css?family=Mystery+Quest' rel='stylesheet' type='text/css'>
<form class="login" method="POST">
	<div class="logo">manti<strong>core</strong></div>

	<?php if (isset($login_error)): ?>
	<div class="login-error">
		<?= $login_error ?>
	</div>	
	<?php endif ?>

	<fieldset>
		<input class="username" name="login" type="text" required placeholder="Логин">
		<input class="password" name="pass" type="password" required placeholder="Пароль">
	</fieldset>

	<br>

	<input type="submit" class="submit" value="Войти">
</form>

<script type="text/javascript">
	$(function() {
		$('.login-error').slideToggle(400);
	});
</script>