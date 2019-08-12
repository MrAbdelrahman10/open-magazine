<?php

/**
 * Galleries
 */
class galleryController extends Controller {

    /**
     *  @return array of all gallerys with paginate or return null.
     *  @link http://mrabdelrahman10.com/gallery/index
     *  @example http://mrabdelrahman10.com/gallery/index
     */
    public function index() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    /**
     * @link http://mrabdelrahman10.com/gallery/i/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/gallery/i/108
     * @return array one gallery row by id or return null.
     */
    public function i($ID) {
        EchoJson($this->Model->GetByID($this->Filter(urldecode($ID))));
    }

}