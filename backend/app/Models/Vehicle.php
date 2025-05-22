<?php

namespace App\Models;

use PDO;

class Vehicle {
    public $vin;
    public $nrInmatriculare;
    public $dataPrestatie;
    public $obs;
    public $odometruFinal;
    public $odometruInitial;
    public $prestatii;
    public $sistemReparat;
    public $status;
    public $b64Image;

    protected $pdo;

    public function __construct($data) {
        $this->vin = $data['vin'];
        $this->nrInmatriculare = $data['nrInmatriculare'];
        $this->dataPrestatie = $data['dataPrestatie'];
        $this->obs = $data['obs'] ?? null;
        $this->odometruFinal = $data['odometruFinal'] ?? null;
        $this->odometruInitial = $data['odometruInitial'] ?? null;
        $this->prestatii = $data['prestatii'];
        $this->sistemReparat = $data['sistemReparat'] ?? null;
        $this->status = $data['status'] ?? 'NEFINALIZATA';
        $this->b64Image = $data['b64Image'] ?? null;

        $this->pdo = require __DIR__ . '/../../config/database.php';
    }

    public function insertVehicle() {
        $stmt = $this->pdo->prepare("
            INSERT INTO vehicle_queue (
                vin, plate, data_prestare, status, odometru_initial, odometru_final, obs, created_at
            ) VALUES (
                :vin, :plate, :data_prestare, :status, :odometru_initial, :odometru_final, :obs, NOW()
            )
        ");

        $stmt->execute([
            ':vin' => $this->vin,
            ':plate' => $this->nrInmatriculare,
            ':data_prestare' => $this->dataPrestatie,
            ':status' => $this->status,
            ':odometru_initial' => $this->odometruInitial,
            ':odometru_final' => $this->odometruFinal,
            ':obs' => $this->obs
        ]);
    }
}
