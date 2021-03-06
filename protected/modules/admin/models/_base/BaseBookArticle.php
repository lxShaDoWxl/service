<?php

/**
 * This is the model base class for the table "book_article".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "BookArticle".
 *
 * Columns in table "book_article" available as properties of the model,
 * followed by relations of table "book_article" available as properties of the model.
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $book_id
 *
 * @property Catalog $article
 * @property Book $book
 */
abstract class BaseBookArticle extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'book_article';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'BookArticle|BookArticles', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('article_id, book_id', 'required'),
			array('article_id, book_id', 'numerical', 'integerOnly'=>true),
			array('id, article_id, book_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'article' => array(self::BELONGS_TO, 'Catalog', 'article_id'),
			'book' => array(self::BELONGS_TO, 'Book', 'book_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'article_id' => null,
			'book_id' => null,
			'article' => null,
			'book' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('article_id', $this->article_id);
		$criteria->compare('book_id', $this->book_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}