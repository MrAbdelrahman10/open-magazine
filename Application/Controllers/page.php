<?php
/**
 * Static Pages
 */
class pageController extends Controller {

    public function index() {
        $this->Redirect(BASE_URL);
    }

    public function i($ID) {
        $Page = $this->Model->GetByID($this->Filter(urldecode($ID)));
        if ($Page) {
            if (strstr($Page['Alias'], 'redir:')) {
                $Url = str_replace('redir:', '', $Page['Alias']);
                Redirect(GetRewriteUrl($Url));
            }
            $this->View->Data['dResults'] = $Page;
            $this->View->Data['dTitle'] = $Page['Title'];
        } else {
            $this->View->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->Render();
    }

    /**
     * @link http://mrabdelrahman10.com/page/i_m/{ID}
     * @param int $ID
     * @example http://mrabdelrahman10.com/page/i_m/1
     * @return array one page row by id or return null.
     */
    public function i_m($ID) {
        $d = $this->Model->GetByID($this->Filter(urldecode($ID)));
        EchoJson($d);
    }

}

?>