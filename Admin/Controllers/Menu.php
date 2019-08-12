<?php

class MenuController extends ControllerAdmin {

    protected function GetForm() {
        $this->Data['dMenuItemTypes'] = $this->GetMenuItemTypes();
        $this->Data['dMenus'] = $this->GetMenus();
        $this->View->Render('Menu/Form');
    }

    public function UpdateMenu() {
        $Data = $this->GetData();
        foreach ($Data['Sort'] as $i) {
            $__ = explode('=', $i);
            $id = intval(GetValue($__[0]));
            $sort = intval(GetValue($__[1]));
            if ($id > 0) {
                $this->Model->SetSort($id, $sort);
            }
        }
        EchoExit($this->_['_SavedDone']);
    }

    private function GetMenus() {
        return $this->LoadDropDown($this->Model->GetAll(), 'ID', 'Title');
    }

    private function GetMenuItemTypes() {
        $Menus = $this->_['_MenuItemTypes'];
        $Output = '<option value="0" data-editable="false" data-format="{0}">' . $this->_['_NotFound'] . '</option>';
        foreach ($Menus as $Item) {
            $Output .= '<option data-editable="' .
                    ($Item['Editable'] == 1 ? 'true' : 'false') .
                    '" data-format="' . $Item['Format'] . '"
			data-load="' . $Item['TableData'] . '"' .
                    'value="' . $Item['ID'] . '">' . $Item['Title'] . '</option>';
        }
        return $Output;
    }

    protected function Validation() {
        $Data = $this->GetData();
        $Valid = array(
            new ErrorField('Title', 'Title', $Data['Title'], true, NULL, 50),
            new ErrorField('Parent', 'Parent', $Data['Parent'], false, FieldType::Integer),
            new ErrorField('MenuItemType', 'MenuItemType', $Data['MenuItemType'], true, FieldType::Integer),
            new ErrorField('SortingOrder', 'SortingOrder', $Data['SortingOrder'], true, FieldType::Integer),
            new ErrorField('State', 'State', $Data['State'], true, FieldType::Bool)
        );

        return $this->DoValidation($Valid);
    }

}