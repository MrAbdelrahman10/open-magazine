<?php

class FileManagerController extends ControllerAdmin {

    function Index() {
        if ($this->Authentication()) {
            $this->View->Render();
        }
    }

    function Only() {
        if ($this->Authentication()) {
            $this->View->RenderOnly(null,true,true);
        }
    }

    protected function GetForm() {

    }

    protected function LoadData($Data) {

    }

    protected function Validation() {

    }

}
