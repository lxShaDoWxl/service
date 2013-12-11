<?php

Yii::import('admin.models._base.BaseCatalog');

class Catalog extends BaseCatalog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function img() {
        if (count($this->itemImages) > 0) {
            return $this->itemImages[0]->img_url;
        }
        else return "/images/no_img.png";
    }
	public function datarus(){

	}
}