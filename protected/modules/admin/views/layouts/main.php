<!DOCTYPE html>

<html>
<head>
	<title>manticore</title>
	<meta name="language" content="Russian" charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="<?= $this->baseUrl ?>/css/style-admin.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->baseUrl ?>/css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->baseUrl ?>/css/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->baseUrl ?>/css/humane.css">
	<link rel="stylesheet" type="text/css" href="<?= $this->baseUrl ?>/instinct/css/chosen.css">

	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/mgmt-script.js"></script>
	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/dropzone.js"></script>
	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
 	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/humane.min.js"></script>
	<script type="text/javascript" src="<?= $this->baseUrl ?>/js/chosen.jquery.min.js"></script>
</head>

<body>

	<div class='icon-menu'>
<!--       <a href="--><?php //echo CHtml::normalizeUrl(array('orders/index', 'status'=>'Новый'))?><!--" class="element--><?//= isset($this->isOrders)?"active":""; ?><!--" data-title="Заказы"> w </a>-->
       	<a href="<?php echo CHtml::normalizeUrl(array('users/'))?>" class="element <?= isset($this->isUsers)?"active":""; ?>" data-title="Пользователи"> F </a>
		<a href="<?php echo CHtml::normalizeUrl(array('page/'))?>" class="element <?= isset($this->isContent)?"active":""; ?>" data-title="Контент"> d </a>
        <a href="<?php echo CHtml::normalizeUrl(array('catalog/'))?>" class="element <?= isset($this->isCatalog)?"active":""; ?>" data-title="Каталог"> p </a>
		<a href="<?php echo CHtml::normalizeUrl(array('archive/'))?>" class="element <?= isset($this->isArchive)?"active":""; ?>" data-title="Архив"> K </a>
		<a href="<?php echo CHtml::normalizeUrl(array('quest/'))?>" class="element <?= isset($this->isQuest)?"active":""; ?>" data-title="Вопросы"> t </a>
		<a href="<?php echo CHtml::normalizeUrl(array('settings/'))?>" class="element <?= isset($this->isSettings)?"active":""; ?>" data-title="Настройки"> e </a>

		<div class="tip"></div>
		
		<div class="icon-menu-logo">
			manti<b>core</b>
		</div>		
	</div>

	<div class="container">
		<div class="content-header">
			<ul class="pull-right nav">
				<li class="label"><strong><?= $this->login ?></strong></li>
				<li class="exit"> <a href="<?php echo CHtml::normalizeUrl(array('mUser/logout'))?>">Выйти</a> </li>
			</ul>

			<h1> <?= $this->title ?> </h1>

			<ul class="nav">
				<?php foreach ($this->categories as $cat): ?>
				<li <?= isset($cat['active']) ? "class=\"active\"" : "" ?>>
					<? if (isset($cat['ajax'])): ?>
						<a href="#edit" class="ajax-load" data-page="<?= $cat['url'] ?>"><?= $cat['title'] ?></a>
					<? else: ?>
						<a href="<?= $cat['url'] ?>"><?= $cat['title'] ?></a>
					<? endif ?>
					</li>
				<?php endforeach ?>
			</ul>

		</div>

		<div class="content">
			<?php echo $content; ?>
		</div>
	</div>

</body>

</html>
