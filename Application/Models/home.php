<?php

class homeModel extends Model {


    protected function BaseSql($param = null) {
        return $this->SelectArticle . ' From ' . $this->TableArticle . " $param";
    }

    public function GetSliderArticles() {
        return $this->db->Select($this->TableArticle .' And p.Slider = 1 And p.State = 1 Order By p.ID DESC', $this->SelectArticle, null,null, null, 6);
    }

    public function GetFeaturedArticles() {
        return $this->db->Select($this->TableArticle .' And p.Featured = 1 And p.State = 1 Order By p.ID DESC', $this->SelectArticle, null,null, null, 6);
    }

    public function GetPicNews() {
        return $this->db->GetRows($this->BaseSql(' And p.State = 1 Order By p.ID DESC LIMIT 33'));
    }

    public function GetLastVideos() {
        $Sql = 'Select * From video Where State = 1 Order By ID DESC LIMIT 7';
        return $this->db->GetRows($Sql);
    }

}