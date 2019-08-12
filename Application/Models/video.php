<?php

class videoModel extends Model {

    protected $Table = " video ";
    protected $Select = " STRAIGHT_JOIN * ";

    public function GetAll() {
        return $this->db->Paginate($this->Table . ' Where State = 1', $this->Select, null, 'ID', 'ID DESC');
    }

    public function GetRelated() {
        $Sql = "Select * From video Where State = 1 Order By Rand() LIMIT 3";
        return $this->db->GetRows($Sql);
    }

    public function GetByID($ID) {
        if (intval($ID) > 0) {
            $Where = array(
                new DBField('ID', $ID, PDO::PARAM_INT)
            );
            $this->UpdateViewed($ID);
            return $this->db->SelectRow($this->Table, $this->Select, $Where);
        }
    }

    public function UpdateViewed($ID) {
        $Sql = "Update video SET Viewed = (Viewed + 1) WHERE ID = '$ID' LIMIT 1";
        $this->db->RunQuery($Sql);
        return $this->db->AffectedRows();
    }

}
