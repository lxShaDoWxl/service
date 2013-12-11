<?php

Yii::import('admin.models._base.BaseDebats');

class Debats extends BaseDebats
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function relations() {

		return array(
			'commentsDebatsIndex' => array(self::HAS_MANY, 'CommentsDebat', 'debat_id',
				'group'=>'author_id',
				'limit'=>10,
			),

		)+ parent::relations();

	}
	public function attributeLabels() {

		return array(
						'commentsDebatsIndex' => null,
		)+parent::attributeLabels();
	}
}