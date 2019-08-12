<?php

/**
 *
 * @author abduo
 */
class profileController extends Controller {

    public function index() {
        if ($this->Authentication()) {
            $this->Data['dTitle'] = $this->_['_Profile'];
            $this->View->Render();
        }
    }

    public function signin() {
        Session::Init();
        $_ = &$this->_;
        $this->Data['dTitle'] = $_['_SignIn'];
        if (Request::IsPost()) {
            $Data = array();
            $Data['UserName'] = $this->Filter($_POST['l-UserName']);
            $Data['Password'] = $this->Filter(Encrypt($_POST['l-Password']));
            $Res = $this->Model->Authentication($Data);
            if ($Res != null) {
                Session::Set(_UD, $Res);
                Redirect(BASE_URL);
            }
            $this->Data['dError'] = $_['_Error_UserName_Password'];
        }
        $this->View->Render();
    }

    public function signin_m() {
        Session::Init();
        $_ = &$this->_;
        if (Request::IsPost()) {
            $Data = array();
            $Data['UserName'] = $this->Filter($_REQUEST['UserName']);
            $Data['Password'] = $this->Filter(Encrypt($_REQUEST['Password']));
            $Res = $this->Model->Authentication($Data);
            if ($Res != null) {
                unset($Res['Password']);
                Session::Set(_UD, $Res);
                EchoJson($Res);
            }
            exit(null);
        }
    }

    public function register() {
        if (Request::IsPost()) {
            $json = $this->RegisterValidation();
            if ($json) {
                echo json_encode($json);
                return;
            }
            $Data = $this->GetData();
            $Data['Password'] = $this->Filter(Encrypt($_POST['Password']));
            $this->Model->Add($Data);
            $this->MailNewUser();
            $json['Redirect'] = BASE_URL . 'profile/registersuccessfully';
            echo json_encode($json);
            return;
        }
        $this->Data['dTitle'] = $this->_['_Register'];
        $this->View->Render();
    }

    public function register_m() {
        $d = array();
        if (Request::IsPost()) {
            $d = $this->RegisterValidation();
            if ($d) {
                EchoJson($d);
            }
            $Data = $this->GetData();
            $Data['Password'] = $this->Filter(Encrypt($_POST['Password']));
            $UserID = $this->Model->Add($Data);
            $this->MailNewUser();
            $User = $this->Model->GetByID($UserID);
            unset($User['Password']);
            Session::Set(_UD, $User);
            $d['Result'] = $this->_['_Reg_Success'];
            EchoJson($Data);
        }
    }

    private function MailNewUser() {
        $Data = $this->GetData();
        $Mail = new Mail();
        $Mail->From = $this->Settings['sEmail'];
        $Mail->FromName = $this->Settings['sSiteName'];
        $Mail->To = $Data['Email'];
        $Mail->Subject = $this->_['_SiteName'];
        $Mail->Body = str_format($this->_['_RegMsg'], $Data['FullName'], $Data['UserName']);
        $Mail->Send();
    }

    public function registersuccessfully() {
        $this->Data['dTitle'] = $this->_['_Reg_Success'];
        $this->View->Render();
    }

    private function RegisterValidation() {
        $json = array();
        $Data = $this->GetData();
        $FullName = $Data['FullName'];
        $UserName = $Data['UserName'];
        $Password = $Data['Password'];
        $Email = $Data['Email'];
        $e = &$json['Error'];
        $_ = &$this->_;

        if (empty($FullName)) {
            $e["FullName"] = str_format($_['_Error_Required'], $_['_FullName']);
        } else if (GetLength($FullName) > 50) {
            $e["FullName"] = str_format($_['_Error_Max_Length'], $_['_FullName'], 50);
        }

        if (empty($UserName)) {
            $e["UserName"] = str_format($_['_Error_Required'], $_['_UserName']);
        } else if (GetLength($UserName) > 50) {
            $e["UserName"] = str_format($_['_Error_Max_Length'], $_['_UserName'], 50);
        } else if ($this->Model->CheckUserName($UserName) == true) {
            $e["UserName"] = str_format($_['_Error_Is_Found'], $_['_UserName']);
        }

        if (empty($Email)) {
            $e["Email"] = str_format($_['_Error_Required'], $_['_Email']);
        } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $e["Email"] = str_format($_['_Error_Incorrect'], $_['_Email']);
        } else if (GetLength($Email) > 50) {
            $e["Email"] = str_format($_['_Error_Max_Length'], $_['_Email'], 50);
        } else if ($this->Model->CheckMail($Email) == true) {
            $e["Email"] = str_format($_['_Error_Is_Found'], $_['_Email']);
        }

