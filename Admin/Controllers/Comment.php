<?php

class CommentController extends ControllerAdmin implements IControllerAdmin {

    public function Index() {
        $d = &$this->Data;
        $d['dCommentOn'] = $this->Model->GetCountOn();
        $d['dCommentOff'] = $this->Model->GetCountOff();
        $d['dCommentAll'] = $d['dCommentOn'] + $d['dCommentOff'];
        parent::Index();
    }
    
    protected function GetForm() {
        $this->View->Render('Comment/Form');
    }

    protected function LoadData($Data) {
        $this->Data['dID'] = $Data['ID'];
        $this->Data['dUserID'] = $Data['UserID'];
        $this->Data['dUserName'] = $Data['UserName'];
        $this->Data['dEmail'] = $Data['Email'];
        $this->Data['dTitle'] = $Data['Title'];
        $this->Data['dContents'] = $Data['Contents'];
        $this->Data['dCreatedDate'] = $Data['CreatedDate'];
        $this->Data['dState'] = $Data['State'];
    }

    protected function Validation() {
        $Data = $this->GetData();

        $Title = array(
            'ID' => 'Title',
            'Name' => '_Title',
            'Value' => $Data['Title'],
            'Required' => true,
            'Length' => 100
        );
        $Data[] = $Title;

        $Contents = array(
            'ID' => 'Contents',
            'Name' => '_Contents',
            'Value' => $Data['Contents'],
            'Required' => true,
        );
        $Data[] = $Contents;

        $State = array(
            'ID' => 'State',
            'Name' => '_State',
            'Value' => $Data['State'],
            'Required' => true,
            'Type' => 'bool'
        );
        $Data[] = $State;

        return $this->DoValidation($Data);
    }

}

?>