<?php

Yii::import('admin.models._base.BaseFavorites');

class Favorites extends BaseFavorites
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}