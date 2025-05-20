CREATE TABLE vehicle_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vin VARCHAR(30),
    nr_inmatriculare VARCHAR(20),
    data_prestatie DATE,
    prestatii TEXT, 
    odometru_final INT,
    odometru_initial INT NULL,
    obs TEXT, 
    sistem_reparat TEXT, 
    status ENUM('IN ASTEPTARE', 'FINALIZAT', 'EROARE') DEFAULT 'IN ASTEPTARE',
    payload_json JSONB, 
    response_json JSONB, 
    retry_count INT DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    sent_at TIMESTAMP NULL
);