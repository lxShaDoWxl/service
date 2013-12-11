<?php

/**
 * This is the model base class for the table "event_media".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EventMedia".
 *
 * Columns in table "event_media" available as properties of the model,
 * followed by relations of table "event_media" available as properties of the model.
 *
 * @property integer $id
 * @property integer $id_event
 * @property string $type
 * @property string $url
 * @property string $title
 * @property string $date
 *
 * @property Events $idEvent
 */
abstract class BaseEventMedia extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'event_media';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EventMedia|EventMedias', $n);
	}

	public static function representingColumn() {
		return 'type';
	}

	public function rules() {
		return array(
			array('id_event, type, url', 'required'),
			array('id_event', 'numerical', 'integerOnly'=>true),
			array('type, url, title, date', 'length', 'max'=>255),
			array('title, date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, id_event, type, url, title, date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idEvent' => array(self::BELONGS_TO, 'Events', 'id_event'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_event' => null,
			'type' => Yii::t('app', 'Type'),
			'url' => Yii::t('app', 'Url'),
			'title' => Yii::t('app', 'Title'),
			'date' => Yii::t('app', 'Date'),
			'idEvent' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('id_event', $this->id_event);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('date', $this->date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}