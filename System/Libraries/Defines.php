<?php

date_default_timezone_set('Africa/Cairo');
$Template = 'MrAbdelrahman10'; //isset($_GET['theme']) ? $_GET['theme'] :
define('APP_PATH', BASE_DIR . 'Application/');
define('APP_LIB', BASE_DIR . 'System/Libraries/');
define('APP_HELPERS', BASE_DIR . 'System/Helpers/');
define('APP_PLUGINS_DIR', BASE_DIR . 'System/Plugins/');
define('APP_PLUGINS', ROOT_URL . 'System/Plugins/');
define('APP_MODELS', APP_PATH . 'Models/');
define('APP_CONTROLLERS', APP_PATH . 'Controllers/');
define('APP_VIEWS', APP_PATH . 'Views/');
define('APP_PAGES', APP_VIEWS . $Template . '/');
define('APP_CACHE', BASE_DIR . 'Cache/');
define('APP_PUBLIC', ROOT_URL . 'Public/');
define('APP_LANG', 'Arabic');
define('APP_LANG_DIR', APP_PATH . 'Language/' . APP_LANG . DIRECTORY_SEPARATOR);

//Media Urls
define('APP_MEDIA', 'Media/');
define('APP_IMAGES', APP_MEDIA . 'Images/');
define('APP_IMAGES_THUMB', APP_MEDIA . 'thumb/');
//Media Dirs
define('APP_MEDIA_DIR', BASE_DIR . 'Media/');
define('APP_IMAGES_DIR', APP_MEDIA_DIR . 'Images/');
define('APP_IMAGES_THUMB_DIR', APP_MEDIA_DIR . 'thumb/');

define('APP_CURRENT_PAGES_TEMPLATE', APP_VIEWS . $Template . '/');
define('APP_CURRENT_DIR_TEMPLATE', BASE_DIR . 'Themes/' . $Template . '/');
define('APP_CURRENT_URL_TEMPLATE', SITE_URL . 'Themes/' . $Template . '/');

require_once APP_HELPERS . 'Html.php';
require_once APP_HELPERS . 'Language.php';
require_once APP_HELPERS . 'Text.php';
require_once APP_HELPERS . 'Files.php';
require_once APP_HELPERS . 'Url.php';
require_once APP_HELPERS . 'Image.php';
require_once APP_LIB . 'Enum.php';
require_once APP_LIB . 'Strings.php';
require_once APP_LIB . 'Registry.php';
require_once APP_LIB . 'Request.php';
require_once APP_LIB . 'Cache.php';
require_once APP_LIB . 'Image.php';
require_once APP_LIB . 'Session.php';
require_once APP_LIB . 'Cookie.php';
require_once APP_LIB . 'RSSWriter.php';
require_once BASE_DIR . 'System/Plugins/PHPMailer/class.phpmailer.php';
require_once APP_LIB . 'Mail.php';
require_once APP_LIB . 'JsonParser.php';
require_once APP_LIB . 'Database/PDO.php';
require_once APP_LIB . 'Controller.php';
require_once APP_LIB . 'Model.php';
require_once APP_LIB . 'View.php';
require_once APP_CURRENT_DIR_TEMPLATE . 'ThemeController.php';