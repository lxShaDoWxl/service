<?php

Yii::import('admin.models._base.BaseBook');

class Book extends BaseBook
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function stats(){
		switch($this->status){
			case 1:
				return 'РБК';
				break;
			case 2:
				return 'Бизнес & Власть';
				break;
		}
	}
	public function formatSize()
	{
		$bytes=@filesize(YiiBase::getPathOfAlias('webroot').$this->url);
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' Gb';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' Mb';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' Kb';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}

		return $bytes;
	}
	public function Exist(){
		$path_info = pathinfo($this->url);
		return strtoupper($path_info['extension']);
	}
}