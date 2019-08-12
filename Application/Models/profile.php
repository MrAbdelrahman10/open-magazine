<?php

/**
 * Description of Profile
 *
 * @author abduo
 */
class profileModel extends Model {

    protected function BaseSql($param = null) {
        return "Select * From user $param ";
    }

    private function PostBaseSql($param = null) {
        return "SELECT p.*,
                u.UserName,
                u.FullName,
                u.Email,
                c.Name As 'CategoryName'
		FROM    (article p
		INNER JOIN
		category c
		ON (c.ID = p.CategoryID)
		INNER JOIN
		user u
		ON (u.ID = p.UserID))
		$param Order By p.ID DESC";
    }

    public function Add($Data) {
        $Sql = "Insert Into user Set FullName = '" . $Data['FullName'] .
                "', UserName = '" . $Data['UserName'] .
                "', Password = '" . $Data['Password'] .
                "', Picture = '" . GetValue($Data['Picture']) .
                "', Email = '" . $Data['Email'] .
                "', IsActive = '1'
                 , CreatedDate = NOW()" .
                ", State = '1'";
        $this->db->RunQuery($Sql);
    }

    public function Edit($Data) {
        $Sql = "Update user Set FullName = '" . $Data['FullName'] .
                "', UserName = '" . $Data['UserName'] .
                "', Email = '" . $Data['Email'] .
                "', State = '" . $Data['State'] . "'
                    Where UserID = " . $Data['UserID'] .
                " AND   ID = $Data[ID]";
        $this->db->RunQuery($Sql);
    }

    public function ForgotPassword($Data) {
        $Sql = "Update user Set Password = '" . $Data['Password'] . "'
                    Where Email = $Data[Email]";
        $this->db->RunQuery($Sql);
    }

    public function GetByID($ID) {
        $Sql = $this->BaseSql("Where ID = $ID");
        return $this->db->GetRow($Sql);
    }

    public function GetAll() {
        $Sql = "SELECT  u.*, COUNT(p.ID) As 'ItemsCount'
                FROM    user u
                LEFT JOIN
                article p
                ON      p.UserID = u.ID
                GROUP BY
                u.ID
                Order By ItemsCount ";
        $this->db->GetPaging($Sql);
        $Data = $this->db->Paginate();
        return $Data;
    }

    public function GetTop() {
        $Sql = "SELECT  u.*, COUNT(p.ID) As 'ItemsCount'
                FROM    user u
                LEFT JOIN
                article p
                ON      p.UserID = u.ID
                GROUP BY
                u.ID
                Order By ItemsCount
                LIMIT 9";
        return $this->db->GetRows($Sql);
    }

    public function CheckMail($Email) {
        $Sql = $this->BaseSql("Where Email = '$Email' LIMIT 1");
        $Row = $this->db->GetRow($Sql);
        return $Row ? true : false;
    }

    public function GetByUserName($UserName) {
        $Sql = $this->BaseSql("Where UserName = '$UserName' LIMIT 1");
        $Row = $this->db->GetRow($Sql);
        return $Row ? true : false;
    }

    public function CheckUserName($User) {
        $Sql = "Select UserName From user Where UserName = '$User' Limit 1";
        $Row = $this->db->GetRow($Sql);
        return $Row ? $Row['UserName'] : null;
    }

    public function ChangePassword($Data) {
        $Sql = "Update user Set Password = '$Data[Password]'
Where ID = '$Data[ID]'";
        $this->db->RunQuery($Sql);
    }

    public function ChangeEmail($Data) {
        $Sql = "Update user Set Email = '$Data[Email]'
Where ID = '$Data[ID]'";
        $this->db->RunQuery($Sql);
    }

// <editor-fold defaultstate="collapsed" desc="Articles">
    public function GetPostByID($ID, $UserID) {
        $Sql = $this->PostBaseSql(" Where p.ID = '" . $ID . "' AND p.UserID = '$UserID'") . ' LIMIT 1';
        return $this->db->GetRow($Sql);
    }

    public function AddPost($Data) {
        $Sql = "Insert Into article Set UserID = '" . GetValue($Data['UserID'], 1) .
                "', CategoryID = '" . $Data['Category'] .
                "', IsArticle = '" . $Data['IsArticle'] .
                "', IsSended = '" . $Data['IsSended'] .
                "', Title = '" . $Data['Title'] .
                "', sTitle = '" . GetValue($Data['sTitle']) .
                "', Alias = '" . CleanUrl($Data['Title']) .
                "', Contents = '" . $Data['Contents'] .
                "', Description = '" . GetTextFromHTML($Data['Contents']) .
                "', Keywords = '" . GetValue($Data['Keywords']) .
                "', Picture = '" . $Data['Picture'] .
                "', PictureDescription = '" . $Data['Title'] .
                "', CreatedDate = NOW() " .
                " , Approved = 0 " .
                " ,  State = '" . GetValue($Data['State'], 0) . "'";
        $this->db->RunQuery($Sql);
        return $this->db->InsertedID();
    }

