<?php
require_once __DIR__ . '/../../helpers/csrf.php';

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

<div class="container mt-5" style="max-width: 500px;">

    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">Register</h3>

        <form method="POST" action="<?= BASE_URL ?>/register-store">

            <input type="hidden" name="csrf_token" value="<?= generateToken(); ?>">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                    name="email"
                    value="<?= $_SESSION['old']['email'] ?? '' ?>"
                >
                <?php if (!empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
                    name="password"
                >
                <?php if (!empty($errors['password'])): ?>
                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success w-100">
                Register
            </button>

            <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>/">Back to Login</a>
            </div>

        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>