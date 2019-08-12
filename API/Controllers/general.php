<?php

/**
 * General Methods
 */
class generalController extends Controller {

    public function thumb() {
        $url = $_GET['url'];
        $height = $_GET['height'];
        $width = $_GET['width'];
        echo GetImageThumbnail($url, $width, $height);
    }

    public function menu() {
        EchoJson($this->Model->GetMenus());
    }

    public function categories() {
        EchoJson($this->Model->GetCategories());
    }

    public function banner($id) {
        EchoJson($this->Model->GetBanners($id));
    }

    public function uploadimage() {
        if ($this->Authentication() == true) {
            if (Request::IsPost()) {
                $Img = &$this->Image;
                $Img->Name = time();
                $Img->Picture = 'Image';
                if ($Img->Upload() == true) {
                    $this->Data['dImage'] = $Img->UploadUrl . $Img->Name . '.' . $Img->Ext;
                }
            }
            $this->View->RenderOnly('general/uploadimage', false);
        }
    }

    public function uploadimage_m() {
//        if ($this->Authentication() == true) {
        if (Request::IsPost()) {
            $json = array();
            $Img = &$this->Image;
            $Img->Name = time();
            $Img->Picture = 'Image';
            if ($Img->Upload() == true) {
                $json['Image'] = $Img->UploadUrl . $Img->Name . '.' . $Img->Ext;
                EchoJson($json);
            }
        }
//        }
    }

    public function imagefromtext() {
        $img = $_POST['Image'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $Img = &$this->Image;
        $fldr = $Img->GetFolderDay();
        $fl = uniqid() . '.png';
        $data = base64_decode($img);
        $file = BASE_DIR . $fldr . $fl;
        $success = file_put_contents($file, $data);
        echo $success ? SITE_URL . $fldr . $fl : 'Unable to save the file.';
    }

    public function add_device() {
        if (Request::IsPost()) {
            $json = file_get_contents('php://input');
            $Data = array(
                'DeviceToken' => $json,
                'DeviceType' => intval(GetValue($_GET['DeviceType']))
                    );
            $ID = $this->Model->AddDevice($Data);
            EchoJson($ID);
        }
    }

    public function delete_device() {
        if (Request::IsPost()) {
            $Data = $this->GetData();
            $this->Model->DeleteDevice($Data);
        }
    }

}
