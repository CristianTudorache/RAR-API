<?php

class VehicleController {
    public function sendToRAR($data) {
        $validator = new VehicleValidatorRAR();
        if (!$validator->validate($data)) {
            http_response_code(400);
            echo json_encode(['error' => 'Date invalide']);
            return;
        }

        $rar = new RARService();
        $response = $rar->send($data);
        echo json_encode($response);
    }

    public function addVehicle($data) {
        $validator = new VehicleValidator();
        if (!$validator->validate($data)) {
            http_response_code(400);
            echo json_encode(['error' => 'Date invalide']);
            return;
        }


    }
}