    public function EditPost($Data) {
        $Sql = "Update article Set CategoryID = '" . $Data['Category'] .
                "', Title = '" . $Data['Title'] .
                "', sTitle = '" . $Data['sTitle'] .
                "', Alias = '" . $Data['Alias'] .
                "', Contents = '" . $Data['Contents'] .
                "', Description = '" . $Data['Contents'] .
                "', Keywords = '" . $Data['Keywords'] .
                "', Picture = '" . $Data['Picture'] .
                "', PictureDescription = '" . $Data['Title'] .
                "', ModifiedDate = NOW() " .
                ",  State = '" . $Data['State'] . "'
		    Where ID = '" . $Data['ID'] . "'";
        $this->db->RunQuery($Sql);
    }

    public function GetUserPosts($UserID) {
        $Sql = $this->PostBaseSql(" Where p.UserID = '$UserID' AND p.IsSended = 0 ");
        return $this->db->GetRows($Sql);
    }

    public function GetSendedPosts($UserID) {
        $Sql = $this->PostBaseSql(" Where p.UserID = '$UserID' AND p.IsSended = 1 ");
        return $this->db->GetRows($Sql);
    }

    public function DeletePost($ID, $UserID) {
        $Sql = "Delete From article Where ID = '" . $ID . "' AND UserID = '$UserID' LIMIT 1;";
        $this->db->RunQuery($Sql);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Photo">
    public function GetPhotoByID($ID, $UserID) {
        $Sql = $this->PhotoBaseSql(" Where p.ID = '" . $ID . "' AND p.UserID = '$UserID'") . ' LIMIT 1';
        return $this->db->GetRow($Sql);
    }

    public function AddPhoto($Data) {
        $Sql = "Insert Into photo Set UserID = '" . $Data['UserID'] .
                "', Title = '" . $Data['Title'] .
                "', Picture = '" . $Data['Picture'] .
                "', CreatedDate = NOW()" .
                ", State = '" . $Data['State'] . "'";
        $this->db->RunQuery($Sql);
    }

    public function EditPhoto($Data) {
        $Sql = "Update photo Set Title = '" . $Data['Title'] .
                "', CreatedDate = NOW()" .
                ", State = '" . $Data['State'] . "'
		    Where ID = '" . $Data['ID'] . "'";
        $this->db->RunQuery($Sql);
    }

    public function GetUserPhotos($UserID) {
        $Sql = $this->PhotoBaseSql(" Where p.UserID = '$UserID'");
        $this->db->GetPaging($Sql);
        $Data = $this->db->Paginate();
        return $Data;
    }

    public function DeletePhoto($ID, $UserID) {
        $Sql = "Delete From video Where ID = '" . $ID . "' AND UserID = '$UserID' LIMIT 1;";
        $this->db->RunQuery($Sql);
    }

    private function PhotoBaseSql($param = '') {
        return 'SELECT p.*
		FROM    photo p ' . $param;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Video">
    public function GetVideoByID($ID, $UserID) {
        $Sql = $this->VideoBaseSql(" Where p.ID = '" . $ID . "' AND p.UserID = '$UserID'") . ' LIMIT 1';
        return $this->db->GetRow($Sql);
    }

    public function AddVideo($Data) {
        $Sql = "Insert Into video Set UserID = '" . $Data['UserID'] .
                "', Url = '" . $Data['Url'] .
                "', Title = '" . $Data['Title'] .
                "', Description = '" . $Data['Description'] .
                "', CreatedDate = NOW()" .
                ", State = '" . $Data['State'] . "'";
        $this->db->RunQuery($Sql);
    }

    public function EditVideo($Data) {
        $Sql = "Update video Set UserID = '" . $Data['UserID'] .
                "', Url = '" . $Data['Url'] .
                "', Title = '" . $Data['Title'] .
                "', Description = '" . $Data['Description'] .
                "', ModifiedDate = NOW()" .
                ", State = '" . $Data['State'] . "'
		    Where ID = '" . $Data['ID'] . "'
                        And UserID = " . $Data['UserID'];
        $this->db->RunQuery($Sql);
    }

    public function GetUserVideos($UserID) {
        $Sql = $this->VideoBaseSql(" Where p.UserID = '$UserID'");
        $this->db->GetPaging($Sql);
        $Data = $this->db->Paginate();
        return $Data;
    }

    public function DeleteVideo($ID, $UserID) {
        $Sql = "Delete From video Where ID = '" . $ID . "' AND UserID = '$UserID' LIMIT 1;";
        $this->db->RunQuery($Sql);
    }

    private function VideoBaseSql($param = '') {
        return 'SELECT p.*
		FROM    video p ' . $param;
    }

// </editor-fold>
}

?>