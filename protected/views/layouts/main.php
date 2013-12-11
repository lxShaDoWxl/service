<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="<?=isset($this->seo->keywords)?$this->seo->title:$this->seo_default ?>">
	<meta name="description" content="<?=isset($this->seo->description)?$this->seo->title:$this->seo_default ?>">
	<title><?=isset($this->seo->title)?$this->seo->title:$this->seo_default ?></title>
    <link rel="stylesheet" type="text/css" href="<?=  $this->base_url ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans+Caption">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?=  $this->base_url ?>/css/media_queries.css">
	<link rel="stylesheet" type="text/css" href="<?=  $this->base_url ?>/css/humane.css">
	<link rel="stylesheet" type="text/css" href="<?=  $this->base_url ?>/css/chosen.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/prototype/PeriodicalExecuter.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/humane.min.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/jquery.infinitescroll.min.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?=  $this->base_url ?>/js/main.js"></script>



	<? if (Yii::app()->user->checkAccess('100')): ?>
		<script type="text/javascript" src="<?= $this->base_url ?>/js/admin.js"></script>
	<? endif ?>
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

</head>

<body>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27957853-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter12724009 = new Ya.Metrika({id:12724009,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });
 
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
 
    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/12724009" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/ru_RU/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<div class="wrapper">

<div class="grid_header clearfix">
    <div class="logo_header">
        <a href="<?=  $this->base_url ?>/">AND</a>
    </div>
    <div class="header_menu_wr">
        <div class="header_login_box clearfix">

            <ul class="login_box">
                <li class="lb_left">
                    <a href="<?= CHtml::normalizeUrl(array('site/about')) ?>"">О нас</a>
                    <a href="<?= CHtml::normalizeUrl(array('site/about','url'=>'sub')) ?>">Подписка</a>
                </li>
                <li class="lb_right">
					<? if(Yii::app()->user->isGuest): ?>
	                    <a href="#" id="login">Вход</a>
	                    <a href="<?= CHtml::normalizeUrl(array('user/Registration')) ?>">Регистрация</a>
					<? else: ?>
						<a href="<?= CHtml::normalizeUrl(array('user/lk')) ?>">Личный кабинет</a>
						<a href="<?= CHtml::normalizeUrl(array('user/Logout'))?>">Выход</a>
	                <?endif?>
                </li>
                <li class="lb_fb">
					<div style="float: right;padding-left: 32%;"><a href="https://twitter.com/_andkz" class="twitter-follow-button" data-show-count="false" data-lang="ru">Читать @_andkz</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>


					<!--                    <a href="#"><img src="/images/fb_button.png" /></a>-->
                </li>
            </ul>
            <div class="header_search">
                <form action="<?= CHtml::normalizeUrl(array('site/search')) ?>">
                    <button type="submit"></button>
                    <input name="search" type="text" value="" />
                </form>
            </div>
		<div class="header_menu_new">
			<span class="header_menu_button">Меню</span>
			<ul class="header_menu clearfix">
            <? $menu_i=0;
			$menus= Menu::model()->findAll(array('condition'=>'active=1','order'=>'position'));
			foreach($menus as $value): ?>
                <li <?= ($menu_i==0)?'class="current"':'' ?>><a href="<?= CHtml::normalizeUrl(array($value->url))?>"><?=$value->title?></a></li>
            <? $menu_i++;
			endforeach ?>

        </ul>
    </div>
		</div>
	</div>

    <div class="header_small_menu">
<!--        <ul class="clearfix">-->
<!--            <li><a href="#">Мухтар Аблязов</a></li>-->
<!--            <li><a href="#">Девальвация</a></li>-->
<!--            <li><a href="#">Саммит 2013</a></li>-->
<!--            <li><a href="#">Отставки и назначения</a></li>-->
<!--            <li><a href="#">Конференция Geek Picnic 2013</a></li>-->
<!--            <li><a href="#">Инновации</a></li>-->
<!--        </ul>-->
        <div class="header_media_horizontal">

			<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'940x90_1'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));
			?>
			<? if ($banner_header): ?>
				<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
				<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
					<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>" target="_blank">
						<img style="display: inline;"  src="<?= $banner_header[$number_ban]->img ?>"/></a>
				<? endif ?>
				<? if ($banner_header[$number_ban]->exist()=='swf'): ?>
					<div class="banner" data-id="<?=$banner_header[$number_ban]->id?>">
						<object type="application/x-shockwave-flash" width="100%" height="90px">
							<param name="movie" value="<?= $banner_header[$number_ban]->img ?>"></param>
							<param name="wmode" value="opaque"></param>
						</object>
					</div>
				<? endif ?>
			<? endif ?>
        </div>
    </div>

</div>
    <div class="grid_main clearfix"> <!-- MAIN COLUMN -->
    <?= $content; ?>
        <div class="header_media_horizontal">
			<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'940x90_2'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));?>
			<? if ($banner_header): ?>
				<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
				<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
					<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>" target="_blank">
						<img style="display: inline;"  src="<?= $banner_header[$number_ban]->img ?>"/></a>
				<? endif ?>
				<? if ($banner_header[$number_ban]->exist()=='swf'): ?>
					<div class="banner" data-id="<?=$banner_header[$number_ban]->id?>">
						<object type="application/x-shockwave-flash" width="100%" height="90px">
							<param name="movie" value="<?= $banner_header[$number_ban]->img ?>"></param>
							<param name="wmode" value="opaque"></param>
						</object>
					</div>
				<? endif ?>
			<? endif ?>

		</div>
    </div>
