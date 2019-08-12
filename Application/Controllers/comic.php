<?php

class comicController extends Controller {

    public function index() {
            $this->Data['dTitle'] = $this->_['_Comic'];
        $this->View->Data['dResults'] = $this->Model->GetAll();
        $this->View->Data['dRenderNav'] = $this->Model->db->RenderFullNav();
        $this->View->Render();
    }

    public function i($ID) {
        $Item = $this->Model->GetByID($ID);
        if ($Item) {
            $this->Data['dResults'] = $Item;
            $this->Data['dTitle'] = $Item['Title'];
        } else {
            $this->Data['dNoResults'] = $this->_['_NoResults'];
        }
        $this->View->Render();
    }

}
