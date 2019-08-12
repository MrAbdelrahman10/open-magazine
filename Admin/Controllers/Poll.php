<?php

class PollController extends ControllerAdmin {

    protected function GetForm() {
        $this->View->Render('Poll/Form');
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Q', 'Q', $Data['Q'], true, NULL, 300, 5),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}
