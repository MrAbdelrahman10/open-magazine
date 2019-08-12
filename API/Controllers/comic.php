<?php

class comicController extends Controller {

    /**
     *  @return array of all comics with paginate or return null.
     *  @link http://mrabdelrahman10.com/comic/index
     *  @example http://mrabdelrahman10.com/comic/index
     */
    public function index() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    /**
     * @link http://mrabdelrahman10.com/comic/i/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/comic/i/108
     * @return array one comic row by id or return null.
     */
    public function i($ID) {
        EchoJson($this->Model->GetByID($this->Filter(urldecode($ID))));
    }

}
