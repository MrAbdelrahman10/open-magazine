<?php
/**
 * Videos Library From Youtube
 * element [Url] in one row is id of the paper_archive on Youtube
 */
class paper_archiveController extends Controller {
/**
     *  @return array of all paper_archives with paginate or return null.
     *  @link http://mrabdelrahman10.com/paper_archive/index
     *  @example http://mrabdelrahman10.com/paper_archive/index
     */
    public function index() {
        $d = array();
        $d['dResults'] = $this->Model->GetAll();
        $d['dRenderNav'] = $this->Model->db->RenderFullNav();
        EchoJson($d);
    }

    /**
     * @link http://mrabdelrahman10.com/paper_archive/i/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/paper_archive/i/108
     * @return array one paper_archive row by id or return null.
     */
    public function i($ID) {
        EchoJson($this->Model->GetByID($this->Filter(urldecode($ID))));
    }


}