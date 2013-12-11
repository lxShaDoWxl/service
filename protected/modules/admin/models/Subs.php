<?php

Yii::import('admin.models._base.BaseSubs');

class Subs extends BaseSubs
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}