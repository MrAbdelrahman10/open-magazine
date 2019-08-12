<?php

/**
 * Galleries
 */
class galleryController extends Controller {

    public function index() {
        $this->Data['dTitle'] = $this->_['_Gallery'];
        $this->Data['dResults'] = $this->Model->GetAll();
        $this->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render();
    }

    /**
     *  @return array of all albums with paginate or return null.
     *  @link http://mrabdelrahman10.com/gallery/index_m
     *  @example http://mrabdelrahman10.com/gallery/index_m
     */
    public function index_m() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    /**
     *
     * @param type $aID
     */
    public function i($aID) {
        $ID = intval($aID);
        if ($ID > 0) {
            $Album = $this->Model->GetByID($ID);
            $this->View->Data['dResults'] = $Album;
            $this->View->Data['dTitle'] = $Album['Title'];
        } else {
            $this->View->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->Render();
    }

    /**
     * @link http://mrabdelrahman10.com/gallery/i_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/gallery/i_m/8
     * @return array one album row by id or return null.
     */
    public function i_m($_ID) {
        $ID = intval($_ID);
        $d = $this->Model->GetByID($this->Filter(urldecode($ID)));
        if ($d) {
            $d['Pics'] = $this->Model->GetPhotos($ID);
        }
        EchoJson($d);
    }

}

