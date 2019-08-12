<?php

/**
 * Description of Image
 *
 * @author MrAbdelrahman10@gmail.com
 */
class Image {

    public $Name = '';
    public $Ext = 'jpg';
    public $Exts = array('gif', 'jpg', 'png', 'bmp');
    public $UploadFolder = '';
    public $UploadUrl = '';
    public $MultiUploadUrl = array();
    public $Picture = 'Image';

    function Upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_folder = $this->UploadFolder = (BASE_DIR) . $this->GetFolderDay();
            $this->UploadUrl = $this->GetFolderDay();
            $pic = $_FILES[$this->Picture]['tmp_name'];
            if (isset($pic)) {
                $name = $_FILES[$this->Picture]['name'];
                $ex = explode('.', $name);
                $this->Ext = strtolower(end($ex));
                if (in_array($this->Ext, $this->Exts)) {
                    $new_name = empty($this->Name) ? time() : $this->Name;

                    $wm = null;
                    if ($wm) {
                        $upload_status = move_uploaded_file($pic, $upload_folder . $name);
                        if ($upload_status) {
                            $new_name = $upload_folder . time() . "." . $this->Ext;
                            if (watermark_image($upload_folder . $name, $new_name))
                                return true;
                        }
                    }else {
                        $upload_status = move_uploaded_file($pic, $upload_folder . $new_name . '.' . $this->Ext);
                        if ($upload_status) {
                            $new_name = $upload_folder . time() . '.' . $this->Ext;
                            return true;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    function MultipleUpload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upload_folder = $this->UploadFolder = (BASE_DIR) . $this->GetFolderDay();
            $this->UploadUrl = $this->GetFolderDay();
            for ($i = 0; $i < count($_FILES[$this->Picture]['name']); $i++) {
                $pic = $_FILES[$this->Picture]['tmp_name'][$i];
                if (isset($pic)) {
                    $name = $_FILES[$this->Picture]['name'][$i];
                    $ex = explode('.', $name);
                    $this->Ext = strtolower(end($ex));
                    if (in_array($this->Ext, $this->Exts)) {
                        $new_name = uniqid();

                        $wm = null;
                        if ($wm) {
                            $upload_status = move_uploaded_file($pic, $upload_folder . $name);
                            if ($upload_status) {
                                $new_name = $upload_folder . time() . "." . $this->Ext;
                                if (watermark_image($upload_folder . $name, $new_name)) {
                                    $this->MultiUploadUrl[] = $this->UploadUrl . $new_name . '.' . $this->Ext;
                                }
                            }
                        } else {
                            $upload_status = move_uploaded_file($pic, $upload_folder . $new_name . '.' . $this->Ext);
                            if ($upload_status) {
                                $this->MultiUploadUrl[] = $this->UploadUrl . $new_name . '.' . $this->Ext;
                            }
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $height, $width) {
        list( $source_image_width, $source_image_height, $source_image_type ) = getimagesize($source_image_path);

        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;

            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;

            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }

        if ($source_gd_image === false) {
            return false;
        }

        $thumbnail_image_width = $height;
        $thumbnail_image_height = $width;

        $source_aspect_ratio = $source_image_width / $source_image_height;
        $thumbnail_aspect_ratio = $thumbnail_image_width / $thumbnail_image_height;

        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);

        imagedestroy($source_gd_image);

        imagedestroy($thumbnail_gd_image);

        return true;
    }

    public function GetFolderDay() {
        $date = time();
        $year = date('Y', $date);
        $month = date('m', $date);
        $day = date('d', $date);

        $yearpath = APP_IMAGES_DIR . $year;
        $monthpath = APP_IMAGES_DIR . $year . DIRECTORY_SEPARATOR . $month;
        $daypath = APP_IMAGES_DIR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day;

        if (!file_exists($daypath)) {
            if (!file_exists($yearpath)) {
                mkdir($yearpath, 0777);
            }
            if (!file_exists($monthpath)) {
                mkdir($monthpath, 0777);
            }
            if (!file_exists($daypath)) {
                mkdir($daypath, 0777);
            }
        }
        return 'Media/Images/' . $year . '/' . $month . '/' . $day . '/';
    }

}
