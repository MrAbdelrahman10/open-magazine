<?php

class UserController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('User/Form');
    }


    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('FullName', 'FullName', $Data['FullName'], true, NULL, 50, 3),
            new ErrorField('UserName', 'UserName', $Data['UserName'], true, NULL, 15, 3, $this->Model->CheckUserName($Data['UserName'], GetValue($this->Data['pParameter'], 0)), false),
            new ErrorField('Email', 'Email', $Data['Email'], true, FieldType::Email, 50, 3, $this->Model->CheckEmail($Data['Email'], GetValue($this->Data['pParameter'], 0)), false),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );
        if ($this->Data['pAction'] == 'Add') {
            $Valid[] = new ErrorField('Password', 'Password', $Data['Password'], true, NULL, 50, 3);
        }
        return $this->DoValidation($Valid);
    }

}