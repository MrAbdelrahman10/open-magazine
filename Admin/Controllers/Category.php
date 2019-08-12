<?php

class CategoryController extends ControllerAdmin {

    protected function IndexBeforeRender() {
        $this->Data['dCategoriesList'] = $this->GetCategories();
    }

    protected function GetForm() {
        $this->Data['dCategories'] = $this->GetCategories();
        $this->View->Render('Category/Form');
    }

    private function GetCategories() {
        $Categories = $this->Model->GetAll();
        $Output = '<option value="0">' . $this->_['_NotFound'] . '</option>';
        foreach ($Categories as $Category) {
            $Output .= '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
        }
        return $Output;
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Name', 'Category', $Data['Name'], true, NULL, 50),
            new ErrorField('Parent', 'Parent', $Data['Parent'], false, FieldType::Integer),
            new ErrorField('HPSO', 'HPSO', $Data['HPSO'], false, FieldType::Integer),
            new ErrorField('SortingOrder', 'SortingOrder', $Data['SortingOrder'], false, FieldType::Integer),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}