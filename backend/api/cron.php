<?php
require_once __DIR__ . '/../app/Services/VehicleService.php';
require_once __DIR__ . '/../app/Services/RARService.php';
require_once __DIR__ . '/../app/Controllers/VehicleController.php';

$vehicleController = new VehicleController();

while (true) {
    echo "Running batch...\n";
    $results = $vehicleService->sendBatch();
    foreach ($results as $result) {
        echo date('Y-m-d H:i:s') . " - VIN: {$result['vin']} - Status: " . ($result['success'] ? 'Trimis' : 'Eroare') . "\n";
    }
    sleep(60);  // pauză de 60 secunde
}
