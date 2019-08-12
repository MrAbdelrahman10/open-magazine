<?php

/**
 *
 * @author abduo
 */
class profileController extends ControllerAPI {

    public function index() {
        if ($this->Authentication()) {

        }
    }

    public function signin() {
        Session::Init();
        if (Request::IsPost()) {
            $_ = $this->LoadLangFile();
            $Data = $this->GetJsonData();
            $Data['Password'] = $this->Filter(Encrypt($Data['Password']));
            $i = $this->Model->SignIn($Data);
            if (!$i) {
                EchoExit($_['_User_Login_Error']);
            } elseif ($i['State'] == 0) {
                EchoExit($_['_User_Admin_DeActive']);
            } elseif ($i['IsActive'] == 0) {
                EchoExit($_['_User_DeActive']);
            } else {
                Session::Set(_UD, $i);
                unset($i['Password']);
                EchoJson($i);
            }
        }
    }

    public function register() {
        if (Request::IsPost()) {
            $this->_ = $this->LoadLangFile();
            $d = $this->RegisterValidation();
            if ($d) {
                EchoJson($d);
            }
            $Data = $this->GetJsonData();
            $Data['Password'] = $this->Filter(Encrypt($Data['Password']));
            $UserID = $this->Model->Add($Data);
            $this->MailNewUser();
            $User = $this->Model->GetByID($UserID);
            unset($User['Password']);
            Session::Set(_UD, $User);
            EchoExit($this->_['_Reg_Success']);
        }
    }

    private function MailNewUser() {
        $Data = $this->GetJsonData();
        $Mail = new Mail();
        $Mail->From = $this->Settings['sEmail'];
        $Mail->FromName = $this->Settings['sSite_Name'];
        $Mail->To = $Data['Email'];
        $Mail->Subject = $this->Settings['sSite_Name'];
        $Mail->Body = str_format($this->_['_RegMsg'], $Data['FullName'], $Data['UserName']);
        $Mail->Send();
    }

    protected function RegisterValidation() {
        $Data = $this->GetJsonData();
        $Valid = array(
            new ErrorField('FullName', 'FullName', $Data['FullName'], true, NULL, 50, 3),
            new ErrorField('UserName', 'UserName', $Data['UserName'], true, NULL, 20, 3, $this->Model->CheckUserName($Data['UserName'], GetValue($this->Data['pParameter'], 0)), false),
            new ErrorField('Email', 'Email', $Data['Email'], true, FieldType::Email, 50, 3, $this->Model->CheckEmail($Data['Email'], GetValue($this->Data['pParameter'], 0)), false),
            new ErrorField('Password', 'Password', $Data['Password'], true, NULL, 50, 3)
        );

        return $this->DoValidation($Valid);
    }

    public function changepassword() {
        if ($this->Authentication())
            if (Request::IsPost()) {
                $this->_ = $this->LoadLangFile();
                $json = $this->ChangePasswordValidation();
                if ($json) {
                    EchoJson($json);
                }
                $Data = $this->GetPasswordData();
                $this->Model->ChangePassword($Data);
                $this->UpdateUserData();
                EchoExit($this->_['_Updated_Password']);
            }
    }

    private function GetPasswordData() {
        $Data = $this->GetJsonData();
        $Data["ID"] = $this->pUser['ID'];
        $Data["OldPassword"] = $this->Filter(Encrypt($Data["OldPassword"]));
        $Data["Password"] = $this->Filter(Encrypt($Data["NewPassword"]));
        return $Data;
    }

    private function ChangePasswordValidation() {
        $Data = $this->GetJsonData();
        $Valid = array(
            new ErrorField('OldPassword', 'OldPassword', Encrypt($Data['OldPassword']), true, FieldType::String, 0, 0, null, null, $this->pUser['Password']),
            new ErrorField('NewPassword', 'NewPassword', $Data['NewPassword'], true, FieldType::String, 12, 4),
            new ErrorField('rNewPassword', 'rNewPassword', $Data['rNewPassword'], true, FieldType::String, 0, 0, null, null, $Data['NewPassword'])
        );
        return $this->DoValidation($Valid);
    }

