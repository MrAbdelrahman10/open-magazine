<?php

class comicModel extends Model {

    protected $Table = " comic ";
    protected $Select = " STRAIGHT_JOIN * ";

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, 'ID DESC', 'ID');
    }

    public function GetByID($ID) {
        $Where = array(
            new Field('ID', 'ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->SelectRow($this->Table, $this->Select, null, $Where);
    }

}

