<?php

class ArticleController extends ControllerAdmin {

    public function Preview() {
        Session::Init();
        $ID = time();
        $PV = Session::Get('Preview');
        $PV[$ID] = $this->GetData();
        Session::Set('Preview', $PV);
        echo $ID;
    }

    protected function IndexBeforeRender() {
        $this->Data['dCategoriesList'] = $this->GetCategories();
    }


    public function AfterAdd() {
        $this->UpdateRss();
    }

    public function AfterEdit() {
        $this->UpdateRss();
    }

    public function Delete() {
        parent::Delete();
        $this->UpdateRss();
    }

    public function AfterChangeState() {
        $this->UpdateRss();
    }

    protected function GetForm() {
        $this->Data['dCategoriesList'] = $this->GetCategories();
        $this->View->Render('Article/Form');
    }

    protected function GetData() {
        $rem = array('Contents');
        $Data = $this->FilterPost($rem);
        $Desc = SubText(GetTextFromHTML($Data['Contents']), 0, 300);
        $old = trim($Data['Description']);
        $Data['Description'] = $Desc; //empty($old) ? $Desc : $old;
        return $Data;
    }

    private function GetCategories() {
        $Categories = $this->Model->GetCategories();
        $Cats = array();
        $User = $this->GetLoggedUser();
        $IsAdmin = $User['IsAdmin'] == 1 ? true : false;
        $IsEditor = $User['IsAdmin'] == 0 && $User['IsEditor'] == 1 ? true : false;
        $Perm = explode(',', $User['Permission']);
        foreach ($Perm as $p) {
            if (strstr($p, 'Category-') > -1) {
                $Cats[] = str_replace('Category-', '', $p);
            }
        }
        $Output = '<option value="0"> --' . $this->_['_Choose'] . $this->_['_Category'] . '-- </option>';
        foreach ($Categories as $Category) {
            if ($IsAdmin == 1 || ($IsEditor == 1 && in_array($Category['ID'], $Cats)))
                $Output .= '<option value="' . $Category['ID'] . '"' . ($Category['IsParent'] == true ? ' disabled style="background-color: #dedede;"' : '') . '>' . $Category['Name'] . '</option>';
        }
        return $Output;
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 300, 5),
            new ErrorField('Category', 'Category', $Data['Category'], true, FieldType::Integer),
            new ErrorField('Contents', 'Contents', $Data['Contents'], true),
            new ErrorField('Description', 'Description', $Data['Description'], true),
            new ErrorField('Featured', 'Featured', $Data['Featured'], true, FieldType::Bool),
            new ErrorField('Approved', 'Approved', $Data['Approved'], true, FieldType::Bool),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

    public function UpdateRss() {
        if (Request::IsPost()) {
            $rss = new RSSWriter();
            $Data = $this->Model->GetLatest();
            $rss->Title = $this->Settings['sSite_Name'];
            $rss->Items = $Data;
            $rss->Create();
            Cache::Delete();
        }
    }

}
