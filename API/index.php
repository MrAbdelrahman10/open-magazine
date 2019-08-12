<?php
require_once '../System/Libraries/Config.php';
require_once '../System/Libraries/Defines.php';
define('API_URL', SITE_URL . 'API/');
define('API_BASE', API_URL . BASE);
define('API_PATH', BASE_DIR . 'API/');
define('API_LIB', API_PATH . 'Libraries/');
define('API_MODELS', API_PATH . 'Models/');
define('API_CONTROLLERS', API_PATH . 'Controllers/');
define('API_LANG', 'Arabic');
define('API_LANG_DIR', API_PATH . 'Language/' . API_LANG . '/');
include API_LIB . 'Controller.php';

$Registry = Registry::GetInstance();

$FullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ReqUrl = substr($FullUrl, strlen(API_BASE));
$Url = isset($ReqUrl) ?
        explode('/', rtrim(substr($ReqUrl, 0, (strpos($ReqUrl, '?') > 0) ?
                                        strpos($ReqUrl, '?') :
                                        strlen($ReqUrl)))) :
        null;

$Class = isset($Url[0]) && !empty($Url[0]) ? $Url[0] : 'home';
$Method = isset($Url[1]) && !empty($Url[1]) ? $Url[1] : 'index';
$Parameter = (isset($Url[2])) ? $Url[2] : null;
$CacheFile = "$Class-$Method-$Parameter";

//Cache::EchoJson($CacheFile);

$Registry->CurrentUrl = substr($FullUrl, 0, (strpos($FullUrl, '?') > -1) ?
                strpos($FullUrl, '?') : strlen($FullUrl));

$FC = FullCurrentUrl($FullUrl);

// <editor-fold defaultstate="collapsed" desc="Lib">
$db = new Database();
$db->Url = $Registry->CurrentUrl . (strpos($FC, '?') > -1 ? $FC . '&' : $FC . '?');

$img = new Image();
$Registry->Image = $img;
// </editor-fold>

$Settings = Cache::Get('Settings');
if (!$Settings) {
    $AllSettings = $db->GetRows("Select * From setting");
    if (!$AllSettings) {
        exit();
    }
    foreach ($AllSettings as $s) {
        $Settings['s' . $s['Name']] = $s['Value'];
    }
    Cache::Set('Settings', $Settings);
}
$Registry->Settings = $Settings;

$File = API_CONTROLLERS . $Class . '.php';
if (file_exists($File)) {
    require_once $File;
} else {
    RedirectNotFound();
    return;
}

// Start Default Data
$Registry->Data['pID'] = $Class;
$Registry->Data['pAction'] = $Method;
$Registry->Data['pParameter'] = $Parameter;
$Registry->Data['pUrl'] = API_BASE . $Class . '/' . $Method . '/' . $Parameter;

// End Defualt Data
// <editor-fold defaultstate="collapsed" desc="Load Controller">
Session::Init();
$ControllerClass = $Class . 'Controller';
$Controller = new $ControllerClass;
$Controller->Model = $Controller->LoadModel($Class);
$Controller->Model->db = $db;
$Controller->CacheFile = $CacheFile;
$Controller->pUser = $Controller->Model->pUser = Session::Get(_UD);
// </editor-fold>


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
    $Controller->index();
}

function RedirectNotFound() {
    echo 'API Not Found';
//Redirect(API_BASE);
}