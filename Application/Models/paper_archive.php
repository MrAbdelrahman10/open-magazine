<?php

class paper_archiveModel extends Model {


    protected $Table = " paper_archive v ";
    protected $Select = " STRAIGHT_JOIN v.* ";

    public function GetAll() {
        return $this->db->Paginate($this->Table . ' Where v.State = 1', $this->Select, 'v.ID DESC', 'v.ID');
    }

    public function GetByID($ID) {
        $Where = array(
            new Field('ID', 'v.ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->SelectRow($this->Table, $this->Select, null, $Where);
    }

}