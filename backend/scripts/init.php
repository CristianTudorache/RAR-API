<?php

require_once __DIR__ . '/../config/database.php';

// Folosește $pdo din config/database.php
$pdo = require __DIR__ . '/../config/database.php';

try {
    // Verificăm dacă tabela există deja
    $result = $pdo->query("
        SELECT EXISTS (
            SELECT FROM information_schema.tables 
            WHERE table_schema = 'public' 
              AND table_name = 'vehicle_queue'
        );
    ");

    $exists = $result->fetchColumn();

    if (!$exists) {
        $sql = "
            CREATE TABLE vehicle_queue (
    id SERIAL PRIMARY KEY,
    vin VARCHAR(30),
    nr_inmatriculare VARCHAR(20),
    data_prestatie DATE,
    prestatii JSONB, 
    odometru_final INT,
    odometru_initial INT NULL,
    obs TEXT, 
    sistem_reparat TEXT, 
    status TEXT CHECK (status IN ('IN ASTEPTARE', 'FINALIZAT', 'EROARE')) DEFAULT 'IN ASTEPTARE',
    payload_json JSONB, 
    response_json JSONB, 
    retry_count INT DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    sent_at TIMESTAMP NULL
);
        ";

        $pdo->exec($sql);
        echo "Tabela 'vehicle_queue' a fost creată.\n";
    } else {
        echo "Tabela 'vehicle_queue' există deja.\n";
    }

} catch (PDOException $e) {
    echo "Eroare la verificarea sau crearea tabelei: " . $e->getMessage();
}
