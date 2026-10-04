<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Users</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><style>.avatar{width:60px;height:60px;object-fit:cover}</style></head>
<body class="bg-light"><div class="container py-5"><?= view('partials/navigation') ?>
<div class="d-flex justify-content-between align-items-center mb-4"><h1>User Accounts</h1><div><a href="<?= site_url('customers') ?>" class="btn btn-outline-secondary">Customers</a> <a href="<?= site_url('users/new') ?>" class="btn btn-primary">Add User</a></div></div>
<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div><?php endif; ?>
<div class="card shadow-sm"><div class="card-body p-0"><div class="table-responsive"><table class="table table-striped table-hover align-middle mb-0"><thead><tr><th>Avatar</th><th>Username</th><th>Full Name</th><th>Actions</th></tr></thead><tbody>
<?php if (empty($users)): ?><tr><td colspan="4" class="text-center py-4">No users found.</td></tr><?php endif; ?>
<?php foreach ($users as $user): ?><?php $avatarUrl = ! empty($user['avatar']) ? base_url('uploads/avatars/' . $user['avatar']) : base_url('images/default-avatar.png'); ?><tr><td><img src="<?= esc($avatarUrl) ?>" alt="<?= esc($user['full_name']) ?> avatar" class="avatar rounded-circle border"></td><td><?= esc($user['username']) ?></td><td><?= esc($user['full_name']) ?></td><td><a href="<?= site_url('users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">Edit</a></td></tr><?php endforeach; ?>
</tbody></table></div></div></div></div></body></html>