        if (empty($Password)) {
            $e["Password"] = str_format($_['_Error_Required'], $_['_Password']);
        } else if (GetLength($Password) > 50) {
            $e["Password"] = str_format($_['_Error_Max_Length'], $_['_Password'], 50);
        }

        return ($e) ? $json : null;
    }

    public function changepassword() {
        if ($this->Authentication())
            if (Request::IsPost()) {
                $json = $this->ChangePasswordValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPasswordData();
                $this->Model->ChangePassword($Data);
                $this->UpdateUserData();
                $json['Msg'] = $this->_['_SavedDone'];
                echo json_encode($json);
                return;
            }
        $this->Data['dTitle'] = $this->_['_ChangePassword'];
        $this->View->Render();
    }

    public function changepassword_m() {
        if ($this->Authentication())
            if (Request::IsPost()) {
                $json = $this->ChangePasswordValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPasswordData();
                $this->Model->ChangePassword($Data);
                $this->UpdateUserData();
                exit(true);
            }
    }

    private function getpassworddata() {
        $Data = array();
        $Data["ID"] = $this->Data['pUser']['ID'];
        $Data["OldPassword"] = $this->Filter(Encrypt($_POST["OldPassword"]));
        $Data["Password"] = $this->Filter(Encrypt($_POST["cPassword"]));
        return $Data;
    }

    private function ChangePasswordValidation() {
        Session::Init();
        $UD = Session::Get(_UD);
        $json = array();
        $Data = $this->GetData();
        $CurPassword = $UD[_UP];
        $OldPassword = $Data['OldPassword'];
        $Password = $_POST["cPassword"];
        $e = &$json['Error'];
        $_ = &$this->_;

        if (empty($OldPassword)) {
            $e["cOldPassword"] = str_format($_['_Error_Required'], $_['_OldPassword']);
        } else if (Encrypt($this->Filter($OldPassword)) !== $CurPassword) {
            $e["cOldPassword"] = $_['_Error_Incorrect_Password'];
        } else if (GetLength($OldPassword) > 50) {
            $e["cOldPassword"] = str_format($_['_Error_Max_Length'], $_['_OldPassword'], 50);
        }

        if (empty($Password)) {
            $e["cPassword"] = str_format($_['_Error_Required'], $_['_NewPassword']);
        } else if (GetLength($Password) > 50) {
            $e["cPassword"] = str_format($_['_Error_Max_Length'], $_['_NewPassword'], 50);
        }

        return ($e) ? $json : null;
    }

    public function forgotpassword() {
        if (Request::IsPost()) {
            $json = $this->ForgotPasswordValidation();
            if ($json) {
                echo json_encode($json);
                return;
            }
            $np = $this->GenerateWord(4);
            $Data = $this->GetData();
            $Data['Password'] = Encrypt($np);
            $this->Model->ForgotPassword($Data);

            $Mail = new Mail();
            $Mail->To = $Data['Email'];
            $Mail->Subject = $this->_['_Restore_Password'];
            $Mail->Body = $this->_['_New_Password'] . $np;
            $Mail->Send();

            $json['Msg'] = $this->_['_Password_Updated'];
            echo json_encode($json);
            return;
        }
        $this->View->Render();
    }

    public function forgotpassword_m() {
        if (Request::IsPost()) {
            $json = $this->ForgotPasswordValidation();
            if ($json) {
                EchoJson($json);
            }
            $np = GenerateWord(4);
            $Data = $this->GetData();
            $Data['Password'] = Encrypt($np);
            $this->Model->ForgotPassword($Data);

            $Mail = new Mail();
            $Mail->To = $Data['Email'];
            $Mail->Subject = $this->_['_Restore_Password'];
            $Mail->Body = $this->_['_New_Password'] . $np;
            $Mail->Send();

            $json['Result'] = true;
            EchoJson($json);
        }
    }

    private function ForgotPasswordValidation() {
        $json = array();
        $Data = $this->GetData();
        $Email = $Data["Email"];
        $e = &$json['Error'];
        $_ = &$this->_;

        $s = $this->Model->CheckMail($Email);

        if (empty($Email)) {
            $e["Email"] = str_format($_['_Error_Required'], $_['_Email']);
        } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $e["Email"] = str_format($_['_Error_Incorrect'], $_['_Email']);
        } else if ($this->Model->CheckMail($Email) == false) {
            $e["Email"] = $_['_EmailNotFound'];
        }

        return ($e) ? $json : null;
    }

    public function GenerateWord($Len) {
        require_once APP_LIB . 'Generator.php';
        $Gen = new Generator();
        return $Gen->RandomID($Len);
    }

    public function changeemail() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->ChangeEmailValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetEmailData();
                $this->Model->ChangeEmail($Data);
                $this->UpdateUserData();
                $json['Msg'] = $this->_['_SavedDone'];
                echo json_encode($json);
                return;
            }
            $this->Data['dTitle'] = $this->_['_ChangeEmail'];
            $this->Data['dEmail'] = $this->Data['pUser']['Email'];
            $this->View->Render();
        }
    }

    private function GetEmailData() {
        $Data = array();
        $Data["ID"] = $this->Data['pUser']['ID'];
        $Data["Email"] = $this->Filter($_POST["cEmail"]);
        return $Data;
    }

    private function ChangeEmailValidation() {
        $json = array();
        $Data = $this->GetEmailData();
        $Email = $Data["Email"];
        $e = &$json['Error'];
        $_ = &$this->_;

        if (empty($Email)) {
            $e["cEmail"] = str_format($_['_Error_Required'], $_['_Email']);
        } else if (GetLength($Email) > 50) {
            $e["cEmail"] = str_format($_['_Error_Max_Length'], $_['_Email'], 50);
        }

        return ($e) ? $json : null;
    }

    public function mydata() {
        if ($this->Authentication())
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
                $Data = $this->Data['pUser'];
                $this->Data['dFullName'] = $Data['FullName'];
            }
        $this->View->Render();
    }

    private function GetMyData() {
        $Data = $this->GetData();
        $Data["ID"] = $this->Data['pUser']['ID'];
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
        Redirect(BASE_URL);
    }

    public function signout_m() {
        Session::Init();
        Session::Destroy();
    }

    // <editor-fold defaultstate="collapsed" desc="Articles">
    public function posts() {
        if ($this->Authentication()) {
            $this->Data['dTitle'] = $this->_['_MyPosts'];
            $this->Data['dResults'] = $this->Model->GetUserPosts($this->Data['pUser']['ID']);
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
            $this->View->Render();
        }
    }

    public function posts_m() {
        if ($this->Authentication()) {
            $d = array();
            $d['dResults'] = $this->Model->GetUserPosts($this->Data['pUser']['ID']);
            $d['dRenderNav'] = $this->Model->db->RenderFullNav();
            EchoJson($d);
        }
    }

    public function sended() {
        if ($this->Authentication()) {
            $this->Data['dTitle'] = $this->_['_SendedNews'];
            $this->Data['dResults'] = $this->Model->GetSendedPosts($this->Data['pUser']['ID']);
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
            $this->View->Render('profile/posts');
        }
    }

    public function sended_m() {
        if ($this->Authentication()) {
            $d = array();
            $d['dResults'] = $this->Model->GetSendedPosts($this->Data['pUser']['ID']);
            $d['dRenderNav'] = $this->Model->db->RenderFullNav();
            EchoJson($d);
        }
    }

    public function sendnews() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->PostValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPostData();
                $Data['IsArticle'] = 0;
                $Data['IsSended'] = 1;
                $this->Model->AddPost($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/sended';
                echo json_encode($json);
                return;
            }
            $this->Data['dTitle'] = $this->_['_SendNews'];
            $this->Data['dResults'] = true;
            $this->GetPostForm();
        }
    }

    public function sendnews_m() {
//        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->PostValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPostData();
                $Data['UserID'] = $this->Data['pUser']['ID'];
                $Data['IsArticle'] = 0;
                $Data['IsSended'] = 1;
                $json['ID'] = $this->Model->AddPost($Data);
                EchoJson($json);
            }
