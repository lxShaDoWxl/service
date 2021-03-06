<?php

/**
 * This is the model base class for the table "users_image".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UsersImage".
 *
 * Columns in table "users_image" available as properties of the model,
 * followed by relations of table "users_image" available as properties of the model.
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $url
 *
 * @property Users $idUser
 */
abstract class BaseUsersImage extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users_image';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UsersImage|UsersImages', $n);
	}

	public static function representingColumn() {
		return 'url';
	}

	public function rules() {
		return array(
			array('id_user, url', 'required'),
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>255),
			array('id, id_user, url', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_user' => null,
			'url' => Yii::t('app', 'Url'),
			'idUser' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('id_user', $this->id_user);
		$criteria->compare('url', $this->url, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}