<?php

namespace App\Services;

class RARService {
    public function send(array $vehicle): array {
        // Aici în realitate folosim curl
        // Ex: curl_exec($ch) sau $response = Http::post(...)

        // Simulăm un răspuns cu 90% șanse de succes - aleatoriu
        // Facem asta pentru a simula un sistem functional
        $success = rand(1, 10) <= 9;

        if ($success) {
            return [
                'success' => true,
                'message' => 'Vehicul trimis cu succes la RAR',
                'vin' => $vehicle['vin'] ?? null
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Eroare la trimiterea către RAR',
                'vin' => $vehicle['vin'] ?? null
            ];
        }
    }
}
