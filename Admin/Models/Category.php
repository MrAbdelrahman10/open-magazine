<?php

class CategoryModel extends ModelAdmin implements IModelAdmin {

    /*
     *
     */
    protected $Table = " category t
                            LEFT JOIN category cd ON (t.Parent = cd.ID) ";
    protected $Select = " DISTINCT STRAIGHT_JOIN t.*,
                            (Select COUNT(a.ID) From article a Where a.Category = t.ID LIMIT 1) As ItemsCount,
                            (Select p.Name From category p Where t.Parent = p.ID LIMIT 1) As ParentName
        ";

    protected function GetData($Data) {
        $fData = array(
            new DBField('Name', $Data['Name'], PDO::PARAM_STR),
            new DBField('Alias', CleanUrl($Data['Alias']), PDO::PARAM_STR),
            new DBField('Parent', intval($Data['Parent']) > 0 ? intval($Data['Parent']) : null, PDO::PARAM_INT),
            new DBField('Description', $Data['Description'], PDO::PARAM_STR),
            new DBField('Keywords', $Data['Keywords'], PDO::PARAM_STR),
            new DBField('Picture', $Data['Picture'], PDO::PARAM_STR),
            new DBField('HPSO', $Data['HPSO'], PDO::PARAM_BOOL),
            new DBField('SortingOrder', $Data['SortingOrder'], PDO::PARAM_BOOL),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        return $fData;
    }

    public function GetAll() {
        return $this->GetCategories();
    }

    public function GetCategories($Parent = null) {
        $Data = array();
        $Sql = "SELECT $this->Select From $this->Table
	    WHERE t.Parent ";
        $Sql .= ($Parent == null) ? 'is null' : '= ' . $Parent;
        $Sql .= " ORDER BY t.SortingOrder ASC";
        $Rows = $this->db->GetRows($Sql);
        foreach ($Rows as $Row) {
            $Row['IsParent'] = $this->CategoryIsParent($Row['ID']);
            $Row['TopLevel'] = ($Row['Parent'] ? false : true);
            $Data[] = $Row;
            $Data = array_merge($Data, $this->GetCategories($Row['ID']));
        }
        return $Data;
    }

}
