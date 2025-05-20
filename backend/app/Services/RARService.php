<?php

class RARService {
    public function send($vehicleData) {
        // Simulam aici trimiterea catre RAR
        $ch = curl_init('https://api.rar.mock/send');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vehicleData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer API_KEY'
        ]);

        // Simulam raspuns
        $fakeResponse = [
            'status' => 'aprobat',
            'message' => 'Vehicul inregistrat cu succes la RAR'
        ];

        // In realitate ar arata ceva de genul: $response = curl_exec($ch)
        return $fakeResponse;
    }
}