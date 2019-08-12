<?php

abstract class Model {

    public $db;
    protected $Select = '';
    protected $Table = '';
    protected $TableArticle = " article p
                   INNER JOIN
                      category c
                   ON (p.Category = c.ID)
		LEFT JOIN
		user u
		ON (p.User = u.ID) ";
    protected $SelectArticle = " STRAIGHT_JOIN p.*,
                c.Name as 'CategoryName',
                c.Alias as 'CategoryAlias',
                u.UserName,
                (Select COUNT(cm.ID) FROM comment cm where cm.ArticleID = p.ID LIMIT 1) AS CommentsCount "; //,                Count(cm.ID) as 'CommentsCount'

    protected function BaseSql($param = null) {
        return $this->Select . ' From ' . $this->Table . " $param";
    }

    protected function SetLevel($Level = 0, $Str = ' . ') {
        return str_repeat($Str, $Level);
    }

    public function GenerateWord($Len) {
        require_once APP_LIB . 'Generator.php';
        $Gen = new Generator();
        return $Gen->RandomID($Len);
    }

    public function Authentication($Data) {
        $Sql = "select * from user where UserName = '" . $Data['UserName'] .
                "' AND Password = '" . $Data['Password'] . "' LIMIT 1";
        $Row = $this->db->GetRow($Sql);
        if ($Row) {
            return $Row;
        }
        return null;
    }

    protected $SortFields = array();

    protected function GetSortValues($Sort = 'ID DESC') {
        if (isset($_GET['sort'])) {
            if (is_array($_GET['sort'])) {
                $Sort = '';
                foreach ($_GET['sort'] as $k => $v) {
                    if (in_array($k, $this->SortFields) && in_array(strtoupper($v), array('ASC', 'DESC'))) {
                        $Sort .= "$k $v,";
                    }
                }
            }
        }
        return trim($Sort, ',');
    }

    protected $SearchFields = array();

    protected function GetSearchValues($Where = array()) {
        if (isset($_GET['search'])) {
            if (is_array($_GET['search'])) {
                foreach ($_GET['search'] as $k => $v) {
                    if ($v && in_array($k, $this->SearchFields)) {
                        $it = explode('.', $k);
                        $i = isset($it[1]) ? $it[1] : $it[0];
                        $t = isset($it[1]) ? $it[0] : null;
                        $Where[] = new DBField($i, $v, PDO::PARAM_STR, $t);
                    }
                }
            }
        }
        return $Where;
    }

    public function GetCategories($Parent = null) {
        $Data = array();
        $Sql = "SELECT DISTINCT c.*
	    FROM category c
	    LEFT JOIN category cd ON (c.Parent = cd.ID)
	    WHERE c.State = 1 AND c.Parent ";
        $Sql .= ($Parent == null) ? 'is null' : '= ' . $Parent;
        $Sql .= " ORDER BY c.SortingOrder ASC";
        $Rows = $this->db->GetRows($Sql);
        foreach ($Rows as $Row) {
            $Row['IsParent'] = $this->CategoryIsParent($Row['ID']);
            $Row['TopLevel'] = ($Row['Parent'] ? false : true);
            $Data[] = $Row;
            $Data = array_merge($Data, $this->GetCategories($Row['ID']));
        }
        return $Data;
    }

    protected function CategoryIsParent($ID) {
        $Sql = "Select ID From category Where Parent = $ID Limit 1";
        return ($this->db->GetRow($Sql)) ? true : false;
    }

    public function GetGategoryByID($ID) {
        $Sql = "Select * From category Where State = 1 AND ID = $ID";
        return $this->db->GetRow($Sql);
    }

    public function GetFooterCategories() {
        $Sql = "Select * From category Where State = 1 Order By SortingOrder ASC";
        return $this->db->GetRows($Sql);
    }

    public function GetHomeCategory() {
        $Sql = 'Select * From category Where State = 1 And HPSO > 0 Order By HPSO ASC';
        return $this->db->GetRows($Sql);
    }