<div class="grid_footer clearfix">
    <div class="footer_logo"><a href="#">AND</a></div>
    <div class="footer_menu">
        <p> <?=Settings::get('foot_text_1')->value?></p>
        <ul class="clearfix">
			<?foreach($menus as $value): ?>
			<li <?= ($menu_i==0)?'class="current"':'' ?>><a href="<?= CHtml::normalizeUrl(array($value->url))?>"><?=$value->title?></a></li>
			<? endforeach ?>
        </ul>
        <p class="footer_description"><?=Settings::get('copyright')->value?></p>
        <div class="developer_logo">
			<a href="http://instinct.kz/" style="color: #262626;font-family: 'Arial';font-size: 12px;">
			Создание сайта — <img src="/images/dev_logo.png" />
			</a>
		</div>
    </div>
</div>
<!-- ZERO.kz -->
<span id="_zero_52325">
<noscript>
<a href="http://zero.kz/?s=52325" target="_blank">
<img src="http://c.zero.kz/z.png?u=52325" width="88" height="31" alt="ZERO.kz" />
</a>
</noscript>
</span>
 
<script type="text/javascript"><!--
var _zero_kz_ = _zero_kz_ || [];
_zero_kz_.push(["id", 52325]);
_zero_kz_.push(["type", 1]);
 
(function () {
    var a = document.getElementsByTagName("script")[0],
    s = document.createElement("script");
    s.type = "text/javascript";
    s.async = true;
    s.src = (document.location.protocol == "https:" ? "https:" : "http:")
    + "//c.zero.kz/z.js";
    a.parentNode.insertBefore(s, a);
})(); //-->
</script>
<!-- End ZERO.kz -->
</div>
<div class="popup forms-wrap" style="display: none">
	<form action="<?= CHtml::normalizeUrl(array('user/login'))?>" class="auth-form" method="post">
		<a class="close">Í</a>
		<fieldset class="autorize">
			<h3>вход на сайт</h3>
			<div class="popup-row">
				<label>E-mail</label>
				<input type="text" class="text" id="mail" name="LoginForm[mail]" />
			</div>
			<div class="popup-row" id="password_login">
				<label>Пароль</label>
				<input type="password" class="text" id="password" name="LoginForm[password]" />
			</div>


			<div class="popup_button">
				<input type="button" id="forgot-submit" class="send" style="display:none" value="Восстановить пароль" />
				<input type="button" id="send" class="submit" value="войти" /><a href="#" class="forgot forgot-hide">Забыли пароль?</a></div>
			<div id="error_login" class="login_error">Не правильный логин или пароль</div>
			<div id="error_login" class="forgot_error" style="display: none"></div>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.forgot').click(function(e){
			e.preventDefault();
			$("#mail").css({'border':'1px solid #DDD'});
			$('#password_login').css({display:'none'});
			$('.login_error').css({display:'none'});
			$('.forgot').css({display:'none'});
			$('.submit').css({display:'none'});
			$('#forgot-submit').css({display:'block'});
			$('.forgot_error').css({display:'block'});
		});
		$('#forgot-submit').click(function(){
			jQuery.ajax({
				'url':'<?= CHtml::normalizeUrl(array('user/forgot'))?>',
				'cache':false,
				'type':'POST',
				'data':{'mail':$('#mail').val()},
				'success':function(data){
					//window.location.href=data;
					var json= JSON.parse(data);
					if(json.m!='ok'){
						$("#mail").css('border','1px solid #F76C6C');
						$(".forgot_error").text(json.m)

					}else{
						$(".forgot_error").text('На вашу почту был отправлен новый, сгенерированный нами, пароль.')
						$("#mail").css({'border':'1px solid #DDD'}).val('');
						$('.popup.forms-wrap').fadeOut(400);
						document.location.reload();
					}
				}

			});
		});

		$('.banner').mousedown(function(e){
		if (e.which != 1) return false;
        jQuery.ajax({
            'type':'GET',
            'data':{'id':1},
            'success':function(data){
				//window.location.href=data;
            },
            'url':'<?= CHtml::normalizeUrl(array('site/banner'))?>','cache':false
            });
    	});
		$("#send").click(function() {
			if($("#mail").val() != '' && $("#password").val() != '') {
				var form=$(".auth-form").serialize();
				$.post("<?= CHtml::normalizeUrl(array('user/login'))?>", form, function(data) {
					//var json = JSON.parse(data);
					//alert(data);
					if(JSON.parse(data)!=''){
						$('#error_login').show();
						$("#mail").css('border','1px solid #F76C6C');
						$("#password").css({'border':'1px solid #F76C6C'});
					}else{
						$('.popup.forms-wrap').fadeOut(400);
						document.location.reload();
					}
				});
			} else {
				$('#error_login').show();
				$("#mail").css('border','1px solid #F76C6C');
				$("#password").css({'border':'1px solid #F76C6C'});
			}
		});

		$("#login").click(function(e){
			e.preventDefault();
			$('.popup.forms-wrap').fadeIn(400);
		});
		$(".login").click(function(e){
			e.preventDefault();
			$('.popup.forms-wrap').fadeIn(400);
		});
		$('.close', '.popup.forms-wrap').click(function() {
			$('.popup.forms-wrap').fadeOut(400);
			$("#mail").css({'border':'1px solid #DDD'});
			$("#password").css({'border':'1px solid #DDD'});
			$('#password_login').css({display:'block'});
			$('.forgot').css({display:'initial'});
			$('.submit').css({display:'initial'});
			$('#forgot-submit').css({display:'none'});
			$('.forgot_error').css({display:'none'});
		});

	});
</script>
<script type="text/javascript" src="<?=  $this->base_url ?>/js/jquery.slideshow.js"></script>
</body>
</html>