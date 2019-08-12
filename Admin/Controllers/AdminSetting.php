<?php

class AdminSettingController extends ControllerAdmin {

    protected function GetForm() {
        $this->Data['dUsers'] = $this->LoadDropDown($this->Model->GetAllUsers(), 'ID', 'UserName');
        $this->Data['dPages'] = $this->AdminPages();
        $this->View->Render('AdminSetting/Form');
    }

    protected function GetData() {
        $Data = parent::GetData();
        if (GetValue($_POST['Password']))
            $Data['Password'] = $this->Filter(Encrypt($_POST['Password']));
        return $Data;
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array();

        $FullName = array(
            'ID' => 'FullName',
            'Name' => '_FullName',
            'Value' => $Data['FullName'],
            'Required' => true,
            'MaxLength' => 50);
        $Valid[] = $FullName;

        $UserName = array(
            'ID' => 'UserName',
            'Name' => '_UserName',
            'Value' => $Data['UserName'],
            'Required' => true,
            'MaxLength' => 8);
        $Valid[] = $UserName;

        if (GetValue($_POST['Password'])) {
            $Password = array(
                'ID' => 'Password',
                'Name' => '_Password',
                'Value' => $_POST['Password'],
                'Required' => true,
                'MaxLength' => 8);
            $Valid[] = $Password;
        }

        $Email = array(
            'ID' => 'Email',
            'Name' => '_Email',
            'Value' => $Data['Email'],
            'Required' => true,
            'Type' => 'email',
            'MaxLength' => 25);
        $Valid[] = $Email;

        $json = $this->DoValidation($Valid);
        $e = &$json;
        $_ = &$this->_;
        if (!isset($json['UserName'])) {
            if ($this->Model->GetByUserName($UserName['Value'], $Data['ID']) == true) {
                $e[$UserName['ID']] = $this->str_format($_['_Error_Is_Found'], $_['_UserName']);
            }
        }

        if (!isset($json['Email'])) {
            if ($this->Model->GetByEmail($Email['Value'], $Data['ID']) == true) {
                $e[$Email['ID']] = $this->str_format($_['_Error_Is_Found'], $_['_Email']);
            }
        }

        return $e;
    }

}