<?php

class PatientRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM patients ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO patients (id, name, age, gender, contact, notes) 
            VALUES (:id, :name, :age, :gender, :contact, :notes)"
        );

        return $stmt->execute([
            'id' => $data['id'],
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'contact' => $data['contact'],
            'notes' => $data['notes'] ?? null
        ]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $stmt = $this->pdo->prepare(
            "UPDATE patients 
            SET name = :name, age = :age, gender = :gender, contact = :contact, notes = :notes
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $data['id'],
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'contact' => $data['contact'],
            'notes' => $data['notes'] ?? null
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM patients WHERE id = ?");
        return $stmt->execute([$id]);
    }
}