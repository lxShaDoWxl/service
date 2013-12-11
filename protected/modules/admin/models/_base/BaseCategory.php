<?php

/**
 * This is the model base class for the table "category".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Category".
 *
 * Columns in table "category" available as properties of the model,
 * followed by relations of table "category" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property integer $order
 *
 * @property Catalog[] $catalogs
 */
abstract class BaseCategory extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'category';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Category|Categories', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title', 'required'),
			array('order', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('order', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, order', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'catalogs' => array(self::HAS_MANY, 'Catalog', 'cid'),
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
			'order' => Yii::t('app', 'Order'),
			'catalogs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('order', $this->order);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}