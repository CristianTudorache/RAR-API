<?php

require_once '../app/Controllers/VehicleController.php';

$controller = new VehicleController();
$controller->sendToRAR($POST);

