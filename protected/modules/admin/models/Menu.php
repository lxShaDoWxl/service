<?php

Yii::import('admin.models._base.BaseMenu');

class Menu extends BaseMenu
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}