<?php

/**
 * This is the model base class for the table "comment_events_answer".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CommentEventsAnswer".
 *
 * Columns in table "comment_events_answer" available as properties of the model,
 * followed by relations of table "comment_events_answer" available as properties of the model.
 *
 * @property integer $id
 * @property integer $comment_id
 * @property integer $author_id
 * @property string $date
 * @property string $answer
 *
 * @property CommentEvents $comment
 * @property Users $author
 */
abstract class BaseCommentEventsAnswer extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'comment_events_answer';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CommentEventsAnswer|CommentEventsAnswers', $n);
	}

	public static function representingColumn() {
		return 'date';
	}

	public function rules() {
		return array(
			array('comment_id, author_id, date, answer', 'required'),
			array('comment_id, author_id', 'numerical', 'integerOnly'=>true),
			array('date', 'length', 'max'=>255),
			array('id, comment_id, author_id, date, answer', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'comment' => array(self::BELONGS_TO, 'CommentEvents', 'comment_id'),
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
			'comment_id' => null,
			'author_id' => null,
			'date' => Yii::t('app', 'Date'),
			'answer' => Yii::t('app', 'Answer'),
			'comment' => null,
			'author' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('comment_id', $this->comment_id);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('answer', $this->answer, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}