<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Patients</h2>

        <div>
            <span class="me-3">Welcome, <?= htmlspecialchars($_SESSION['user']); ?></span>

        <a href="<?= BASE_URL ?>/logout" class="btn btn-danger btn-sm">
            Logout
        </a>
        </div>
    </div>

<a href="<?= BASE_URL ?>/patients-create" class="btn btn-primary mb-3">
    + Add Patient
</a>
    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($patients as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['age']) ?></td>

                    <td>
                        <a href="<?= BASE_URL ?>/patients-edit?id=<?= $p['id'] ?>" 
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                       <a href="<?= BASE_URL ?>/patients-delete?id=<?= $p['id'] ?>" 
                            class="btn btn-danger btn-sm delete-btn">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('.delete-btn').click(function(e){
    if(!confirm("Are you sure you want to delete this patient?")){
        e.preventDefault();
    }
});
</script>

</body>
</html>