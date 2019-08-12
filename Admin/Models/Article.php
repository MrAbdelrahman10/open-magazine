<?php

class ArticleModel extends ModelAdmin implements IModelAdmin {


    protected $TableName = 'article';

    protected $SearchFields = array(
        't.ID',
        't.Title',
        'UserName',
        't.CategoryID',
        't.Viewed',
        't.CreatedDate',
        't.State'
    );

    protected $SortFields = array(
        'ID',
        'Title',
        'UserName',
        'CategoryName',
        'Viewed',
        'CreatedDate',
        'State'
    );
    protected $Table = " article t
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

    protected function GetData($Data) {
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

    public function SetApproved($ID, $Approved) {
        $fData = array(
            new DBField('Approved', $Approved, PDO::PARAM_BOOL)
        );
        $Where = array(
            new DBField('ID', $ID, PDO::PARAM_INT)
        );
        $this->db->Update($fData, $this->TableName, $Where);
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