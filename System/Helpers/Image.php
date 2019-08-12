<?php

function GetImageThumbnail($Path, $Width = 72, $Height = 72) {
    if (!($Path && file_exists(BASE_DIR . $Path))) {
        $Path = APP_MEDIA . 'noimg.jpg';
    }
    $thumb = md5($Path) . "_" . $Width . "_" . $Height . ".jpg";
    if (!file_exists(APP_IMAGES_THUMB_DIR . $thumb)) {
        $Reg = Registry::GetInstance();
        $img = &$Reg->Image;
        $img->generate_image_thumbnail(BASE_DIR . $Path, APP_IMAGES_THUMB_DIR . $thumb, $Width, $Height);
    }
    return APP_IMAGES_THUMB . $thumb;
}

function GetImageOriginal($Path) {
    if ($Path && file_exists(BASE_DIR . $Path)) {
        return $Path;
    }
    return APP_MEDIA . 'noimg.jpg';
}

function watermark_image($oldimage_name, $new_image_name) {
    $Reg = DoRegistry();
    $wm = $Reg->Settings['sWatermark'];
    if (is_file($oldimage_name)) {
        if ($wm) {
            $image_path = BASE_DIR . $wm;
            if (file_exists($image_path)) {
                echo $oldimage_name . "\n\n\n\n";
                list($owidth, $oheight) = getimagesize($oldimage_name);
                $width = $height = 300;
                $im = imagecreatetruecolor($width, $height);
                $img_src = imagecreatefromjpeg($oldimage_name);
                imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
                $watermark = imagecreatefrompng($image_path);
                list($w_width, $w_height) = getimagesize($image_path);
                $pos_x = $width - $w_width;
                $pos_y = $height - $w_height;
                imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
                imagejpeg($im, $new_image_name, 100);
                imagedestroy($im);
                unlink($oldimage_name);
            }
        } else {
            @copy($oldimage_name, $new_image_name);
            unlink($oldimage_name);
        }
    }
    return true;
}