//        }
    }

    public function addpost() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->PostValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPostData();
                $Data['IsArticle'] = 1;
                $Data['IsSended'] = 0;
                $this->Model->AddPost($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/posts';
                echo json_encode($json);
                return;
            }
            $this->Data['dTitle'] = $this->_['_AddPost'];
            $this->Data['dResults'] = true;
            $this->GetPostForm();
        }
    }

    public function editpost($aID) {
        if ($this->Authentication()) {
            $ID = $this->Filter($aID);
            if (Request::IsPost()) {
                $json = $this->PostValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetPostData();
                $Data['ID'] = $ID;
                $this->Model->EditPost($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/Posts';
                echo json_encode($json);
                return;
            }
            $Data = $this->Model->GetPostByID($ID, $this->Data['pUser']['ID']);
            if ($Data) {
                $this->LoadPostData($Data);
                $this->Data['dResults'] = true;
            } else {
                $this->Data['dResults'] = false;
            }
            $this->Data['dTitle'] = $this->_['_Edit'];
            $this->GetPostForm();
        }
    }

    private function GetPostForm() {
        $this->Data['dPostCategories'] = $this->LoadDropDown($this->Model->GetCategories(), 'ID', 'Name');
        $this->View->Render('profile/postform');
    }

    protected function GetPostData() {
        $rem = array('Contents');
        $Data = $this->FilterPost($rem);
        $Data['Description'] = SubText(strip_tags($_POST['Contents']), 0, 500);
        $Data['UserID'] = $this->Data['pUser']['ID'];
        return $Data;
    }

    public function deletepost() {
        if ($this->Authentication() == true) {
            $ID = isset($_GET['dID']) ? intval($_GET['dID']) : null;
            if ($ID) {
                $this->Model->DeletePost($ID, $this->Data['pUser']['ID']);
            }
            Redirect(BASE_URL . $this->Data['pID'] . '/Posts');
        }
    }

    private function LoadPostData($Data) {
        if ($Data) {
            $this->Data['dID'] = $Data['ID'];
            $this->Data['dCategoryID'] = $Data['CategoryID'];
            $this->Data['dCategoryName'] = $Data['CategoryName'];
            $this->Data["daTitle"] = $Data["Title"];
            $this->Data["dsTitle"] = $Data["sTitle"];
            $this->Data["dAlias"] = $Data["Alias"];
            $this->Data["dPictureDescription"] = $Data["PictureDescription"];
            $this->Data["dContents"] = $Data["Contents"];
            $this->Data["dDescription"] = $Data["Description"];
            $this->Data["dKeywords"] = $Data["Keywords"];
            $this->Data['dPicture'] = $Data['Picture'];
            $this->Data['dUserID'] = $Data['UserID'];
            $this->Data['dUserName'] = $Data['UserName'];
            $this->Data['dPhotoAlbum'] = $Data['PhotoAlbumID'];
            $this->Data['dCreatedDate'] = $Data['CreatedDate'];
            $this->Data['dModifiedDate'] = $Data['ModifiedDate'];
            $this->Data["dViewed"] = $Data["Viewed"];
            $this->Data['dSlider'] = $Data['Slider'];
            $this->Data['dState'] = $Data['State'];
        }
    }

    private function PostValidation() {
        $json = array();
        $e = &$json['Error'];
        $_ = &$this->_;
        $Data = $this->GetPostData();
        $CategoryID = $Data['Category'];
        $State = $Data['State'];

//	//Title & Description & Alias
        $Title = $Data["Title"];
        $Contents = $Data["Contents"];
        $Description = $Data["Description"];
        $Keywords = $Data["Keywords"];

        if (empty($Title)) {
            $e["Title"] = str_format($_['_Error_Required'], $_['_Title']);
        } else if (GetLength($Title) > 200) {
            $e["Title"] = str_format($_['_Error_Max_Length'], $_['_Title'], 100);
        }

        if (empty($Contents)) {
            $e["Contents"] = str_format($_['_Error_Required'], $_['_Contents']);
        }

        if (GetLength($Keywords) > 500) {
            $e["Keywords"] = str_format($_['_Error_Max_Length'], $_['_Keywords'], 500);
        }

        //CategoryID
        if (empty($CategoryID)) {
            $e['Category'] = str_format($_['_Error_Required'], $_['_Category']);
        } elseif (!empty($CategoryID) && !is_numeric($CategoryID)) {
            $e['Category'] = str_format($_['_Error_Incorrect'], $_['_Category']);
        }

        //State
//        if (!is_numeric($State)) {
//            $e['State'] = str_format($_['_Error_Incorrect'], $_['_State']);
//        }

        return ($e) ? $json : null;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Photos">
    public function Photos() {
        if ($this->Authentication()) {
            $this->Data['dResults'] = $this->Model->GetUserPhotos($this->Data['pUser']['ID']);
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
            $this->View->Render();
        }
    }

    public function AddPhoto() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->PhotoValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetData();
                $Data['UserID'] = $this->Data['pUser']['ID'];
                $this->Model->AddPhoto($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/Photos';
                echo json_encode($json);
                return;
            }
            $this->Data['dResults'] = true;
            $this->GetPhotoForm();
        }
    }

    public function EditPhoto($aID) {
        if ($this->Authentication()) {
            $ID = $this->Filter($aID);
            if (Request::IsPost()) {
                $json = $this->PhotoValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetData();
                $Data['ID'] = $ID;
                $Data['UserID'] = $this->Data['pUser']['ID'];
                $this->Model->EditPhoto($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/Photos';
                echo json_encode($json);
                return;
            }
            $Data = $this->Model->GetPhotoByID($ID, $this->Data['pUser']['ID']);
            if ($Data) {
                $this->LoadPhotoData($Data);
                $this->Data['dResults'] = true;
            } else {
                $this->Data['dResults'] = false;
            }
            $this->GetPhotoForm();
        }
    }

    private function GetPhotoForm() {
        $this->View->Render('Profile/PhotoForm');
    }

    public function DeletePhoto() {
        if ($this->Authentication() == true) {
            $ID = isset($_GET['dID']) ? intval($_GET['dID']) : null;
            if ($ID) {
                $this->Model->DeletePhoto($ID, $this->Data['pUser']['ID']);
            }
            Redirect(BASE_URL . $this->Data['pID'] . '/Photos');
        }
    }

    private function LoadPhotoData($Data) {
        if ($Data) {
            $this->Data['dID'] = $Data['ID'];
            $this->Data["dTitle"] = $Data["Title"];
            $this->Data['dPicture'] = $Data['Picture'];
            $this->Data["dViewed"] = $Data["Viewed"];
            $this->Data['dState'] = $Data['State'];
        }
    }

    private function PhotoValidation() {
        $json = array();
        $Data = $this->GetData();
        $Title = $Data["Title"];
        $Picture = $Data['Picture'];
        $State = $Data['State'];
        $e = &$json['Error'];
        $_ = &$this->_;


        if (empty($Title)) {
            $e["Title"] = str_format($_['_Error_Required'], $_['_Title']);
        } else if (GetLength($Title) > 100) {
            $e["Title"] = str_format($_['_Error_Max_Length'], $_['_Title'], 100);
        }

        //Picture
        if (empty($Picture)) {
            $e['Picture'] = str_format($_['_Error_Required'], $_['_Picture']);
        } else if (GetLength($Picture) > 500) {
            $e['Picture'] = str_format($_['_Error_Max_Length'], $_['_Picture'], 500);
        }

        //State
        if (!is_numeric($State)) {
            $e['State'] = str_format($_['_Error_Incorrect'], $_['_State']);
        }

        return ($e) ? $json : null;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Videos">
    public function Videos() {
        if ($this->Authentication()) {
            $this->Data['dResults'] = $this->Model->GetUserVideos($this->Data['pUser']['ID']);
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
            $this->View->Render();
        }
    }

    public function AddVideo() {
        if ($this->Authentication()) {
            if (Request::IsPost()) {
                $json = $this->VideoValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetData();
                $Data['UserID'] = $this->Data['pUser']['ID'];
                $this->Model->AddVideo($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/Videos';
                echo json_encode($json);
                return;
            }
            $this->Data['dResults'] = true;
            $this->GetVideoForm();
        }
    }

    public function EditVideo($aID) {
        if ($this->Authentication()) {
            $ID = $this->Filter($aID);
            if (Request::IsPost()) {
                $json = $this->VideoValidation();
                if ($json) {
                    echo json_encode($json);
                    return;
                }
                $Data = $this->GetData();
                $Data['ID'] = $ID;
                $Data['UserID'] = $this->Data['pUser']['ID'];
                $this->Model->EditVideo($Data);
                $json['Redirect'] = BASE_URL . $this->Data['pID'] . '/Videos';
                echo json_encode($json);
                return;
            }
            $Data = $this->Model->GetVideoByID($ID, $this->Data['pUser']['ID']);
            if ($Data) {
                $this->LoadVideoData($Data);
                $this->Data['dResults'] = true;
            } else {
                $this->Data['dResults'] = false;
            }
            $this->GetVideoForm();
        }
    }

    private function GetVideoForm() {
        $this->View->Render('Profile/VideoForm');
    }

    public function DeleteVideo() {
        if ($this->Authentication() == true) {
            $ID = isset($_GET['dID']) ? intval($_GET['dID']) : null;
            if ($ID) {
                $this->Model->DeleteVideo($ID, $this->Data['pUser']['ID']);
            }
            Redirect(BASE_URL . $this->Data['pID'] . '/Videos');
        }
    }

    private function LoadVideoData($Data) {
        if ($Data) {
            $this->Data['dID'] = $Data['ID'];
            $this->Data['dUrl'] = $Data['Url'];
            $this->Data["dTitle"] = $Data["Title"];
            $this->Data["dDescription"] = $Data["Description"];
            $this->Data["dViewed"] = $Data["Viewed"];
            $this->Data['dState'] = $Data['State'];
        }
    }

    private function VideoValidation() {
        $json = array();
        $Data = $this->GetData();
        $ID = $Data['ID'];
        $Url = $Data['Url'];
        $State = $Data['State'];
        $e = &$json['Error'];
        $_ = &$this->_;

//	//Title & Description & Alias
        $Title = $Data["Title"];
        $Description = $Data["Description"];

        if (empty($Title)) {
            $e["Title"] = str_format($_['_Error_Required'], $_['_Title']);
        } else if (GetLength($Title) > 100) {
            $e["Title"] = str_format($_['_Error_Max_Length'], $_['_Title'], 100);
        }

        if (empty($Description)) {
            $e["Description"] = str_format($_['_Error_Required'], $_['_Description']);
        }

//Url
        if (empty($Url)) {
            $e['Url'] = str_format($_['_Error_Required'], $_['_Video']);
        } else if (GetLength($Url) > 11) {
            $e['Url'] = str_format($_['_Error_Max_Length'], $_['_Video'], 11);
        }

//State
        if (!is_numeric($State)) {
            $e['State'] = str_format($_['_Error_Incorrect'], $_['_State']);
        }

        return ($e) ? $json : null;
    }

// </editor-fold>

    public function All() {
        $this->Data['dResults'] = $this->Model->GetAll();
        $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render('Profile/Users');
    }

    public function Top() {
        $this->Data['dResults'] = $this->Model->GetTop();
        $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render('Profile/Users');
    }

}

?>