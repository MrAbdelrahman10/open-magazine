<?php

abstract class ControllerAPI extends Controller {

    public $View;
    public $Model;
    public $JsonParser;
    public $_ = array();
    public $Data = array();

    public function __construct() {
        $Registry = Registry::GetInstance();
        $this->_ = &$Registry->_;
        $this->Data = &$Registry->Data;
        $this->Image = &$Registry->Image;
        $this->Settings = &$Registry->Settings;
        $this->JsonParser = new JsonParser();
    }

    public function LoadModel($Name) {
        if (IncludeFileOnce(APP_MODELS . $Name . '.php', true)) {
            $ModelName = $Name . 'Model';
            return new $ModelName;
        }
    }

    protected function Authentication() {
        Session::Init();
        $Data = Session::Get(_UD);
        if ($Data != null) {
            $Auth = $this->Model->Authentication($Data);
            if ($Auth) {
                return true;
            } else {
                return false;
            }
        } else if (Request::IsPost() == true) {
            $Data = $this->GetJsonData();
            if (GetValue($Data['AuthUserName']) && GetValue($Data['AuthPassword'])) {
                $UD = array();
                $UD['UserName'] = $Data['AuthUserName'];
                $UD['Password'] = Encrypt($Data['AuthPassword']);
                $Res = $this->Model->Authentication($UD);
                if ($Res != null) {
                    Session::Set(_UD, $Res);
                    $this->Data['pUser'] = $this->Model->pUser = $Res;
                    return true;
                } else {
                    $_ = $this->LoadLangFile();
                    EchoExit($_['_User_Login_Error']);
                }
            }
        }
        $_ = $this->LoadLangFile();
        EchoExit($_['_Must_Be_Login']);
    }

    protected function LoadLangFile() {
        $_ = array();
        include API_LANG_DIR . 'Local.php';
        $LangFile = API_LANG_DIR . 'Pages/' . $this->Data['pID'] . '.php';
        if (file_exists($LangFile)) {
            include_once $LangFile;
        }
        return $_;
    }

}