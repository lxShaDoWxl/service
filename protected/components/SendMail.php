<?php
/**
 * Created by PhpStorm.
 * User: ShaDoW
 * Date: 29.11.13
 * Time: 15:52
 */

class SendMail {
	public static function Send($body, $email_for, $email_to, $title) {
			Yii::app()->mailer->Host = "185.22.64.24";
			Yii::app()->mailer->SMTPAuth = TRUE;
			Yii::app()->mailer->IsSMTP();
			Yii::app()->mailer->CharSet = 'UTF-8';
			Yii::app()->mailer->IsHTML(true);
//			Yii::app()->mailer->SMTPSecure = "ssl";
			Yii::app()->mailer->Port=465;
			Yii::app()->mailer->Username = "info@and.kz";
			Yii::app()->mailer->Password = "LXW1mYnhx8";
			Yii::app()->mailer->From = "$email_for";
			Yii::app()->mailer->FromName = 'AND';
			Yii::app()->mailer->AddAddress($email_to);
			Yii::app()->mailer->Subject = $title;
			Yii::app()->mailer->Body =  $body;
			Yii::app()->mailer->Send();
	}
} 