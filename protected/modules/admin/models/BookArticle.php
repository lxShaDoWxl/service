<?php

Yii::import('admin.models._base.BaseBookArticle');

class BookArticle extends BaseBookArticle
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}