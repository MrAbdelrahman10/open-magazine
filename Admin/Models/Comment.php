<?php

class CommentModel extends ModelAdmin implements IModelAdmin {

    /**
     *
     */
    protected $Table = " (comment t
                   INNER JOIN
                      article a
                   ON (a.ID = t.ArticleID))
		LEFT JOIN
		user u
		ON (t.UserID = u.ID) ";
    protected $Select = " STRAIGHT_JOIN t.*,
                a.Title as 'ArticleTitle',
                u.UserName,
                u.Email ";


    private function GetData($Data) {
        $fData = array(
            new DBField('User', $this->pUser['ID'], PDO::PARAM_INT),
            new DBField('Category', $Data['Category'], PDO::PARAM_INT),
            new DBField('Title', $Data['Title'], PDO::PARAM_STR),
            new DBField('Alias', CleanUrl($Data['Alias']), PDO::PARAM_STR),
            new DBField('Contents', $Data['Contents'], PDO::PARAM_STR),
            new DBField('Description', $Data['Description'], PDO::PARAM_STR),
            new DBField('Keywords', $Data['Keywords'], PDO::PARAM_STR),
            new DBField('Picture', $Data['Picture'], PDO::PARAM_STR),
            new DBField('PictureDescription', $Data['PictureDescription'], PDO::PARAM_STR),
            new DBField('SliderPictures', SerializeIfData($Data['SliderPictures']), PDO::PARAM_STR),
            new DBField('Featured', $Data['Featured'], PDO::PARAM_BOOL),
            new DBField('Approved', $Data['Approved'], PDO::PARAM_BOOL),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        return $fData;
    }

    public function Add($Data) {
    }

    public function Edit($Data) {
        $fData = $this->GetData($Data);
        $fData[] = new DBField('ModifiedDate', GetDateValue(), PDO::PARAM_STR);
        $Where = array(
            new DBField('ID', $Data['ID'], PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'comment', $Where);
    }

    public function Delete($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->Delete('comment', $Where);
    }

    public function SetState($ID, $State) {
        $fData = array(
            new DBField('State', $State, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'comment', $Where);
    }

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, $this->GetSearchValues(), 't.ID', $this->GetSortValues());
    }

    public function GetByID($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT, 't')
        );
        return $this->db->SelectRow($this->Table, $this->Select, $Where);
    }

    public function GetCountOn() {
        $Sql = "Select count(ID) As Count From comment Where State = 1";
        $Row = $this->db->GetRow($Sql);
        return $Row ? $Row['Count'] : 0;
    }

    public function GetCountOff() {
        $Sql = "Select count(ID) As Count From comment Where State = 0";
        $Row = $this->db->GetRow($Sql);
        return $Row ? $Row['Count'] : 0;
    }
}

