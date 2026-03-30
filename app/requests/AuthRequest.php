<?php

class AuthRequest {

    public static function validateRegister($data, $repo) {

        $errors = [];

        // CSRF
        if (!isset($data['csrf_token']) || !validateToken($data['csrf_token'])) {
            $errors['general'] = "Invalid CSRF Token";
        }

        // EMAIL
        if (empty($data['email'])) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        } elseif ($repo->findByEmail($data['email'])) {
            $errors['email'] = "Email already registered";
        }

        // PASSWORD
        if (empty($data['password'])) {
            $errors['password'] = "Password is required";
        } elseif (strlen($data['password']) < 4) {
            $errors['password'] = "Password must be at least 4 characters";
        }

        return $errors;
    }

    public static function validateLogin($data) {

        $errors = [];

        // CSRF
        if (!isset($data['csrf_token']) || !validateToken($data['csrf_token'])) {
            $errors['general'] = "Invalid CSRF Token";
        }

        // EMAIL
        if (empty($data['email'])) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        // PASSWORD
        if (empty($data['password'])) {
            $errors['password'] = "Password is required";
        }

        return $errors;
    }
}