<?php require_once __DIR__ . '/../../helpers/csrf.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

<div class="container mt-5" style="max-width: 600px;">

    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">Add Patient</h3>

        <!-- <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?> -->

        <form method="POST" action="<?= BASE_URL ?>/patients-store">

            <input type="hidden" name="csrf_token" value="<?= generateToken(); ?>">

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                    type="text" 
                    name="name"
                    class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>"
                    value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                >
                <?php if (!empty($errors['name'])): ?>
                    <div class="invalid-feedback"><?= $errors['name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Age</label>
                <input 
                    type="number" 
                    name="age"
                    class="form-control <?= !empty($errors['age']) ? 'is-invalid' : '' ?>"
                    value="<?= htmlspecialchars($old['age'] ?? '') ?>"
                >
                <?php if (!empty($errors['age'])): ?>
                    <div class="invalid-feedback"><?= $errors['age'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <input 
                    type="text" 
                    name="gender"
                    class="form-control"
                    value="<?= htmlspecialchars($old['gender'] ?? '') ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Contact</label>
                <input 
                    type="text" 
                    name="contact"
                    class="form-control"
                    value="<?= htmlspecialchars($old['contact'] ?? '') ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Notes</label>
                <textarea 
                    name="notes"
                    class="form-control"
                ><?= htmlspecialchars($old['notes'] ?? '') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= BASE_URL ?>/patients" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>

        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>