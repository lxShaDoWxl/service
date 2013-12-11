<?php

class ImageController extends Controller{


	public function actionResizeImg()
	{

	}

    public function actionResize($w,$h,$img_url){
        preg_match('|/.*/(.*.)|', $img_url, $matches);
        $files_img=Yii::getPathOfAlias('webroot.userfiles.cache').'/'.$w.'-'.$h.'_'.$matches[1];
        if (file_exists($files_img) ){
            $new_image = new ImageResize($files_img);
            $new_image->imagesave();
            $new_image->imageout();
        } else {
            $w_copy=0;
            $h_copy=0;
            $new_image = new ImageResize(Yii::app()->request->hostInfo.$img_url);
            if($new_image->image_width > $new_image->image_height){
                $new_image->imageresizewidth($w);
                $w_copy=($new_image->image_width-$new_image->image_height)/2;
            }
            else{
                $new_image->imageresizeheight($h);
                $h_copy=($new_image->image_height-$new_image->image_width)/2;
            }
            $dest = imagecreatetruecolor($w, $h);   // Создаём пустую картинку размером $x на $y
            $background_color = imagecolorallocate($dest, 255, 255, 255);
            imagefill($dest, 0, 0, $background_color);
            // Копируем картинки на общую картинку
            imagecopy ($dest, $new_image->image, $h_copy, $w_copy, 0, 0, imagesx($new_image->image), imagesy($new_image->image));
            $new_image->image=$dest;
            $new_image->imagesave();
            $new_image->imagesave($new_image->image_type,$files_img);
            $new_image->imageout();
        }
//        str_replace('|/userfiles/.*/|U','',$img_url);
    }

}
