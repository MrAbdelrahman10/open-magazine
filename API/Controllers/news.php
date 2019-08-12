<?php

/**
 * @link http://mrabdelrahman10.com/news
 * Get all news, by category or search in all news
 */
class newsController extends ControllerAPI {

    /**
     *  @param $_GET w word to search
     *  @return array of all news with paginate or if $_GET['w'] is not empty or null return news by search word
     *  @link http://mrabdelrahman10.com/news/index_m
     */
    public function index() {
        $w = urldecode($this->Filter(GetValue($_GET['q'])));
        if ($w) {
            $s = " AND ((p.Title LIKE '%$w%') OR
                (p.Alias LIKE '%$w%') OR
                (p.Contents LIKE '%$w%') OR
                (p.Description LIKE '%$w%') OR
                (p.Keywords LIKE '%$w%')) ";
            $this->JsonParser->data = $this->Model->Search($s);
        } else {
            $this->JsonParser->data = $this->Model->GetAll();
        }
        $this->JsonParser->Response();
    }

    /**
     * @link http://mrabdelrahman10.com/news/i_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/i_m/578
     * @return array one article row by id or return null.
     */
    public function i($ID) {
        $this->JsonParser->data = $this->Model->GetByID(intval($ID));
        $this->JsonParser->Response();
    }

    /**
     * @link http://mrabdelrahman10.com/news/v_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/v_m/578
     * @return add 1 to article Views
     */
    public function v($ID) {
        $d = array();
        if (intval($ID) > 0) {
            $r = $this->Model->UpdateViewed($ID);
            if ($r > 0) {
                $this->JsonParser->data =  true;
            } else {
                $this->JsonParser->success = false;
            }
        }
        $this->JsonParser->Response();
    }

    /**
     * @link http://mrabdelrahman10.com/news/comments_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/comments_m/578
     * @return array article's Comments by article id or return null.
     */
    public function comments($ID) {
        $this->JsonParser->data = $this->Model->GetComments($ID);
        $this->JsonParser->Response();
    }

    /**
     * @link http://mrabdelrahman10.com/news/related_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/related_m/578
     * @return array of related articles by Category id or return null.
     */
    public function related($ID) {
        $this->JsonParser->data = $this->Model->GetRelated($ID);
        $this->JsonParser->Response();
    }

    public function add_comment() {
        if (Request::IsPost()) {
            $json = $this->Validation();
            if ($json) {
                EchoJson($json);
            } else {
                $Data = $this->GetJsonData();
                if (GetValue($this->Data['pUser'])) {
                    $Data['UserID'] = $this->Data['pUser']['ID'];
                }
                $ID = $this->Model->AddComment($Data);
                if ($ID > 0) {
                    EchoExit($this->_['_Comment_Added']);
                } else {
                    EchoError($this->_['_ErrorUnexpected']);
                }
            }
        }
    }

    /**
     * @link http://mrabdelrahman10.com/news/c_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/news/c_m/5
     * @return array of articles by category id or return null.
     */
    public function c($ID) {
        $this->JsonParser->data = $this->Model->GetByCategory($this->Filter(urldecode($ID)));
        $this->JsonParser->Response();
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
                $this->JsonParser->data =  $this->_['_Liked_S'];
            } else {
                $this->JsonParser->success = false;
                $this->JsonParser->data =  $this->_['_Liked_F'];
            }
            $this->JsonParser->Response();
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
                $this->JsonParser->data =  $this->_['_UnLiked_S'];
            } else {
                $this->JsonParser->success = false;
                $this->JsonParser->data =  $this->_['_UnLiked_F'];
            }
            $this->JsonParser->Response();
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

}