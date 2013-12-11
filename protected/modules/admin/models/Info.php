<?php

/**
 * This is the model class for table "info".
 *
 * The followings are the available columns in table 'info':
 * @property integer $id
 * @property string $title
 * @property string $small_description
 * @property string $full_description
 * @property string $img
 * @property string $date
 * @property integer $active
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Seo $seo
 */
class Info extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, type', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('title, img, date, type', 'length', 'max'=>255),
			array('small_description, full_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, small_description, full_description, img, date, active, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'seo' => array(self::HAS_ONE, 'Seo', 'id_info'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'small_description' => 'Small Description',
			'full_description' => 'Full Description',
			'img' => 'Img',
			'date' => 'Date',
			'active' => 'Active',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('small_description',$this->small_description,true);
		$criteria->compare('full_description',$this->full_description,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Info the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function img() {
        if (count($this->img) > 0) {
            return $this->img;
        }
        else return "/images/no_img.png";
    }

}