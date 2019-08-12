<?php

class BannerController extends ControllerAdmin implements IControllerAdmin {

    protected function GetForm() {
        $this->Data['dBannerPositions'] = $this->LoadDropDown($this->_['_BannerPositionsList'], 'ID', 'Name');
        $Types = '<option value="0">' . $this->_['_Choose'] . '</option>';
        $Types .= '<option value="' . BannerType::Image . '">' . $this->_['_Image'] . '</option>';
        $Types .= '<option value="' . BannerType::Code . '">' . $this->_['_Code'] . '</option>';
        $this->Data['dBannerTypesList'] = $Types;
        $this->View->Render('Banner/Form');
    }

    protected function GetData() {
        $rem = array('BannerCode');
        return $this->FilterPost($rem);
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Name', 'Name', $Data['Name'], false),
            new ErrorField('BannerPosition', 'BannerPosition', $Data['BannerPosition'], true, FieldType::Integer),
            new ErrorField('BannerType', 'BannerType', $Data['BannerType'], true, FieldType::Integer),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}
