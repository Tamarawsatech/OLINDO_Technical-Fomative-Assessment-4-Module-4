<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 420px">
        <div class="card-body">
            <h1 class="h3 mb-4">POS Login</h1>

            <?php if ($message = session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= esc($message) ?></div>
            <?php endif; ?>
            <?php if ($message = session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= esc($message) ?></div>
            <?php endif; ?>
            <?php if ($errors = session('errors')): ?>
                <div class="alert alert-danger"><ul class="mb-0">
                    <?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?>
                </ul></div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= esc(old('username')) ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
