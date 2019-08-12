<?php

class ViewAdmin extends View {

    public function Render($vName = null) {
        if (isset($_GET['rel']) && $_GET['rel'] == 'ajax') {
            $this->RenderOnly($vName);
            return;
        }
        extract($this->_);
        extract($this->Data);
        extract($this->Settings);
        $Page = '';
        if ($vName) {
            $Page = $vName;
        } else {
            $Page = $pID . DIRECTORY_SEPARATOR . $pAction;
        }
        $this->PageContents = ADM_CURRENT_THEME . 'Pages/' . $Page . '.php';
        $this->SharedScript = ADM_TEMPLATE_SHARED . 'Script.php';
        require_once ADM_CURRENT_DIR_TEMPLATE . 'Index.php';
    }

public function RenderOnly($vName = null, $LoadScript = true, $LoadHead = false) {
        extract($this->_);
        extract($this->Data);
        extract($this->Settings);
        $Page = '';
        if ($LoadHead == true) {
            require_once ADM_TEMPLATE_SHARED . 'Head.php';
        }
        if ($vName) {
            $Page = $vName;
        } else {
            $Page = $pID . DIRECTORY_SEPARATOR . $pAction;
        }
        require_once ADM_CURRENT_THEME . 'Pages/' . $Page . '.php';
        if ($LoadScript == true) {
            require_once ADM_TEMPLATE_SHARED . 'Script.php';
        }
    }

}