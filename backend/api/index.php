<?php

require_once __DIR__ . '/../app/Controllers/VehicleController.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = new VehicleController();

// Match: POST /api/vehicles/:vin
if ($method === 'POST' && preg_match('#^/api/vehicles/([A-Z0-9]+)$#', $uri, $matches)) {
    $vin = $matches[1];
    $controller->addVehicle($vin);
    exit;
}

// Match: GET /api/vehicles/queue
if ($method === 'GET' && preg_match('#^/api/vehicles/queue$#', $uri)) {
    $controller->getQueue();
    exit;
}

// Match: POST /api/vehicles/send-batch
if ($method === 'POST' && preg_match('#^/api/vehicles/send-batch$#', $uri)) {
    $controller->sendBatch();
    exit;
}

// Dacă nu s-a potrivit nicio rută:
http_response_code(404);
echo json_encode(['error' => 'Route not found']);



// Testam aplicatia aici: 
// header('Content-Type: application/json');
// echo json_encode(['message' => 'API is working']);
