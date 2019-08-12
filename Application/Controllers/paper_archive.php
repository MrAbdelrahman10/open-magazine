<?php
/**
 * Videos Library From Youtube
 * element [Url] in one row is id of the video on Youtube
 */
class paper_archiveController extends Controller {
    /**
     *  @return array of all videos with paginate or return null.
     *  @link http://mrabdelrahman10.com/video/index
     *  @example http://mrabdelrahman10.com/video/index
     */
    public function index() {
        $this->Data['dTitle'] = $this->_['_Paper_Archive'];
        $this->View->Data['dResults'] = $this->Model->GetAll();
        $this->View->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render();
    }
/**
     *  @return array of all videos with paginate or return null.
     *  @link http://mrabdelrahman10.com/video/index_m
     *  @example http://mrabdelrahman10.com/video/index_m
     */
    public function index_m() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    public function i($ID) {
        $Item = $this->Model->GetByID($ID);
        if ($Item) {
            $this->Data['dResults'] = $Item;
            $this->Data['dTitle'] = $Item['Title'];
        } else {
            $this->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->RenderOnly(null, false);
    }

    /**
     * @link http://mrabdelrahman10.com/video/i_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/video/i_m/108
     * @return array one video row by id or return null.
     */
    public function i_m($ID) {
        $d = $this->Model->GetByID($this->Filter(urldecode($ID)));
        EchoJson($d);
    }

}