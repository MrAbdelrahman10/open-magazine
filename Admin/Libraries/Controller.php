<?php

interface IControllerAdmin {

}

abstract class ControllerAdmin extends Controller {

    public $View;
    public $Model;
    public $cache;
    public $_ = array();
    public $Data = array();

    public function __construct() {
        $Registry = Registry::GetInstance();
        $this->_ = &$Registry->_;
        $this->Data = &$Registry->Data;
        $this->Image = &$Registry->Image;
        $this->Settings = &$Registry->Settings;
        $this->cache = &$Registry->cache;
        $this->View = new ViewAdmin();
    }

    public function LoadModel($Name) {
        if (IncludeFileOnce(ADM_MODELS . $Name . '.php', true)) {
            $ModelName = $Name . 'Model';
            return new $ModelName;
        }
    }

    protected function GetIDs($Str) {
        $IDs = array();
        $StrID = isset($Str) ? explode(',', trim($Str, ',')) : NULL;
        for ($idx = 0; $idx < count($StrID); $idx++) {
            $IDs[$idx] = $this->Filter($StrID[$idx]);
        }
        return $IDs;
    }

    protected function Authentication() {
        Session::Init();
        $Model = $this->Model;
        $Data = array();
        $User = Session::Get('AdminUser');
        if (isset($User)) {
            $Data['AdminUserName'] = $User['UserName'];
            $Data['AdminPassword'] = $User['Password'];
            $Auth = $Model->Authentication($Data);
            if ($Auth) {
                if ($Auth['IsAdmin'] == 1) {
                    return true;
                }
                $Pgs = explode(',', $Auth['Permission']);
                if ($this->Data['pID'] == 'Home' || in_array($this->Data['pID'], $Pgs)) {
                    return TRUE;
                }
                exit('Access Denied');
                return true;
            }
        }
        if ((isset($_GET['rel']) && $_GET['rel'] == 'ajax')) {
            $json = array();
            $json['RedirectError'] = ADM_BASE . 'Home/SignIn';
            echo json_encode($json);
            return;
        }
        Redirect(ADM_BASE . 'Home/SignIn');
        return false;
    }

