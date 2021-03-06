<?php

/**
 * This is the model base class for the table "webinar".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Webinar".
 *
 * Columns in table "webinar" available as properties of the model,
 * followed by relations of table "webinar" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $isVisible
 * @property string $date_start
 * @property string $date_end
 * @property string $time
 * @property integer $price
 * @property integer $id_theme
 * @property string $url
 *
 * @property ConnectWebinar[] $connectWebinars
 * @property ThemeWebinar $idTheme
 */
abstract class BaseWebinar extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'webinar';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Webinar|Webinars', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, body, isVisible, date_start, date_end, time, price, id_theme, url', 'required'),
			array('isVisible, price, id_theme', 'numerical', 'integerOnly'=>true),
			array('title, date_start, date_end, time', 'length', 'max'=>255),
			array('url', 'length', 'max'=>11),
			array('id, title, body, isVisible, date_start, date_end, time, price, id_theme, url', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'connectWebinars' => array(self::HAS_MANY, 'ConnectWebinar', 'id_webinar'),
			'idTheme' => array(self::BELONGS_TO, 'ThemeWebinar', 'id_theme'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'body' => Yii::t('app', 'Body'),
			'isVisible' => Yii::t('app', 'Is Visible'),
			'date_start' => Yii::t('app', 'Date Start'),
			'date_end' => Yii::t('app', 'Date End'),
			'time' => Yii::t('app', 'Time'),
			'price' => Yii::t('app', 'Price'),
			'id_theme' => null,
			'url' => Yii::t('app', 'Url'),
			'connectWebinars' => null,
			'idTheme' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('isVisible', $this->isVisible);
		$criteria->compare('date_start', $this->date_start, true);
		$criteria->compare('date_end', $this->date_end, true);
		$criteria->compare('time', $this->time, true);
		$criteria->compare('price', $this->price);
		$criteria->compare('id_theme', $this->id_theme);
		$criteria->compare('url', $this->url, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}