<?php

/**
 * This is the model base class for the table "book".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Book".
 *
 * Columns in table "book" available as properties of the model,
 * followed by relations of table "book" available as properties of the model.
 *
 * @property integer $id
 * @property string $url
 * @property string $body
 * @property string $number
 * @property string $title
 * @property string $date
 * @property string $img
 * @property integer $status
 *
 * @property BookArticle[] $bookArticles
 */
abstract class BaseBook extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'book';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Book|Books', $n);
	}

	public static function representingColumn() {
		return 'url';
	}

	public function rules() {
		return array(
			array('url, number, title, date, img, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('url, title, date, img', 'length', 'max'=>255),
			array('number', 'length', 'max'=>50),
			array('body', 'safe'),
			array('body', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, url, body, number, title, date, img, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'bookArticles' => array(self::HAS_MANY, 'BookArticle', 'book_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'url' => Yii::t('app', 'Url'),
			'body' => Yii::t('app', 'Body'),
			'number' => Yii::t('app', 'Number'),
			'title' => Yii::t('app', 'Title'),
			'date' => Yii::t('app', 'Date'),
			'img' => Yii::t('app', 'Img'),
			'status' => Yii::t('app', 'Status'),
			'bookArticles' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('number', $this->number, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('img', $this->img, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}