<?php

class HomeController extends ControllerAdmin {

    public function Index() {
        if ($this->Authentication() == true) {
            $this->View->Render();
        }
    }

    public function GetCounts() {
        $d = &$this->Data;
        $tbl = $this->Filter($_GET['pg']);
        $name = $this->Filter($_GET['lng']);
        $id = $this->Filter($_GET['pid']);
        $d['dOn'] = $this->Model->GetCountOn($tbl);
        $d['dOff'] = $this->Model->GetCountOff($tbl);
        $d['dAll'] = $d['dOn'] + $d['dOff'];
        $d['dpID'] = $id;
        $d['d_Page'] = $this->_['_' . $name];
        $d['d_On'] = str_format($this->_['_On'], $this->_['_' . $name]);
        $d['d_Off'] = str_format($this->_['_Off'], $this->_['_' . $name]);
        $d['d_All'] = str_format($this->_['_All'], $this->_['_' . $name]);
        $d['d_View'] = str_format($this->_['_View'], $this->_['_' . $name]);

        $this->View->RenderOnly('Home/GetCounts');
    }

    public function SignIn() {
        Session::Init();
        $_ = &$this->_;
        $this->View->Title = $_['_SignIn'];
        if (Request::IsPost()) {
            $Data = array();
            $Data['AdminUserName'] = $this->Filter($_POST['UserName']);
            $Data['AdminPassword'] = $this->Filter(Encrypt($_POST['Password']));
            $Auth = $this->Model->SignIn($Data);
            if ($Auth) {
                Session::Set('AdminUser', $Auth);
                Redirect(ADM_BASE);
            }
        }
        $this->View->RenderOnly(null, false);
    }

    public function SignOut() {
        Session::Init();
        Session::Destroy();
        Redirect(ADM_BASE);
    }

    protected function GetForm() {

    }

    protected function LoadData($Data) {

    }

    protected function Validation() {

    }

}

