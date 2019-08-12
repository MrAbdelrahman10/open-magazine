<?php

require_once './System/Libraries/Config.php';
require_once './System/Libraries/Defines.php';
$Registry = &DoRegistry();
$Data = array();

$FullUrl = ReplaceText('www.', '', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$ReqUrl = substr($FullUrl, strlen(BASE_URL));
$Url = isset($ReqUrl) ?
        explode('/', rtrim(substr($ReqUrl, 0, (strpos($ReqUrl, '?') > -1) ?
                                        strpos($ReqUrl, '?') :
                                        strlen($ReqUrl)))) :
        null;
$Registry->CurrentUrl = substr($FullUrl, 0, (strpos($FullUrl, '?') > -1) ?
                strpos($FullUrl, '?') : strlen($FullUrl));

$FC = FullCurrentUrl($FullUrl);

// <editor-fold defaultstate="collapsed" desc="Lib">
$Registry->db = new Database();
$Registry->db->Url = (strpos($FC, '?') > -1 ? $FC . '&' : $FC . '?');

$img = new Image();
$Registry->Image = $img;

// End Lib

$Settings = Cache::Get('Settings');
if (!$Settings) {
    $AllSettings = $Registry->db->GetRows("Select * From setting");
    if (!$AllSettings) {
        exit();
    }
    foreach ($AllSettings as $s) {
        $Settings['s' . $s['Name']] = $s['Value'];
    }
    Cache::Set('Settings', $Settings);
}
define('REWRITE_URL_STYLE', $Settings['sRewriteUrl']);
$Registry->Settings = $Settings;

$Class = isset($Url[0]) && !empty($Url[0]) ? str_replace('.html', '', $Url[0]) : 'home';
$Method = isset($Url[1]) && !empty($Url[1]) ? str_replace('.html', '', $Url[1]) : 'index';
$Parameter = (isset($Url[2])) ? rtrim($Url[2], '.html') : null;

$File = APP_CONTROLLERS . $Class . '.php';
if (!IncludeFile($File)) {
    RedirectNotFound();
}

// Start Language Loading
$_ = array();
require (APP_LANG_DIR . 'Database.php');
$Registry->db->_ = $_;
require (APP_LANG_DIR . 'Local.php');
$LangFile = (APP_LANG_DIR . 'Pages/' . $Class . DIRECTORY_SEPARATOR . $Method . '.php');
if (file_exists($LangFile)) {
    include $LangFile;
}
$Registry->_ = $_;

// End Language Loading
// Start Default Data
Session::Init();
$Data['pID'] = $Class;
$Data['pAction'] = $Method;
$Data['pParameter'] = $Parameter;
$Data['psUrl'] = $Class . ($Method != 'index' ? '/' . $Method . ($Parameter ? '/' . $Parameter : '') : '');
$Data['pUrl'] = BASE_URL . ($Data['psUrl'] != 'home' ? $Data['psUrl'] : '');
$Data['pfUrl'] = $Data['pUrl'];
$Data['pImage'] = APP_CURRENT_URL_TEMPLATE . 'img/logo.png';
$Data['dTitle'] = null;
$Data['pUser'] = Session::Get(_UD);
$Data['dDescription'] = $Settings['sDescription'];
$Data['dKeywords'] = $Settings['sKeywords'];
$Data['dResults'] = array();

$Registry->Data = $Data;
// End Defualt Data
// Start Controller Loading

$ControllerClass = $Class . 'Controller';
$Controller = new $ControllerClass;
$Controller->Model = $Controller->LoadModel($Class);
$Controller->Model->db = $Registry->db;
if (!Request::IsPost())
{new ThemeController();}

// End Load Controller

if (isset($Parameter)) {
    if (method_exists($Controller, $Method)) {
        $Controller->{$Method}($Parameter);
    } else {
        RedirectNotFound();
    }
} else if (isset($Method)) {
    if (method_exists($Controller, $Method)) {
        $Controller->{$Method}();
    } else {
        RedirectNotFound();
    }
} else {
    $Controller->Index();
}

//ob_end_flush();
function RedirectNotFound() {
    Redirect(GetRewriteUrl('home/error'));
}

?>