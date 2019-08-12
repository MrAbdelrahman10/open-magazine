<?php

class View {

    function __construct() {
        $Registry = Registry::GetInstance();
        $this->_ = &$Registry->_;
        $this->Data = &$Registry->Data;
        $this->Settings = &$Registry->Settings;
    }

    public function Render($vName = null) {
        if (isset($_GET['rel']) && $_GET['rel'] == 'ajax') {
            $this->RenderOnly($vName);
            return;
        }
        $_ = $this->_;
        $d = $this->Data;
        $s = $this->Settings;
        $Page = '';
        if ($vName) {
            $Page = $vName;
        } else {
            $Page = $d['pID'] . DIRECTORY_SEPARATOR . $d['pAction'];
        }
        $PageContents = APP_CURRENT_PAGES_TEMPLATE . $Page . '.php';
        $SharedScript = APP_CURRENT_DIR_TEMPLATE . 'SharedScript.php';
        require_once (APP_CURRENT_DIR_TEMPLATE . 'Index.php');
    }

    public function RenderOnly($vName = null, $LoadScript = true) {
        $_ = $this->_;
        $d = $this->Data;
        $s = $this->Settings;
        $Page = '';
        if ($vName) {
            $Page = $vName;
        } else {
            $Page = $d['pID'] . DIRECTORY_SEPARATOR . $d['pAction'];
        }
        include(APP_CURRENT_PAGES_TEMPLATE . $Page . '.php');
    }

    public function LoadScript($Page) {
        $Scr = explode('/', $Page);
        $File = APP_SCRIPTS . $Scr[0] . DIRECTORY_SEPARATOR . $Scr[1] . '.php';
        return $File;
    }

}