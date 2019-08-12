<?php

class Article_tmpModel extends ModelAdmin implements IModelAdmin {

    /**
     *
     */
    protected $Table = " article_tmp t
                   INNER JOIN
                      category c
                   ON (t.Category= c.ID)
		Left JOIN
		user u
		ON (t.User = u.ID) ";
    protected $Select = " STRAIGHT_JOIN t.*,
                c.Name as 'CategoryName',
                c.Alias as 'CategoryAlias',
                u.UserName ";

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
        $fData = $this->GetData($Data);
        $fData[] = new DBField('CreatedDate', GetDateValue(), PDO::PARAM_STR);
        $table = 'article_tmp';
        $this->db->Insert($fData, $table);
    }

    public function Edit($Data) {
        $fData = $this->GetData($Data);
        $fData[] = new DBField('ModifiedDate', GetDateValue(), PDO::PARAM_STR);
        $Where = array(
            new DBField('ID', $Data['ID'], PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'article_tmp', $Where);
    }

    public function Delete($ID) {
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        return $this->db->Delete('article_tmp', $Where);
    }

    public function SetState($ID, $State) {
        $fData = array(
            new DBField('State', $State, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'article_tmp', $Where);
    }

    public function SetApproved($ID, $Approved) {
        $fData = array(
            new DBField('Approved', $Approved, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, 'article_tmp', $Where);
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

    public function GetLatest() {
        $Where = array(
            new DBField('State', '1', PDO::PARAM_INT, 't')
        );
        return $this->db->Select($this->Table, $this->Select, $Where, 't.ID DESC', null, 20);
    }

    public function GetDevices() {
        return $this->db->Select('device', '*');
    }

}
