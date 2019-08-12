<?php

class PageController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('Page/Form');
    }

    protected function GetData() {
        $rem = array('Contents');
        $Data = $this->FilterPost($rem);
        $Desc = SubText(GetTextFromHTML($Data['Contents']), 0, 200);
        $old = trim($Data['Description']);
        $Data['Description'] = empty($old) ? $Desc : $old;
        return $Data;
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 300, 5),
            new ErrorField('Contents', 'Contents', $Data['Contents'], true),
            new ErrorField('Description', 'Description', $Data['Description'], true),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}
