<?php

/**
 * This is the model base class for the table "comments_debat".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CommentsDebat".
 *
 * Columns in table "comments_debat" available as properties of the model,
 * followed by relations of table "comments_debat" available as properties of the model.
 *
 * @property integer $id
 * @property integer $debat_id
 * @property integer $author_id
 * @property string $date
 * @property string $comment
 *
 * @property AnswerCommentDebat[] $answerCommentDebats
 * @property Debats $debat
 * @property Users $author
 */
abstract class BaseCommentsDebat extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'comments_debat';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CommentsDebat|CommentsDebats', $n);
	}

	public static function representingColumn() {
		return 'date';
	}

	public function rules() {
		return array(
			array('debat_id, author_id, date, comment', 'required'),
			array('debat_id, author_id', 'numerical', 'integerOnly'=>true),
			array('date', 'length', 'max'=>255),
			array('id, debat_id, author_id, date, comment', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'answerCommentDebats' => array(self::HAS_MANY, 'AnswerCommentDebat', 'comment_debat_id'),
			'debat' => array(self::BELONGS_TO, 'Debats', 'debat_id'),
			'author' => array(self::BELONGS_TO, 'Users', 'author_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'debat_id' => null,
			'author_id' => null,
			'date' => Yii::t('app', 'Date'),
			'comment' => Yii::t('app', 'Comment'),
			'answerCommentDebats' => null,
			'debat' => null,
			'author' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('debat_id', $this->debat_id);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('comment', $this->comment, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}