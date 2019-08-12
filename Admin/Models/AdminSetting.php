<?php

class AdminSettingModel extends ModelAdmin implements IModelAdmin {

    protected $Table = " adminuser g
		INNER JOIN
		user u
		ON (g.UserID = u.ID) ";
    protected $Select = " STRAIGHT_JOIN g.*, u.* ";

    public function GetAll() {
        $Sql = "select g.*, u.UserName from adminuser g
		INNER JOIN
		user u
		ON (g.UserID = u.ID) ";
        return $this->db->GetRows($Sql);
    }

    public function GetAllUsers() {
        $Sql = "select * From user";
        return $this->db->GetRows($Sql);
    }

    public function GetByID($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, 'u')
        );
        return $this->db->SelectRow($this->Table, $this->Select, $Where);
    }

    public function Add($data) {
        $Sql = "Insert Into user Set FullName = '" . $data['FullName'] .
                "', UserName = '" . $data['UserName'] .
                "', Password = '" . $data['Password'] .
                "', Email = '" . $data['Email'] .
                "', IsActive = '1'
                 , CreatedDate = NOW()" .
                ", State = '1'";
        $this->db->RunQuery($Sql);
        $ID = $this->db->InsertedID();
        $Sql = "insert into adminuser set
                    UserID = '$ID',
                    IsAdmin = '0',
                    IsEditor = '1',
                    Permission = '$data[Permission]',
                    CreatedDate = NOW()";
        $this->db->RunQuery($Sql);
    }

    public function Edit($data) {
        $Sql = "Update user Set FullName = '" . $data['FullName'] .
                (GetValue($data['Password']) ? "', Password = '" . $data['Password'] : '') .
                "', UserName = '" . $data['UserName'] .
                "', Email = '" . $data['Email'] . "'
                    Where ID = $data[ID]";
        $this->db->RunQuery($Sql);
        $Sql = "update adminuser set
                    Permission = '$data[Permission]'
                    where UserID = '$data[ID]' LIMIT 1";
        $this->db->RunQuery($Sql);
    }

    public function Delete($id) {
        $Sql = "delete from adminuser where UserID = '$id' AND IsAdmin = 0 LIMIT 1";
        $this->db->RunQuery($Sql);
        if ($this->db->AffectedRows() > 0) {
            $Sql = "delete from user where ID = '$id' LIMIT 1";
            $this->db->RunQuery($Sql);
        }
    }

    public function SetState($ID, $State) {

    }

    public function GetByEmail($Email, $ID = null) {
        $Sql = 'Select '.$this->BaseSql("Where u.Email = '$Email' " . ($ID ? "AND u.ID != $ID" : '') . " LIMIT 1");
        $Row = $this->db->GetRow($Sql);
        return $Row ? true : false;
    }

    public function GetByUserName($UserName, $ID = null) {
        $Sql = 'Select '.$this->BaseSql("Where u.UserName = '$UserName' " . ($ID ? "AND u.ID != $ID" : '') . " LIMIT 1");
        $Row = $this->db->GetRow($Sql);
        return $Row ? true : false;
    }

}