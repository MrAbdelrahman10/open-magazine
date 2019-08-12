<?php

/**
 *
 */
interface IModelAdmin {

}

abstract class ModelAdmin extends Model {


    public function Authentication($Data) {
        $Select = " u.*, a.IsAdmin, a.IsEditor, a.Permission ";
        $Table = " user u
		INNER JOIN
		adminuser a ON a.UserID = u.ID ";

        $Where = array(
            new DBField('UserName', $Data['AdminUserName']),
            new DBField('Password', $Data['AdminPassword'])
        );
        $Row = $this->db->SelectRow($Table, $Select, $Where);
        return ($Row) ? $Row : null;
    }

    protected function BaseSql($param = null){
        return $this->Select .' From '. $this->Table . " $param";
    }

    public function Add($Data) {
        $fData = $this->GetData($Data);
        $fData[] = new DBField('CreatedDate', GetDateValue(), PDO::PARAM_STR);
        $this->db->Insert($fData, $this->TableName);
    }

    public function Edit($Data) {
        $fData = $this->GetData($Data);
        $fData[] = new DBField('ModifiedDate', GetDateValue(), PDO::PARAM_STR);
        $Where = array(
            new DBField('ID', $Data['ID'], PDO::PARAM_INT)
        );
        $this->db->Update($fData, $this->TableName, $Where);
    }

    public function Delete($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->Delete($this->TableName, $Where);
    }

    public function SetState($ID, $State) {
        $fData = array(
            new DBField('ModifiedDate', GetDateValue(), PDO::PARAM_STR),
            new DBField('State', $State, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, $this->TableName, $Where);
    }

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, $this->GetSearchValues(), 't.ID', $this->GetSortValues());
    }

    public function GetByID($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, 't')
        );
        return $this->db->SelectRow($this->Table, $this->Select, $Where);
    }

    public function Add_To_History($action) {
        $uID = $this->pUser['ID'];
        $Sql = "
            Insert Into admin_history Set
            UserID = '$uID',
            Action = '$action',
            CreatedDate = NOW()
            ";
        $this->db->RunQuery($Sql);
    }

}