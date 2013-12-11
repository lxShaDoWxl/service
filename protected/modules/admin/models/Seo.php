<?php

Yii::import('admin.models._base.BaseSeo');

class Seo extends BaseSeo
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}