<?php

require_once '../System/Libraries/Config.php';
require_once '../System/Libraries/Defines.php';

$Template = 'MrAbdelrahman10';
$Area = 'Admin';
define('ADM_URL', SITE_URL . $Area . '/');
define('ADM_BASE', ADM_URL . BASE);
define('ADM_PATH', BASE_DIR . $Area . '/');
define('ADM_LIB', ADM_PATH . 'Libraries/');
define('ADM_Common', ADM_PATH . 'Common/');
define('ADM_MODELS', ADM_PATH . 'Models/');
define('ADM_CONTROLLERS', ADM_PATH . 'Controllers/');
define('ADM_VIEWS', ADM_PATH . 'Views/');
define('ADM_SCRIPTS', ADM_VIEWS . 'Scripts/');
define('ADM_CURRENT_THEME', ADM_VIEWS . 'Themes/' . $Template . '/');
define('ADM_CURRENT_DIR_PAGES', ADM_CURRENT_THEME . 'Pages/');
define('ADM_CURRENT_DIR_TEMPLATE', ADM_CURRENT_THEME . 'Files/');
define('ADM_CURRENT_URL_TEMPLATE', ADM_URL . 'Views/Themes/' . $Template . '/Files/');
define('ADM_TEMPLATE_SHARED', ADM_CURRENT_THEME . 'Shared/');
define('ADM_LANG', 'English');
define('ADM_LANG_DIR', ADM_PATH . 'Language/' . ADM_LANG . '/');
include ADM_LIB . 'Helper.php';
include ADM_LIB . 'Enum.php';
include ADM_LIB . 'Controller.php';
include ADM_LIB . 'Model.php';
include ADM_LIB . 'View.php';

$Registry = Registry::GetInstance();
$_FullUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$Registry->FullUrl = "http://$_FullUrl";

$ReqUrl = str_replace(ADM_BASE, '', substr($Registry->FullUrl, 0, strpos($Registry->FullUrl, '?')? : strlen($Registry->FullUrl)));

$Url = explode('/', $ReqUrl);
$Registry->CurrentUrl = ROOT_URL . $Area . '/' . $ReqUrl;

$FC = FullCurrentUrl();

// <editor-fold defaultstate="collapsed" desc="Lib">
$db = new Database();
$db->Url = $FC;

$img = new Image();
$Registry->Image = $img;
// </editor-fold>

$Settings = Cache::Get('Settings');
if (!$Settings) {
    $AllSettings = $db->GetRows("Select * From setting");
    if (!$AllSettings) {
        exit('No Settings Installed');
    }
    foreach ($AllSettings as $s) {
        $Settings['s' . $s['Name']] = $s['Value'];
    }
    Cache::Set('Settings', $Settings);
}
$Registry->Settings = $Settings;

define('REWRITE_URL_STYLE', $Settings['sRewriteUrl']);
$Class = isset($Url[0]) && !empty($Url[0]) ? $Url[0] : 'Home';
$Method = isset($Url[1]) && !empty($Url[1]) ? $Url[1] : 'Index';
$Parameter = (isset($Url[2])) ? $Url[2] : null;

$File = ADM_CONTROLLERS . $Class . '.php';
if (file_exists($File)) {
    include_once $File;
} else {
    RedirectNotFound();
    return;
}

// Start Language Loading
$_ = array();
include ADM_LANG_DIR . 'Database.php';
$db->_ = $_;
include APP_LANG_DIR . 'Attribute.php';
include ADM_LANG_DIR . 'Local.php';
include ADM_LANG_DIR . 'Error.php';
include ADM_LANG_DIR . 'Pages/' . $Class . '.php';
$Registry->_ = $_;
// End Language Loading
// Start Default Data
$Registry->Data['pID'] = $Class;
$Registry->Data['pAction'] = $Method;
$Registry->Data['pParameter'] = $Parameter;
$Registry->Data['pUrl'] = ADM_BASE . $Class . '/' . $Method . '/' . $Parameter;
$Registry->Data['dButtons'] = true;

// End Defualt Data
// <editor-fold defaultstate="collapsed" desc="Load Controller">
$ControllerClass = $Class . 'Controller';
$Controller = new $ControllerClass;
$Controller->Model = $Controller->LoadModel($Class);
$Controller->Model->db = $db;
$Controller->Data['pUser'] = $Controller->Model->pUser = $Controller->GetLoggedUser();
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
    $Controller->Index();
}

function RedirectNotFound() {
    Redirect(ADM_BASE);
}