    public function forgotpassword() {
        if (Request::IsPost()) {
            $this->_ = $this->LoadLangFile();
            $json = $this->ForgotPasswordValidation();
            if ($json) {
                EchoExit($json);
            }
            $np = GenerateWord(4);
            $Data = $this->GetJsonData();
            $Data['Password'] = Encrypt($np);
            $this->Model->ForgotPassword($Data);

            $Mail = new Mail();
            $Mail->To = $Data['Email'];
            $Mail->Subject = $this->_['_Restore_Password'];
            $Mail->Body = $this->_['_New_Password'] . $np;
            $Mail->Send();
            EchoExit($this->_['_Restored_Password']);
        }
    }

    private function ForgotPasswordValidation() {
        $Data = $this->GetJsonData();
        $Valid = array(
            new ErrorField('Email', 'Email', $Data['Email'], true, FieldType::Email, 50, 3, $this->Model->CheckEmail($Data['Email']), true)
        );
        $Error = $this->DoValidation($Valid);
        return $Error ? $Error['Email'] : null;
    }

    public function GenerateWord($Len) {
        require_once APP_LIB . 'Generator.php';
        $Gen = new Generator();
        return $Gen->RandomID($Len);
    }

    public function changemobile() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $this->_ = $this->LoadLangFile();
                $json = null; //$this->ChangeEmailValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetJsonData();
                $this->Model->EditMobile($Data);
                $this->UpdateUserData();
                EchoExit($this->_['_SavedDone']);
            }
        }
    }

    public function changeemail() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $this->_ = $this->LoadLangFile();
                $json = $this->ChangeEmailValidation();
                if ($json) {
                    EchoExit($json['Email']);
                }
                $Data = $this->GetJsonData();
                $this->Model->ChangeEmail($Data);
                $this->UpdateUserData();
                EchoExit($this->_['_SavedDone']);
            }
        }
    }

    private function ChangeEmailValidation() {
        $Data = $this->GetJsonData();
        $Valid = array(
            new ErrorField('Email', 'Email', $Data['Email'], true, FieldType::Email, 50, 3, $this->Model->CheckEmail($Data['Email']), false)
        );

        return $this->DoValidation($Valid);
    }

    public function mydata() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->MyDataValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetMyData();
                $this->Model->ChangeInfo($Data);
                $this->UpdateUserData();
                $json['Msg'] = $this->_['_SavedDone'];
                echo json_encode($json);
                return;
            } else {
                $Data = $this->pUser;
                $this->Data['dFullName'] = $Data['FullName'];
            }
            $this->View->Render();
        }
    }

    private function GetMyData() {
        $Data = $this->GetData();
        $Data["ID"] = $this->pUser['ID'];
        return $Data;
    }

    private function MyDataValidation() {
        $json = array();
        $Data = $this->GetMyData();
        $FullName = $Data['FullName'];
        $e = &$json['Error'];
        $_ = &$this->_;

        if (empty($FullName)) {
            $e["FullName"] = str_format($_['_Error_Required'], $_['_FullName']);
        } else if (GetLength($FullName) > 50) {
            $e["FullName"] = str_format($_['_Error_Max_Length'], $_['_FullName'], 50);
        }

        return ($e) ? $json : null;
    }

    private function UpdateUserData() {
        Session::Init();
        $UD = Session::Get(_UD);
        $Data = $this->Model->GetByID($UD['ID']);
        Session::Set(_UD, $Data);
    }

    public function signout() {
        Session::Init();
        Session::Destroy();
        $_ = $this->LoadLangFile();
        EchoExit($_['_SignOut']);
    }

    public function notifications() {
        if ($this->Authentication()) {
            EchoJson($this->Model->GetNotifications());
        }
    }

    public function read_notification($id) {
        if ($this->Authentication()) {
            $d = array();
            $ID = intval($id);
            if ($ID > 0) {
                $r = $this->Model->ReadNotification(intval($ID));
                if ($r > 0) {
                    $d['Result'] = true;
                } else {
                    $d['Result'] = false;
                }
            }
            EchoJson($d);
        }
    }

    public function delete_notification() {
        if ($this->Authentication()) {
            $d = array();
            $Data = $this->GetJsonData();
            $ID = intval($Data['ID']);
            if ($ID > 0) {
                $r = $this->Model->DeleteNotification(intval($ID));
                if ($r > 0) {
                    $d['Result'] = true;
                } else {
                    $d['Result'] = false;
                }
            }
            EchoJson($d);
        }
    }

    public function delete_notifications() {
        if ($this->Authentication()) {
            $d = array();
            $r = $this->Model->DeleteNotifications();
            if ($r > 0) {
                $d['Result'] = true;
            } else {
                $d['Result'] = false;
            }
            EchoJson($d);
        }
    }
}