<?php

class DayPictureController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('DayPicture/Form');
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 300, 5),
            new ErrorField('Picture', 'Picture', $Data['Picture'], true),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}