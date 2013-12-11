<?php

Yii::import('admin.models._base.BaseBanner');

class Banner extends BaseBanner
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function exist(){
		$path_info = pathinfo($this->img);
		return $path_info['extension'];
	}
	public function post(){
		switch ($this->position){
			case '620x130':
				return '620x130 Внутри контента';
				break;
			case '240x400':
				return '240x400 Правый банер';
				break;
			case '940x90_1':
				return '940x90 Верхний';
				break;
			case '940x90_2':
				return '940x90 Нижний';
				break;
		}

	}
}