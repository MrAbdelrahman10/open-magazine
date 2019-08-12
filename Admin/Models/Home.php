<?php

class HomeModel extends ModelAdmin {

    public function GetCountOn($Table) {
        return $this->db->RowsCount($Table.' Where State = 1');
    }

    public function GetCountOff($Table) {
        return $this->db->RowsCount($Table.' Where State = 0');
    }

    public function SignIn($Data) {
        $Auth = $this->Authentication($Data);
        return ($Auth) ? $Auth : null;
    }

}
