<?php
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../requests/AuthRequest.php';
require_once __DIR__ . '/../helpers/uuid.php';

class AuthController {

    private $repo;

    public function __construct($pdo) {
        $this->repo = new UserRepository($pdo);
    }

    public function showRegister() {
        require __DIR__ . '/../views/auth/register.php';
    }

    //REGISTER
    public function register($request) {

        $errors = AuthRequest::validateRegister($request, $this->repo);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;

            header("Location: " . BASE_URL . "/register");
            exit;
        }

        $id = generateUUID();

        $hashedPassword = password_hash($request['password'], PASSWORD_DEFAULT);

        $this->repo->create([
            'id' => $id,
            'email' => $request['email'],
            'password' => $hashedPassword
        ]);

        header("Location: " . BASE_URL . "/");
        exit;
    }

    //LOGIN
    public function login($request) {

        $errors = AuthRequest::validateLogin($request);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;

            header("Location: " . BASE_URL . "/");
            exit;
        }

        $user = $this->repo->findByEmail($request['email']);

        if (!$user || !password_verify($request['password'], $user['password'])) {
            $_SESSION['errors'] = [
                'general' => 'Invalid email or password'
            ];
            $_SESSION['old'] = $request;

            header("Location: " . BASE_URL . "/");
            exit;
        }

        $_SESSION['user'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];

        header("Location: " . BASE_URL . "/patients");
        exit;
    }
}