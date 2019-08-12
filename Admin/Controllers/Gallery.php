<?php

class GalleryController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('Gallery/Form');
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 300, 5),
            new ErrorField('Description', 'Description', $Data['Description']),
            new ErrorField('Picture', 'Picture', $Data['Picture'], true),
            new ErrorField('SliderPictures', 'SliderPictures', $Data['SliderPictures'], true),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}