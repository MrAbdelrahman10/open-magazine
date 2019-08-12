<?php

class SettingController extends ControllerAdmin {

    public function Index() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $Data = $this->GetData();
                foreach ($Data as $key => $value) {
                    $this->Model->Update($key, $value);
                }
                Cache::Delete();
                if (Request::IsAjax())
                    return;
            }
            $this->Data['dSite_Themes'] = $this->GetWebsiteThemes();
            $this->Data['dAdministrator_Themes'] = $this->GetAdministratorThemes();
            $this->Data['dRow'] = $this->Model->GetAll();
            $this->View->Render();
        }
    }

    protected function GetData() {
        $rem = array('ExtraScripts');
        return $this->FilterPost($rem);
    }

    private function GetAdministratorThemes() {
        return '<option value="MrAbdelrahman10">MrAbdelrahman10</option>';
    }

    private function GetWebsiteThemes() {
        return '<option value="MrAbdelrahman10">MrAbdelrahman10</option>';
    }

    protected function GetForm() {

    }

    protected function Validation() {

    }

}

?>