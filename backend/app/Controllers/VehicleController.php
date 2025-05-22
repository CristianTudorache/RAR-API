<?php

require_once __DIR__ . '/../Validators/VehicleValidator.php';
require_once __DIR__ . '/../Validators/VehicleValidatorRAR.php';
require_once __DIR__ . '/../Services/VehicleService.php';
require_once __DIR__ . '/../Services/RARService.php';

use App\Services\VehicleService;
use App\Services\RARService;
use App\Validators\VehicleValidator;

class VehicleController {

    private $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService();
    }

    public function addVehicle($data) {
        $validator = new VehicleValidator();
        $errors = $validator->validate($data); // Use the validator's method
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['error' => 'Date invalide', 'details' => $errors]);
            return $errors;
        }
    
        $this->vehicleService->addToQueue($data); // doar vin, momentan
        echo json_encode(['success' => true]);
    }

    public function getQueue() {
        // $queue = $this->vehicleService->getPendingQueue();
        $queue = $this->vehicleService->getAllTest();
        echo json_encode([
            'success' => true,
            'queue_count' => count($queue),
            'vehicles' => $queue
        ]);
    }

    public function sendBatch() {
        $batch = $this->vehicleService->getNextBatch(10);
        $rar = new RARService();
        $sent = [];

        foreach ($batch as $vehicle) {
            // Simulam trimiterea
            $response = $rar->send($vehicle);

            if ($response['success']) {
                $this->vehicleService->markAsSent($vehicle->id);
                $sent[] = $vehicle->vin;
            }
        }

        echo json_encode([
            'success' => true,
            'sent_count' => count($sent),
            'vins_sent' => $sent
        ]);
        return $sent;
    }
}
