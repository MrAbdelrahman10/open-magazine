<?php

/**
 * Description of Article
 *
 * @author MrAbdelrahman10
 */
class newsModel extends Model {

    protected $Table = " article t
                   INNER JOIN
                      category c
                   ON (t.Category = c.ID) ";
    protected $Select = " STRAIGHT_JOIN t.*,
                c.Name as 'CategoryName',
                c.Picture as 'CategoryPicture',
                c.Alias as 'CategoryAlias',
                (Select COUNT(cm.ID) FROM comment cm where cm.ArticleID = t.ID LIMIT 1) AS CommentsCount
                ";

    protected function BaseSql($param = null) {
        return $this->SelectArticle . ' From ' . $this->TableArticle . " $param";
    }

    public function GetByID($ID) {
        if (intval($ID) > 0) {
            $this->UpdateViewed($ID);
            $Where = array(
                new DBField('ID', $ID, PDO::PARAM_INT, 'p'),
                new DBField('State', '1', PDO::PARAM_INT, 'p')
            );
            return $this->db->SelectRow($this->TableArticle, $this->SelectArticle, $Where);
        }
        $Where = array(
            new DBField('State', '1', PDO::PARAM_INT, 'p')
        );
        $Data = $this->db->SelectRow($this->TableArticle, $this->SelectArticle, $Where, 'RAND()');
        $this->UpdateViewed($Data['ID']);
        return $Data;
    }

    public function UpdateViewed($ID) {
        $Sql = "Update article SET Viewed = (Viewed + 1) WHERE ID = '$ID' LIMIT 1";
        $this->db->RunQuery($Sql);
        return $this->db->AffectedRows();
    }

    public function GetByCategory($ID) {
        $Where = array(
            new DBField('Category', $ID, PDO::PARAM_INT, 'p'),
            new DBField('State', '1', PDO::PARAM_BOOL, 'p')
        );
        return $this->db->Paginate($this->TableArticle, $this->SelectArticle, $Where, 'p.ID', 'p.ID DESC');
    }

    public function GetAll() {
        return $this->db->Paginate($this->Table, $this->Select, $this->GetSearchValues(), 't.ID', $this->GetSortValues());
    }

    public function GetByCategoryLimit($ID) {
        $Sql = $this->BaseSql("Where t.CategoryID = $ID AND State = 1 ORDER BY t.ID DESC LIMIT 2");
        return $this->db->GetRows($Sql);
    }

    public function GetByParentCategory($ID) {
        $Sql = $this->BaseSql("Where c.ParentID = $ID AND State = 1");
        $this->db->GetPaging($Sql);
        return $this->db->Paginate();
    }

    public function GetByChildCategories($ID) {
        $Sql = "Select * From category Where State = 1 AND ParentID = $ID";
        return $this->db->GetRows($Sql);
    }

    public function GetRelated($ID) {
        $Sql = "Select * From article Where Category = " . intval($ID) . " Order By Rand() LIMIT 3";
        return $this->db->GetRows($Sql);
    }

    public function Search() {
        return $this->db->Paginate($this->Table . ' Where t.State = 1 ' . $s, $this->SelectArticle, 't.ID DESC', 't.ID');
    }

    public function AddComment($Data) {
        $Sql = "Insert Into comment Set ArticleID = '$Data[ArticleID]', " .
                (GetValue($Data['UserID']) ? "UserID = '$Data[UserID]'," :
                        "VisitorName = '$Data[VisitorName]',"
                        . "vEmail = '$Data[vEmail]',")
                . " Title = '$Data[cTitle]',
                Contents = '$Data[cContents]',
                CreatedDate = NOW(), State = 0";
        $this->db->RunQuery($Sql);
        return $this->db->InsertedID();
    }

    public function Like($id) {
        $Sql = "Update article SET Liked = (Liked + 1)
		WHERE ID = '$id' LIMIT 1";
        $this->db->RunQuery($Sql);
        return $this->db->AffectedRows();
    }

    public function UnLike($id) {
        $Sql = "Update article SET UnLiked = (UnLiked + 1)
		WHERE ID = '$id' LIMIT 1";
        $this->db->RunQuery($Sql);
        return $this->db->AffectedRows();
    }

    public function GetComments($ID) {
        $Sql = "Select c.*, u.UserName, u.Picture From comment c
		LEFT JOIN
		user u
		ON (c.UserID = u.ID)
                Where c.ArticleID = '$ID' And c.State = 1";
        return $this->db->GetRows($Sql);
    }

    public function Schedule() {
        $Sql = "Select * From article_tmp Where CreatedDate <= NOW()";
        $tmp = $this->db->GetRows($Sql);
        foreach ($tmp as $Data) {
            $fData = array(
                new DBField('User', $Data['User'], PDO::PARAM_INT),
                new DBField('Category', $Data['Category'], PDO::PARAM_INT),
                new DBField('Title', $Data['Title'], PDO::PARAM_STR),
                new DBField('Alias', $Data['Alias'], PDO::PARAM_STR),
                new DBField('Contents', $Data['Contents'], PDO::PARAM_STR),
                new DBField('Description', $Data['Description'], PDO::PARAM_STR),
                new DBField('Keywords', $Data['Keywords'], PDO::PARAM_STR),
                new DBField('Picture', $Data['Picture'], PDO::PARAM_STR),
                new DBField('PictureDescription', $Data['PictureDescription'], PDO::PARAM_STR),
                new DBField('SliderPictures', $Data['SliderPictures'], PDO::PARAM_STR),
                new DBField('Featured', $Data['Featured'], PDO::PARAM_BOOL),
                new DBField('Approved', $Data['Approved'], PDO::PARAM_BOOL),
                new DBField('CreatedDate', $Data['CreatedDate'], PDO::PARAM_STR),
                new DBField('ModifiedDate', $Data['ModifiedDate'], PDO::PARAM_STR),
                new DBField('State', $Data['State'], PDO::PARAM_BOOL)
            );
            $this->db->Insert($fData, 'article');

            $Where = array(
                new DBField('ID', $Data['ID'], PDO::PARAM_INT)
            );
            $this->db->Delete('article_tmp', $Where);
        }
    }

    public function GetLatest() {
        $Where = array(
            new DBField('State', '1', PDO::PARAM_INT, 't')
        );
        return $this->db->Select($this->Table, $this->Select, $Where, 't.ID DESC', null, 20);
    }

}
