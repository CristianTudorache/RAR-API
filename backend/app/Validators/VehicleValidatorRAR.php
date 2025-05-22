<?php

// Clasa pentru validarea datelor trimise catre RAR

class VehicleValidatorRAR {
    public function validate($data) {
        if (
            !isset($data['vin']) || strlen($data['vin']) !== 17 ||
            empty($data['brand']) || 
            empty($data['model']) ||
            !isset($data['year']) || !is_numeric($data['year']) ||
            empty($data['color'])
            
        ) {
            return false;
        }
        return true;
    }   
}