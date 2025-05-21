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

    public function addToQueue($vin)
    {
        $stmt = $this->db->prepare("INSERT INTO vehicle_queue (vin, status, created_at) VALUES (:vin, 'pending', NOW())");
        $stmt->execute(['vin' => $vin]);
    }

    public function getPendingQueue()
    {
        $stmt = $this->db->query("SELECT * FROM vehicle_queue WHERE status = 'pending' ORDER BY created_at ASC");
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
}
