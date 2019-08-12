<?php

class galleryModel extends Model {

    protected $Table = " gallery p ";
    protected $Select = " STRAIGHT_JOIN p.* ";

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, 'p.ID DESC', 'p.ID');
    }

    public function GetByID($ID) {
        $Where = array(
            new Field('ID', 'p.ID', $ID, PDO::PARAM_INT)
        );
        $Sql = "Update gallery SET Viewed = (Viewed + 1) WHERE ID = '$ID' LIMIT 1";
        $this->db->RunQuery($Sql);
        return $this->db->SelectRow($this->Table, $this->Select, null, $Where);
    }

}

