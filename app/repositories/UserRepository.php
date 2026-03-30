<?php
class UserRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
    $stmt = $this->pdo->prepare(
        "INSERT INTO users (id, email, password) 
        VALUES (:id, :email, :password)"
    );

    return $stmt->execute([
        'id' => $data['id'],
        'email' => $data['email'],
        'password' => $data['password']
    ]);
}

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}