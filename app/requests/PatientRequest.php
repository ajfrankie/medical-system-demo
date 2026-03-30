<?php

class PatientRequest {

    public static function validateCreate($data) {

        $errors = [];

        if (!isset($data['csrf_token']) || !validateToken($data['csrf_token'])) {
            $errors['general'] = "Invalid CSRF Token";
        }

        if (empty($data['name'])) {
            $errors['name'] = "Name is required";
        }

        if (!isset($data['age']) || !is_numeric($data['age'])) {
            $errors['age'] = "Valid age is required";
        } else {
            $age = (int)$data['age'];

            if ($age < 1 || $age > 100) {
                $errors['age'] = "Age must be between 1 and 100";
            }
        }

        return $errors;
    }

    public static function validateUpdate($data) {

        $errors = [];

        if (!isset($data['csrf_token']) || !validateToken($data['csrf_token'])) {
            $errors['general'] = "Invalid CSRF Token";
        }

        if (empty($data['id'])) {
            $errors['general'] = "Invalid patient ID";
        }

        if (empty($data['name'])) {
            $errors['name'] = "Name is required";
        }

        if (!isset($data['age']) || !is_numeric($data['age'])) {
            $errors['age'] = "Valid age is required";
        } else {
            $age = (int)$data['age'];

            if ($age < 1 || $age > 100) {
                $errors['age'] = "Age must be between 1 and 100";
            }
        }

        return $errors;
    }
}
