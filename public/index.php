<?php
session_start();

// =========================
// CONFIG & DEPENDENCIES
// =========================
require_once __DIR__ . '/../app/config/database.php';

require_once __DIR__ . '/../app/controllers/PatientController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

require_once __DIR__ . '/../app/core/Request.php';
require_once __DIR__ . '/../app/helpers/csrf.php';
require_once __DIR__ . '/../app/helpers/uuid.php';

// =========================
// BASE URL
// =========================
define('BASE_URL', '/medical-system/public');

// =========================
// GET ROUTE
// =========================
$url = $_GET['url'] ?? 'login';

// =========================
// CONTROLLERS
// =========================
$patientController = new PatientController($pdo);
$authController = new AuthController($pdo);

// =========================
// HANDLE POST REQUESTS
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($url) {

        case 'login':
            $authController->login($_POST);
            break;

        case 'register-store':
            $authController->register(Request::all());
            break;

        case 'patients-store':
            $patientController->store(Request::all());
            break;

        case 'patients-update':
            $patientController->update(Request::all());
            break;
    }

    exit;
}

// =========================
// PROTECT ROUTES
// =========================
$publicRoutes = ['login', 'register', 'register-store'];

if (!isset($_SESSION['user']) && !in_array($url, $publicRoutes)) {
    header("Location: " . BASE_URL . "/");
    exit;
}

// =========================
// ROUTING
// =========================
switch ($url) {

    case 'patients':
        $patientController->index();
        break;

    case 'patients-create':
        $patientController->create();
        break;

    case 'patients-edit':
        if (isset($_GET['id'])) {
            $patientController->edit($_GET['id']);
        }
        break;

    case 'patients-delete':
        if (isset($_GET['id'])) {
            $patientController->delete($_GET['id']);
        }
        break;

    case 'register':
        $authController->showRegister();
        break;

    case 'logout':
        session_destroy();
        header("Location: " . BASE_URL . "/");
        exit;

    case 'login':
    default:
        require __DIR__ . '/../app/views/auth/login.php';
        break;
}