    public function Index() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAll();
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
            $this->IndexBeforeRender();
            $this->View->Render();
        }
    }

    protected function IndexBeforeRender() {}

    public function Details() {
        if ($this->Authentication() == true) {
            $ID = $this->Filter($_GET['dID']);
            $this->Data['dRow'] = $this->Model->GetByID($ID);
            $this->View->RenderOnly();
        }
    }

    public function Add() {
        if ($this->Authentication() == true) {
            if (Request::IsPost()) {
                $json = $this->Validation();
                if ($json) {
                    if (Request::IsAjax()) {
                        EchoJson(array('Error' => $json));
                    } else {
                        $this->Data['dRow'] = $this->GetData();
                        foreach ($json as $k => $v) {
                            $this->Data['err' . $k] = $v;
                        }
                    }
                } else {
                    $Data = $this->GetData();
                    $this->BeforeAdd();
                    $this->Model->Add($Data);
                    $this->AfterAdd();
                    Cache::Delete();
                    $json['Redirect'] = ADM_BASE . $this->Data['pID'];
                    if (Request::IsAjax()) {
                        EchoJson($json);
                    } else {
                        Redirect($json['Redirect']);
                    }
                }
            } else {
                if (isset($_GET['id'])) {
                    $ID = intval($_GET['id']);
                    $this->Data['dRow'] = $this->Model->GetByID($ID);
                }
            }
            $this->GetForm();
        }
    }

    protected function BeforeAdd() {

    }

    protected function AfterAdd() {

    }

    public function Edit($ID) {
        if ($this->Authentication() == true) {
            if (Request::IsPost()) {
                $json = $this->Validation();
                if ($json) {
                    if (Request::IsAjax()) {
                        EchoJson(array('Error' => $json));
                    } else {
                        $this->Data['dRow'] = $this->GetData();
                        foreach ($json as $k => $v) {
                            $this->Data['err' . $k] = $v;
                        }
                    }
                } else {
                    $Data = $this->GetData();
                    $Data['ID'] = $ID;
                    $this->Model->Edit($Data);
                    Cache::Delete();
                    $json['Redirect'] = ADM_BASE . $this->Data['pID'];
                    if (Request::IsAjax()) {
                        EchoJson($json);
                    } else {
                        Redirect($json['Redirect']);
                    }
                }
            } else {
                $this->Data['dRow'] = $this->Model->GetByID($ID);
            }
            $this->GetForm();
        }
    }

    public function Delete() {
        if ($this->Authentication() == true) {
            $IDs = $_POST['dIDs'];
            if (Request::IsPost() && strlen($IDs) > 0) {
                $dIDs = $this->GetIDs($IDs);
                for ($idx = 0; $idx < count($dIDs); $idx++) {
                    $Mdl = $this->Data['pID'] . 'Model';
                    $this->Model->Delete($dIDs[$idx]);
                }
            }
            Cache::Delete();
            Redirect(ADM_BASE . $this->Data['pID']);
        }
    }

    public function ChangeState() {
        if ($this->Authentication() == true) {
            $ID = intval($_POST['ID']);
            $State = intval($_POST['State']);
            if ($ID > 0) {
                $this->Model->SetState($ID, $State);
                Cache::Delete();
                $this->AfterChangeState();
                EchoExit($this->_['_SavedDone']);
            }
            EchoError($this->_['_Unexpected_Error']);
        }
    }

    protected function AfterChangeState() {

    }

    protected abstract function GetForm();

    protected abstract function Validation();

    public function UploadImage() {
        if ($this->Authentication() == true) {
            $Img = &$this->Image;
            $Img->Name = time();
            $Img->Picture = 'Image';
            if ($Img->Upload() == true) {
                $this->Data['dImage'] = $Img->UploadUrl . $Img->Name . '.' . $Img->Ext;
            }
            $this->View->RenderOnly('General/UploadImage', false);
        }
    }

    public function UploadImage_Ajax() {
        if ($this->Authentication() == true) {
            $Img = &$this->Image;
            $Img->Name = time();
            $Img->Picture = 'imagealbum';
            if ($Img->Upload() == true) {
                $UploadedImage = $Img->UploadUrl . $Img->Name . '.' . $Img->Ext;

                echo json_encode(array(
                    'name' => $UploadedImage,
                    'error' => '',
                ));
                exit;
            }
        }
    }

    public function MultiUploadImage() {
        if (Request::IsPost()) {
            $Img = &$this->Image;
            $Img->Name = time();
            $Img->Picture = 'Image';
            if ($Img->MultipleUpload()) {
                EchoJson($Img->MultiUploadUrl);
            }
        }
    }

    public function DeleteFile($File) {
        if (file_exists($File)) {
            unlink($File);
        }
    }

    private function GetCategories() {
        return $this->Model->GetCategories();
    }

    protected function AdminPages() {
        $_ = &$this->_;
        $ps = array();

        $ps[] = array(
            "ID" => "Article",
            "Name" => $_["_Articles"],
            "Cats" => $this->GetCategories()
        );

        $ps[] = array("ID" => "Category",
            "Name" => $_["_Categories"]);

        $ps[] = array("ID" => "Gallery",
            "Name" => $_["_Galleries"]);

        $ps[] = array("ID" => "Comic",
            "Name" => $_["_Comics"]);

        $ps[] = array("ID" => "Paper_Archive",
            "Name" => $_["_Paper_Archives"]);

        $ps[] = array("ID" => "Page",
            "Name" => $_["_Pages"]);

        $ps[] = array("ID" => "Menu",
            "Name" => $_["_Menus"]);

        $ps[] = array("ID" => "Banner",
            "Name" => $_["_Banner"]);

//        $ps[] = array("ID" => "User",
//            "Name" => $_["_Users"]);

        $ps[] = array("ID" => "Video",
            "Name" => $_["_Videos"]);

        return $ps;
    }

    public function GetLoggedUser() {
        Session::Init();
        return Session::Get('AdminUser');
    }

    protected function AddToHistory($action_type) {
        $user = $this->pUser['UserName'];
        $action = str_format($this->_['_Admin_History_List'][$action_type], $user, $this->addedName);
        $this->Model->Add_To_History($action);
    }

    protected function GetJsonData() {
        $json = file_get_contents('php://input');
        return $this->FilterData(json_decode($json));
    }

}