<?php

class PollModel extends ModelAdmin implements IModelAdmin {

    /**
     *
     */
    protected $Table = " poll t ";
    protected $Select = " STRAIGHT_JOIN t.* ";

    public function Add($Data) {
        $fData = array(
            new DBField('Q', $Data['Q'], PDO::PARAM_STR),
            new DBField('CreatedDate', GetDateValue(), PDO::PARAM_STR),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        $ID = $this->db->Insert($fData, 'poll');
        $ans = count($Data['A']);
        for ($i = 0; $i < $ans; $i++) {
            if ($Data['A'][$i]) {
                $fData = array(
                    new DBField('QID', $ID, PDO::PARAM_INT),
                    new DBField('A', $Data['A'][$i], PDO::PARAM_STR)
                );
                $this->db->Insert($fData, 'poll_answer');
            }
        }
    }

    public function Edit($Data) {
        $fData = array(
            new DBField('Q', $Data['Q'], PDO::PARAM_STR),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $Data['ID'], PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'poll', $Where);
        $Ans = $Data['A'];
        foreach ($Ans as $k => $v) {
            $fData = array(
                new DBField('A', $v, PDO::PARAM_STR),
            );
            $Where = array(
                new DBField('ID', $k, PDO::PARAM_INT)
            );
            $this->db->Update($fData, 'poll_answer', $Where);
        }
    }

    public function Delete($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->Delete('comic', $Where);
    }

    public function SetState($ID, $State) {
        $fData = array(
            new DBField('State', $State, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'comic', $Where);
    }

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, $this->GetSearchValues(), 't.ID', $this->GetSortValues());
    }

    public function GetByID($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, 't')
        );
        $Data = $this->db->SelectRow($this->Table, $this->Select, $Where);
        if ($Data) {
            $Where = array(
                new DBField('QID', $Data['ID'], PDO::PARAM_INT)
            );
            $Data['Answers'] = $this->db->Select('poll_answer', '*', $Where);
        }
        return $Data;
    }

}
