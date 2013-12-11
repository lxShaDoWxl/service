<?php

Yii::import('admin.models._base.BaseCommentCatalog');

class CommentCatalog extends BaseCommentCatalog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}