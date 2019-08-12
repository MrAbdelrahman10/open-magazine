<?php

/**
 * @link http://mrabdelrahman10.com/news
 * Get all news, by category or search in all news
 */
class newsController extends Controller {

    /**
     *  @param $_GET w word to search
     *  @return array of all news with paginate
     *  @link http://mrabdelrahman10.com/news/index
     */
    public function index() {
        $d = $this->Data;
        $w = urldecode($this->Filter(GetValue($_GET['q'])));
        if ($w) {
            $d['dTitle'] = $this->_['_SearchResult'];
            $d['dResults'] = $this->Model->GetAll();
        } else {
            $d['dTitle'] = $this->_['_Search'];
            $d['dResults'] = $this->Model->GetAll();
        }
        if (Request::IsAPI()) {
            $this->JsonParser->data = $d['dResults'];
            $this->JsonParser->Response();
        }
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render();
    }

    public function schedule() {
        $this->Model->Schedule();
        $this->UpdateRss();
        Cache::Delete();
    }

    public function UpdateRss() {
        if (Request::IsPost()) {
            $rss = new RSSWriter();
            $Data = $this->Model->GetLatest();
            $rss->Title = $this->Settings['sSite_Name'];
            $rss->Items = $Data;
            $rss->Create();
            Cache::Delete();
        }
    }

    /**
     * @link http://mrabdelrahman10.com/news/i/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/i/578
     * @return array one article row.
     */
    public function i($iID = null) {
        $ID = intval($iID);
        $Item = $this->Model->GetByID($ID);
        if (Request::IsAPI()) {
            $this->JsonParser->data = $Item;
            $this->JsonParser->Response();
        }
        if ($Item) {
            $this->Data['dResults'] = $Item;
            $this->Data['dComments'] = $this->Model->GetComments($ID);
            $this->Data['dCommentsCount'] = count($this->Data['dComments']);
            $this->Data['dRelated'] = $this->Model->GetRelated($Item['Category']);
            $this->Data['pImage'] = SITE_URL . $Item['Picture'];
            $this->Data['dTitle'] = $Item['Title'];
            $this->Data['dDescription'] = $Item['Description'];
            $this->Data['dKeywords'] = $Item['Keywords'];
            $this->Data['dTags'] = explode(',', $Item['Keywords']);
        } else {
            $this->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->Render();
    }

    /**
     * @link http://mrabdelrahman10.com/news/v_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/v_m/578
     * @return add 1 to article Views
     */
    public function v_m($ID) {
        $d = array();
        if (intval($ID) > 0) {
            $r = $this->Model->UpdateViewed($ID);
            if ($r > 0) {
                $d['Result'] = true;
            } else {
                $d['Result'] = false;
            }
        }
        EchoJson($d);
    }

    public function add_comment() {
        if (Request::IsPost()) {
            $json = $this->Validation();
            if ($json) {
                echo json_encode($json);
                return;
            } else {
                $Data = $this->GetData();
                if (GetValue($this->Data['pUser'])) {
                    $Data['UserID'] = $this->Data['pUser']['ID'];
                }
                $ID = $this->Model->AddComment($Data);
                if ($ID > 0) {
                    $json['Result'] = true; //$this->_['_Comment_Added'];
                } else {
                    $json['Result'] = false; //$this->_['_ErrorUnexpected'];
                }
                EchoJson($json);
            }
        }
    }

    /**
     * @link http://mrabdelrahman10.com/news/c/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/c/5
     * @return array of articles by category id or return null.
     */
    public function c($ID) {
        $Article = $this->Model->GetByCategory($this->Filter(urldecode($ID)));
        if (count($Article) > 0) {
            $this->Data['dResults'] = $Article;
            $this->Data['dTitle'] = $Article[0]['CategoryName'];
            $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        } else {
            $this->Data['dTitle'] = $this->_['_NoResults'];
            $this->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->Render('news/index');
    }

    public function tc($ID) {
        $Data = array();
        $Cats = $this->Model->GetByChildCategories($this->Filter(urldecode($ID)));
        foreach ($Cats as $c) {
            $Ps = $this->Model->GetByCategoryLimit($c['ID']);
            if ($Ps) {
                $Data[] = array(
                    'Cat' => $c,
                    'Posts' => $Ps
                );
            }
        }
        $this->Data['dResults'] = $Data;
//            $this->Data['dTitle'] = $Article[0]['CategoryName'];
        $this->View->Render();
    }

    /**
     *
     * @return type
     */
    public function like() {
        if (Request::IsPost()) {
            $id = $this->Filter($_POST['aID']);
            $result = $this->Model->Like($id);
            $d = array();
            if ($result > 0) {
                $d['Result'] = $this->_['_Liked_S'];
            } else {
                $d['Result'] = $this->_['_Liked_F'];
            }
            EchoJson($d);
        }
    }

    /*
     *
     */

    public function unlike() {
        if (Request::IsPost()) {
            $id = $this->Filter($_POST['aID']);
            $result = $this->Model->UnLike($id);
            $d = array();
            if ($result > 0) {
                $d['Result'] = $this->_['_UnLiked_S'];
            } else {
                $d['Result'] = $this->_['_UnLiked_F'];
            }
            EchoJson($d);
        }
    }

    protected function GetData() {
        $Data = $this->FilterPost();
        $Data['UserID'] = $this->Data['pUser']['ID'];
        $Data['State'] = $Data['UserID'] ? 1 : 0;
        return $Data;
    }

    private function Validation() {
        $json = array();
        $Data = $this->GetData();
        $Title = $Data['cTitle'];
        $Contents = $Data['cContents'];
        $e = &$json['Error'];
        $_ = &$this->_;

//Title
        if (empty($Title)) {
            $e['cTitle'] = str_format($_['_Error_Required'], $_['_Title']);
        } else if (GetLength($Title) > 100) {
            $e['cTitle'] = str_format($_['_Error_Max_Length'], $_['_Title'], 100);
        }

//Contents
        if (empty($Contents)) {
            $e['cContents'] = str_format($_['_Error_Required'], $_['_Comment']);
        } else if (GetLength($Contents) > 300) {
            $e['cContents'] = str_format($_['_Error_Max_Length'], $_['_Comment'], 300);
        }

        return ($e) ? $json : null;
    }

    public function Preview($ID) {
        Session::Init();
        $Items = Session::Get('Preview');
        $Item = $Items[$ID];
        if ($Item) {
            $this->Data['dResults'] = $Item;
            $this->Data['dTitle'] = $Item['Title'];
            $this->Data['pImage'] = SITE_URL . $Item['Picture'];
            $this->Data['dRelated'] = $this->Model->GetRelated($Item['Category']);
        }
        $this->View->Render('news/i');
    }

}
