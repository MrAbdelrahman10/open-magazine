<?php

class ShowModel extends ModelAdmin {

    public function GetAllCategories() {
        return $this->db->Select('category');
    }

    public function GetAllArticles() {
        $Sql = "SELECT p.*,
                c.Name as 'CategoryName',
                c.Alias as 'CategoryAlias',
                u.UserName
		FROM    article p
                   INNER JOIN
                      category c
                   ON (p.CategoryID = c.ID)
		INNER JOIN
		user u
		ON (p.UserID = u.ID)";
        return $this->db->GetRows($Sql);
    }

    public function GetAllPages() {
        return $this->db->Select('page');
    }

    public function GetAllAlbums() {
        return $this->db->Select('gallery');
    }

}