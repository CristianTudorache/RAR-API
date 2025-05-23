<?php
// Permite toate originile (doar pentru dezvoltare locală! - vulnerabilitate ridicata), se comenteaza/sterg liniile in productie
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

require_once __DIR__ . '/../app/Controllers/VehicleController.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$requestBody = file_get_contents('php://input');
file_put_contents('log.txt', file_get_contents("php://input"));
//debug
var_dump($requestBody);
$data = json_decode($requestBody);

$controller = new VehicleController();

// Match: POST /api/vehicles/:vin  -> ([A-Z0-9]+) la final daca vrem regex match cu VIN-ul masinii
if ($method === 'POST' && preg_match('#^/api/vehicles/add$#', $uri)) {
    $controller->addVehicle($data);
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
