<?php

class MenuModel extends ModelAdmin implements IModelAdmin {

    /**
     *
     */
    protected $Table = " menu t ";
    protected $Select = " STRAIGHT_JOIN t.* ";

    private function GetData($Data) {
        $Level = $this->GetParentLevel($Data['Parent']);
        $fData = array(
            new DBField('Title', $Data['Title'], PDO::PARAM_STR),
            new DBField('MenuItemType', $Data['MenuItemType'], PDO::PARAM_INT),
            new DBField('Level', $Level, PDO::PARAM_STR),
            new DBField('Link', $Data['Link'], PDO::PARAM_STR),
            new DBField('SortingOrder', $Data['SortingOrder'], PDO::PARAM_BOOL),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        if ($Data['Parent']) {
            $fData[] = new DBField('Parent', $Data['Parent'], PDO::PARAM_INT);
        }
        return $fData;
    }

    public function Add($Data) {
        $fData = $this->GetData($Data);
        $this->db->Insert($fData, 'menu');
    }

    public function Edit($Data) {
        $fData = $this->GetData($Data);
        $Where = array(
            new DBField('ID', $Data['ID'], PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'menu', $Where);
    }

    public function Delete($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->Delete('menu', $Where);
    }

    public function SetState($ID, $State) {
        $fData = array(
            new DBField('State', $State, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'menu', $Where);
    }

    public function GetAll() {
        return $this->GetMenus();
    }

    public function GetMenus($Parent = null) {
        $Data = array();
        $Sql = "SELECT DISTINCT m.*
	    FROM menu m
	    LEFT JOIN menu md ON (m.ID = md.ID)
	    WHERE m.State = 1 AND m.Parent ";
        $Sql .= (($Parent == null) ? 'is null' : "= '$Parent'");
        $Sql .= " ORDER BY m.SortingOrder ASC";
        $Rows = $this->db->GetRows($Sql);
        foreach ($Rows as $Row) {
            $Row['IsParent'] = $this->MenuIsParent($Row['ID']);
            $Row['TopLevel'] = ($Row['Parent'] ? false : true);
            $Data[] = $Row;
            $Data = array_merge($Data, $this->GetMenus($Row['ID']));
        }
        return $Data;
    }

    public function GetByID($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, 't')
        );
        return $this->db->SelectRow($this->Table, $this->Select, $Where);
    }

    private function GetParentLevel($ParentID) {
        if ($ParentID) {
            $Sql = "Select Level From menu Where ID = '" . $ParentID . "' LIMIT 1";
            $Row = $this->db->GetRow($Sql);
            if ($Row) {
                return $Row['Level'];
            }
        }
        return '0';
    }

    public function SetSort($ID, $Sort) {
        $fData = array(
            new DBField('SortingOrder', $Sort, PDO::PARAM_INT)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'menu', $Where);
    }

}
