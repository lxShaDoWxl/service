<?php

Yii::import('admin.models._base.BaseJobs');

class Jobs extends BaseJobs
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}