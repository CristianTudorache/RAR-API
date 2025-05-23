<?php

namespace App\Validators;

class VehicleValidator {
    public static function validate(object $data): array {
        $errors = [];

        if (empty($data->vin)) {
            $errors[] = 'VIN este obligatoriu.';
        }

        if (empty($data->nrInmatriculare)) {
            $errors[] = 'Numărul de înmatriculare este obligatoriu.';
        }

        if (empty($data->dataPrestatie)) {
            $errors[] = 'Data prestației este obligatorie.';
        }

        if (!isset($data->prestatii) || !is_array($data->prestatii) || count($data->prestatii) === 0) {
            $errors[] = 'Cel puțin o prestație trebuie selectată.';
        }

        if (isset($data->odometruInitial) && !is_numeric($data->odometruInitial)) {
            $errors[] = 'Odometrul inițial trebuie să fie numeric.';
        }

        if (isset($data->odometruFinal) && !is_numeric($data->odometruFinal)) {
            $errors[] = 'Odometrul final trebuie să fie numeric.';
        }

        if (isset($data->b64Image) && !self::isBase64($data->b64Image)) {
            $errors[] = 'Imaginea trebuie să fie în format base64 valid.';
        }

        return $errors;
    }

    private static function isBase64(string $str): bool {
        $decoded = base64_decode($str, true);
        return $decoded !== false && base64_encode($decoded) === $str;
    }
}
