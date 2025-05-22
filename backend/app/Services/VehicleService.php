<?php

namespace App\Services;

use PDO;
use Exception;

class VehicleService
{
    private $db;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->db = $pdo;
    }

    public function addToQueue(object $vehicle)
{
    //Debug
    error_log(print_r($vehicle, true));


    $stmt = $this->db->prepare("INSERT INTO vehicle_queue 
        (vin, nr_inmatriculare, data_prestatie, prestatii, odometru_initial, odometru_final, obs, sistem_reparat, status, created_at) 
        VALUES 
        (:vin, :nr_inmatriculare, :data_prestatie, :prestatii, :odometru_initial, :odometru_final, :obs, :sistem_reparat, :status, NOW())");

    $stmt->execute([
        'vin' => $vehicle->vin ?? null,
        'nr_inmatriculare' => $vehicle->nrInmatriculare ?? null,
        'data_prestatie' => $vehicle->dataPrestatie ?? null,
        // dacă prestatii este array, îl transformăm în JSON
        'prestatii' => isset($vehicle->prestatii) ? json_encode($vehicle->prestatii) : null,
        'odometru_initial' => isset($vehicle->odometruInitial) ? (int)$vehicle->odometruInitial : null,
        'odometru_final' => isset($vehicle->odometruFinal) ? (int)$vehicle->odometruFinal : null,
        'obs' => $vehicle->obs ?? null,
        'sistem_reparat' => $vehicle->sistemReparat ?? null,
        // atenție la status, să fie conform ENUM, aici transformăm în majuscule fără 'A'
        'status' => isset($vehicle->status) && strtoupper($vehicle->status) === 'FINALIZATA' ? 'FINALIZAT' : ($vehicle->status ?? 'IN ASTEPTARE')
    ]);
}

public function getPendingQueue() {
    $stmt = $this->db->query("SELECT * FROM vehicle_queue WHERE status = 'IN ASTEPTARE' OR status = 'pending'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getNextBatch($limit = 10)
    {
        $stmt = $this->db->prepare("SELECT * FROM vehicle_queue WHERE status = 'pending' ORDER BY created_at ASC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsSent($id)
    {
        $stmt = $this->db->prepare("UPDATE vehicle_queue SET status = 'sent', sent_at = NOW() WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getAllTest() {
        $stmt = $this->db->query("SELECT * FROM vehicle_queue");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
