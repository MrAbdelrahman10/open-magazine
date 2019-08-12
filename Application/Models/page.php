<?php

class pageModel extends Model {

    public function GetByID($ID) {
        $Sql = "Update page SET Viewed = (Viewed + 1) WHERE ID = '$ID' LIMIT 1";
        $this->db->RunQuery($Sql);
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT),
            new DBField('State', '1', PDO::PARAM_BOOL)
        );
        return $this->db->SelectRow('page', '*', $Where);
    }

}