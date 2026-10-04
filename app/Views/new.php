<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>
<div class="container py-5">
    <h1>Add New Customer</h1>

    <?php $errors = session('errors') ?? []; ?>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('customers/create') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                value="<?= esc(old('full_name')) ?>"
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                value="<?= esc(old('email')) ?>"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Save Customer
        </button>

        <a href="<?= site_url('customers') ?>" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>
</body>
</html>