    public function GetArticleByCategory($ID, $Limit = 8) {
        return $this->db->GetRows("SELECT " . $this->SelectArticle . "
                From " .
                        $this->TableArticle .
                        " Where (c.Parent = '$ID'
                OR p.Category = '$ID') Order By p.ID DESC LIMIT $Limit");
    }

    public function GetMostViewedArticles() {
        return $this->db->GetRows("SELECT $this->SelectArticle From $this->TableArticle Where p.State = 1 Order By p.Viewed DESC LIMIT 8");
    }

    public function GetMostCommentedArticles() {
        return $this->db->GetRows("SELECT *, (Select COUNT(c.ID) FROM comment c where c.ArticleID = ID LIMIT 1) AS CommentsCount From article Where State = 1 Order By ID DESC LIMIT 4");
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
            $Row['MobileLink'] = $this->GetMobileLink($Row['Link']);
            $Row['IsParent'] = $this->MenuIsParent($Row['ID']);
            $Row['TopLevel'] = ($Row['Parent'] ? false : true);
            $Data[] = $Row;
            $Data = array_merge($Data, $this->GetMenus($Row['ID']));
        }
        return $Data;
    }

    private function GetMobileLink($Link) {
        $arr = array(
            "home",
            "news/i/",
            "news/c/",
            "page/i/",
            "gallery",
            "video",
        );
        if (strpos($Link, '/i/') > 0) {
            return str_replace('/i/', '/i_m/', $Link);
        } elseif (strpos($Link, '/c/') > 0) {
            return str_replace('/c/', '/c_m/', $Link);
        } elseif ($Link == 'home') {
            return 'home/index_m';
        } elseif ($Link == 'gallery') {
            return 'gallery/index_m';
        } elseif ($Link == 'video') {
            return 'video/index_m';
        }
        return $Link;
    }

    protected function MenuIsParent($ID) {
        $Sql = "Select ID From menu Where Parent = $ID Limit 1";
        return ($this->db->GetRow($Sql)) ? true : false;
    }

    public function GetAllPages() {
        $Sql = "SELECT *
		FROM    (page)
		Where State = 1 Order By SortingOrder ";
        return $this->db->GetRows($Sql);
    }

    public function GetLastArticles() {
        $Sql = "SELECT p.*,
                c.Name as 'CategoryName',
                c.Alias as 'CategoryAlias',
                u.UserName
		FROM    article p
                   INNER JOIN
                      category c
                   ON (p.Category = c.ID)
		INNER JOIN
		user u
		ON (p.User = u.ID)
            Where p.State = 1 Order By p.ID DESC LIMIT 15";
        return $this->db->GetRows($Sql);
    }

    public function GetTicker() {
        return $this->db->GetRows("Select STRAIGHT_JOIN ID, Title From article Where State = 1 Order By ID DESC LIMIT 10");
    }

    public function GetAnswers($id) {
        return $this->db->GetRows("Select * from poll_answer Where QID = $id");
    }

    public function GetLastPoll() {
        $row = $this->db->GetRow("SELECT  p.*
                    FROM    poll p
                    Where p.State = 1 Order By p.ID DESC
                    LIMIT 1
                    ");
        if ($row) {
            $row['Ans'] = $this->GetAnswers($row['ID']);
            return $row;
        }
        return null;
    }

    public function UpdatePoll($Data) {
        $Sql = "Update poll_answer SET Value = (Value + 1) WHERE ID = '$Data[ID]' LIMIT 1";
        $this->db->RunQuery($Sql);
    }

    public function GetLastVideos() {
        $Sql = 'Select * From video Where State = 1 Order By ID DESC LIMIT 6';
        return $this->db->GetRows($Sql);
    }

    public function GetLastComic() {
        $Sql = 'Select * From comic Where State = 1 Order By ID DESC LIMIT 1';
        return $this->db->GetRow($Sql);
    }

    public function GetLastGallery() {
        $Sql = "SELECT * From gallery
                Where State = 1
                Order By ID DESC
                LIMIT 1";
        return $this->db->GetRow($Sql);
    }

    public function GetBanners($pos) {
        $Sql = "SELECT *
                From banner
                Where BannerPosition = '$pos' AND State = 1";
        return $this->db->GetRows($Sql);
    }

}
