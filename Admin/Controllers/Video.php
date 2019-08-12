<?php

class VideoController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('Video/Form');
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 300, 5),
            new ErrorField('Url', 'Url', $Data['Url'], true, NULL, 11, 11),
            new ErrorField('Description', 'Description', $Data['Description']),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}