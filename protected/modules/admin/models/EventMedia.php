<?php

Yii::import('admin.models._base.BaseEventMedia');

class EventMedia extends BaseEventMedia
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}