<?php

namespace App\Models;

use PDO;

class Vehicle {
    public $vin;
    public $brand;
    public $model;
    public $year;
    public $color;
    private $pdo;

    public function __construct($data) {
        $this->vin = $data['vin'];
        $this->brand = $data['brand'];
        $this->model = $data['model'];
        $this->year = $data['year'];
        $this->color = $data['color'];


        $this->pdo = require __DIR__ . '/../../config/database.php';
    }

    public function insertVehicle($vin, $data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO vehicle_queue (vin, plate, prestare_id, data_prestare, status, created_at)
            VALUES (:vin, :plate, :prestare_id, :data_prestare, 'pending', NOW())
        ");

        $stmt->execute([
            ':vin' => $vin, 
            ':plate' => $data['plate'],
            ':prestare_id' => $data['prestare_id'],
            ':data_prestare' => $data['data_prestare']
        ]);
    }
}