<?php

class DayPictureModel extends ModelAdmin implements IModelAdmin {


    protected $TableName = 'daypicture';

    protected $SearchFields = array(
        't.ID',
        't.Title',
        't.Viewed',
        't.CreatedDate',
        't.State'
    );

    protected $SortFields = array(
        'ID',
        'Title',
        'Viewed',
        'CreatedDate',
        'State'
    );
    protected $Table = " daypicture t ";
    protected $Select = " STRAIGHT_JOIN t.* ";

    protected function GetData($Data) {
        $fData = array(
            new DBField('Title', $Data['Title'], PDO::PARAM_STR),
            new DBField('Description', $Data['Description'], PDO::PARAM_STR),
            new DBField('Keywords', $Data['Keywords'], PDO::PARAM_STR),
            new DBField('Picture', $Data['Picture'], PDO::PARAM_STR),
            new DBField('State', $Data['State'], PDO::PARAM_BOOL)
        );
        return $fData;
    }

}