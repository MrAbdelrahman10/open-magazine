<?php
/**
 * Videos Library From Youtube
 * element [Url] in one row is id of the video on Youtube
 */
class videoController extends Controller {

/**
     *  @return array of all videos with paginate or return null.
     *  @link http://mrabdelrahman10.com/video/index
     *  @example http://mrabdelrahman10.com/video/index
     */
    public function index() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    /**
     * @link http://mrabdelrahman10.com/video/i/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/video/i/108
     * @return array one video row by id or return null.
     */
    public function i($ID) {
        EchoJson($this->Model->GetByID($this->Filter(urldecode($ID))));
    }

}
