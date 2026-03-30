<?php

require_once __DIR__ . '/../repositories/PatientRepository.php';
require_once __DIR__ . '/../helpers/uuid.php';
require_once __DIR__ . '/../requests/PatientRequest.php';

class PatientController {

    private $repo;

    public function __construct($pdo) {
        $this->repo = new PatientRepository($pdo);
    }

    // LIST
    public function index() {
        $patients = $this->repo->getAll();
        require __DIR__ . '/../views/patients/index.php';
    }


    // CREATE PAGE
    public function create() {

        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['old']);

        require __DIR__ . '/../views/patients/create.php';
    }


    // STORE
    public function store($request) {

        $errors = PatientRequest::validateCreate($request);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;

            header("Location: " . BASE_URL . "/patients-create");
            exit;
        }

        $request['id'] = generateUUID();

        $this->repo->create($request);

        header("Location: " . BASE_URL . "/patients");
        exit;
    }


    // EDIT PAGE
    public function edit($id) {

        $patient = $this->repo->find($id);

        if (!$patient) {
            $_SESSION['errors'] = ['general' => 'Patient not found'];
            header("Location: " . BASE_URL . "/patients");
            exit;
        }

        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['old']);

        require __DIR__ . '/../views/patients/edit.php';
    }


    // UPDATE
    public function update($request) {

        $errors = PatientRequest::validateUpdate($request);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $request;

            header("Location: " . BASE_URL . "/patients-edit?id=" . $request['id']);
            exit;
        }

        $this->repo->update($request);

        header("Location: " . BASE_URL . "/patients");
        exit;
    }


    // DELETE
    public function delete($id) {

        if ($id) {
            $this->repo->delete($id);
        }

        header("Location: " . BASE_URL . "/patients");
        exit;
    }
}