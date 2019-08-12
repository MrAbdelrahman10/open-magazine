<?php

class ShowController extends ControllerAdmin {

    public function Albums() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllAlbums();
            $this->View->RenderOnly(null, false);
        }
    }

    public function MenuAlbums() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllAlbums();
            $this->View->RenderOnly(null, false);
        }
    }

    public function Categories() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllCategories();
            $this->View->RenderOnly(null, false);
        }
    }

    public function BannerCategories() {
        $this->Categories();
    }

    public function Posts() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllArticles();
            $this->View->RenderOnly(null, false);
        }
    }

    public function Pages() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllPages();
            $this->View->RenderOnly(null, false);
        }
    }

    public function BannerPosts() {
        $this->Posts();
    }

    public function Banners() {
        if ($this->Authentication() == true) {
            $this->Data['dResults'] = $this->Model->GetAllBanners();
            $this->View->RenderOnly(null, false);
        }
    }

    protected function GetForm() {
        
    }

    protected function LoadData($Data) {
        
    }

    protected function Validation() {
        
    }

}

?>