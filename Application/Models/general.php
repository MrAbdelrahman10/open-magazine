<?php

class generalModel extends Model {

    public function AddDevice($Data) {
        $fData = array(
            new Field('DeviceToken', 'DeviceToken', $Data['DeviceToken'], PDO::PARAM_STR),
            new Field('DeviceType', 'DeviceType', $Data['DeviceType'], PDO::PARAM_STR),
            new Field('CreatedDate', 'CreatedDate', GetDateValue(), PDO::PARAM_STR),
            new Field('State', 'State', true, PDO::PARAM_BOOL)
        );
        $this->db->Insert($fData, 'device');
        return $this->db->InsertedID();
    }

    public function DeleteDevice($Data) {
        $Where = array(
            new Field('DeviceToken', 'DeviceToken', $Data['DeviceToken'], PDO::PARAM_STR)
        );
        return $this->db->Delete(null, 'device', $Where);
    }

}

?>