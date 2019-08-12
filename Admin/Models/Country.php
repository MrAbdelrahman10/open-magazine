<?php
class CountryModel extends ModelAdmin implements IModelAdmin {
    public function Add($Data) {
        $Sql = "Insert Into country Set
                    CountryName = '$Data[CountryName]',
                    SortingOrder = '$Data[SortingOrder]',
                    State = '$Data[State]'";
        $this->db->RunQuery($Sql);
    }

    public function Delete($ID) {
        $Sql = "Delete From country Where ID = $ID LIMIT 1";
        $this->db->RunQuery($Sql);
    }

    public function Edit($Data) {
        $Sql = "Update country Set
                    CountryName = '$Data[CountryName]',
                    SortingOrder = '$Data[SortingOrder]',
                    State = '$Data[State]'
                Where ID = $Data[ID] LIMIT 1";
        $this->db->RunQuery($Sql);
    }

    public function GetAll() {
        $Sql = "Select * From country";
        return $this->db->GetRows($Sql);
    }

    public function GetByID($ID) {
        $Sql = "Select * From country Where ID = $ID LIMIT 1";
        return $this->db->GetRow($Sql);
    }

    public function SetState($ID, $State) {
        $Sql = "Update country Set State = $State Where ID = $ID LIMIT 1";
        $this->db->RunQuery($Sql);
    }    //put your code here
}

?>
