<?php

class UserModel extends ModelAdmin {

    /**
     *
     */

    protected $TableName = 'user';

    protected $SearchFields = array(
        't.ID',
        't.UserName',
        't.CreatedDate',
        't.State'
    );

    protected $SortFields = array(
        'ID',
        'UserName',
        'CreatedDate',
        'State'
    );
    protected $Table = " user t ";
    protected $Select = " STRAIGHT_JOIN t.* ";

    protected function GetData($Data) {
        $fData = array(
            new DBField('FullName', $Data['FullName']),
            new DBField('UserName', $Data['UserName']),
            new DBField('Password', Encrypt($Data['Password'])),
            new DBField('Email', $Data['Email']),
            new DBField('CreatedDate', GetDateValue()),
            new DBField('IsActive', $Data['IsActive'], PDO::PARAM_BOOL),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        return $fData;
    }

    public function CheckEmail($Email, $ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, null, '!='),
            new DBField('Email', $Email, PDO::PARAM_INT)
        );
        return $this->db->SelectRow($this->TableName, 'Email', $Where) ? true : false;
    }

    public function CheckUserName($UserName, $ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, null, '!='),
            new DBField('UserName', $UserName, PDO::PARAM_INT)
        );
        return $this->db->SelectRow($this->TableName, 'UserName', $Where) ? true : false;
    }

}