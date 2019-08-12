<?php

interface IController {

    public function Index();
}

interface ITheme {

    public function GetCategories();

    public function GetPages();

    public function GetFooterLinks();

    public function GetMainMenu();

    public function GetLastArticles();

    public function GetTicker();

    public function GetMostViewed();

    public function GetLastComic();

    public function GetLastGallery();

    public function GetPoll();

    public function GetBanners();

    public function GetLastVideos();
}

class Controller {

    public $View;
    public $Model;
    public $JsonParser;
    public $_ = array();
    public $Data = array();

    public function __construct() {
        $Registry = Registry::GetInstance();
        $this->_ = &$Registry->_;
        $this->Data = &$Registry->Data;
        $this->Model = &$Registry->Model;
        $this->Image = &$Registry->Image;
        $this->Settings = &$Registry->Settings;
        $this->JsonParser = new JsonParser();
        $this->View = new View();
    }

    public function LoadModel($Name) {
        if (IncludeFileOnce(APP_MODELS . $Name . '.php', true)) {
            $ModelName = $Name . 'Model';
            return new $ModelName;
        }
    }

    protected function Filter($Value, $addSlashes = true) {
        if (intval($Value)) {
            return $Value;
        }
        if (is_array($Value)) {
            return $Value;
        }
        if ($addSlashes == true) {
            return (htmlspecialchars(trim(addslashes($Value))));
        }
        return $Value;
    }

    protected function FilterPost(array &$remSlashes = null) {
        $data = array();
        if (Request::IsPost() && count($_POST) > 0) {
            foreach ($_POST as $key => $value) {
                if ($remSlashes) {
                    for ($i = 0; $i < count($remSlashes); $i++) {
                        if (in_array($key, $remSlashes)) {
                            $data[$key] = $this->Filter($value, FALSE);
                        } else {
                            $data[$key] = $this->Filter($value);
                        }
                    }
                } else {
                    $data[$key] = $this->Filter($value);
                }
            }
        }
        return $data;
    }

    protected function LoadDropDown($Data, $ID, $Value, $Choose = '_Choose') {
        $DataList = $Data;
        $Output = '<option value="0">' . $this->_[$Choose] . '</option>';
        foreach ($DataList as $I) {
            $Output .= '<option value="' . $I[$ID] . '">' . $I[$Value] . '</option>';
        }
        return $Output;
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
            $Data = array('UserName' => $_POST['UserName'],
                'Password' => Encrypt($_POST['Password'])
            );
            $Res = $this->Model->Authentication($Data);
            if ($Res != null) {
                Session::Set(_UD, $Res);
                return true;
            }
        }
        Redirect(GetRewriteUrl('profile/signin'));
        return false;
    }

    public function BuildMenu() {
        $Menus = $this->Model->GetMenus();
        $Data = array();
        foreach ($Menus as $m) {
            if ($m['Title'] == 'allcats') {
                $cats = $this->Model->GetCategories();
                foreach ($cats as $c) {
                    if ($c['SortingOrder'] > 0) {
                        $cat = $c;
                        $cat['Link'] = 'news/c/' . $c['ID'];
                        $cat['Alias'] = $c['Alias'];
                        $cat['Title'] = $c['Name'];
                        $cat['ParentID'] = $m['ID'];
                        $Data[] = $cat;
                    }
                }
            } else {
                $Data[] = $m;
            }
        }
        return $Data;
    }

    protected function SetMenuLink($Link, $Alias = '') {
        if (strstr($Link, 'http://') || strstr($Link, 'javascript:void(0)')) {
            return $Link;
        }
        return GetRewriteUrl($Link, $Alias);
    }

    protected function GetData() {
        return $this->FilterPost();
    }


    protected function DoValidation(array $Data) {
        $json = array();
        $e = array();
        $_ = &$this->_;
        foreach ($Data as $i) {
            $ID = $i->ID;
            $Name = $i->Name ? GetValue($_[$i->Name], $i->Name) : null;
            $Value = $i->Value;
            $Type = $i->Type;
            $Array = $i->Array;
            $InArray = $i->InArray;
            $Equal = $i->Equal;
            if ($ID && $Name) {
                if ($i->Required == true && empty($Value) && $Type != FieldType::Bool) {
                    $e[$ID] = str_format($_['_Error_Required'], $_['_' . $Name]);
                } elseif ($i->MaxLength > 0 && GetLength($Value) > $i->MaxLength) {
                    $e[$ID] = str_format($_['_Error_Max_Length'], $_['_' . $Name], $i->MaxLength);
                } elseif ($i->MinLength > 0 && GetLength($Value) < $i->MinLength) {
                    $e[$ID] = str_format($_['_Error_Min_Length'], $_['_' . $Name], $i->MinLength);
                } elseif (($Type == FieldType::Integer && !is_numeric($Value)) ||
                        ($Type == FieldType::Email && !(filter_var($Value, FILTER_VALIDATE_EMAIL)))) {
                    $e[$ID] = str_format($_['_Error_Incorrect'], $_['_' . $Name]);
                } elseif ($Equal && $Value != $Equal) {
                    $e[$ID] = str_format($_['_Error_Is_Not_Matched'], $_['_' . $Name]);
                } elseif ($Array != null || $Array == false) {
                    if ($InArray == false && $Array == true) {
                        $e[$ID] = str_format($_['_Error_Is_Found'], $_['_' . $Name]);
                    } elseif ($InArray == true && $Array == false) {
                        $e[$ID] = str_format($_['_Error_Is_Not_Found'], $_['_' . $Name]);
                    }
                }
            }
        }
        return $e;
    }

    function EchoErrors($json) {
        foreach ($json as $k => $v) {
            $this->Data['err' . $k] = $v;
        }
    }

    protected function GetBannerPositions() {
        return array(
            array(// row #1
                'ID' => 1,
                'BannerPositionAlias' => 'Header',
                'Height' => 90,
                'Width' => 728,
            ),
            array(// row #2
                'ID' => 2,
                'BannerPositionAlias' => 'Left1',
                'Height' => 280,
                'Width' => 300,
            ),
            array(// row #3
                'ID' => 3,
                'BannerPositionAlias' => 'Left2',
                'Height' => 280,
                'Width' => 300,
            ),
            array(// row #4
                'ID' => 4,
                'BannerPositionAlias' => 'Left3',
                'Height' => 125,
                'Width' => 125,
            ),
            array(// row #5
                'ID' => 5,
                'BannerPositionAlias' => 'Left4',
                'Height' => 125,
                'Width' => 125,
            ),
            array(// row #6
                'ID' => 6,
                'BannerPositionAlias' => 'Home',
                'Height' => 60,
                'Width' => 460,
            ),
        );
    }

}
