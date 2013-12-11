<?php
//Yii::app()->user->checkAccess('0') проверка
return array(
	'0' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Guest',
		'bizRule' => null,
		'data' => null
	),
	'1' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'User',
		'children' => array(
			'guest', // унаследуемся от гостя
		),
		'bizRule' => null,
		'data' => null
	),
	'77' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Experts',
		'children' => array(
			'user',          // позволим модератору всё, что позволено пользователю
		),
		'bizRule' => null,
		'data' => null
	),
	'100' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Administrator',
		'children' => array(
			'moderator',         // позволим админу всё, что позволено модератору
		),
		'bizRule' => null,
		'data' => null
	),
);