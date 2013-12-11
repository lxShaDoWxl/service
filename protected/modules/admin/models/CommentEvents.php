<?php

Yii::import('admin.models._base.BaseCommentEvents');

class CommentEvents extends BaseCommentEvents
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}