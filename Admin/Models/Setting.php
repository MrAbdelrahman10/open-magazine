<?php

class SettingModel extends ModelAdmin {

    /**
     * 
     */
    private $BaseSql = '';

    public function GetAll(){
        $Sql = "Select * From setting";
        $_Data = $this->db->GetRows($Sql);
        $Data = array();
        foreach ($_Data as $Item) {
            $Data[$Item['Name']] = $Item['Value'];
        }
        return $Data;
    }

        public function Update($Name, $Value) {
        $Sql = "Update setting Set Value = '$Value' Where Name = '$Name' LIMIT 1";
        $this->db->RunQuery($Sql);
    }

}

