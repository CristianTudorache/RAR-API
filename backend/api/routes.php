<?php

require_once __DIR__ . '/../app/Controllers/VehicleController.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Match: POST /api/vehicles/:vin
if ($method === 'POST' && preg_match('#^/api/vehicles/([A-Z0-9]+)$#', $uri, $matches)) {
    $vin = $matches[1];
    $controller = new VehicleController();
    $controller->addVehicle($vin);
    exit;
}
