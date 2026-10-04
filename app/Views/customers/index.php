<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Customers</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-5"><?= view('partials/navigation') ?>
<div class="d-flex justify-content-between align-items-center mb-4"><h1>Customers</h1><div><a href="<?= site_url('users') ?>" class="btn btn-outline-secondary">Users</a> <a href="<?= site_url('customers/new') ?>" class="btn btn-primary">Add Customer</a></div></div>
<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div><?php endif; ?>
<div class="card shadow-sm"><div class="card-body p-0"><div class="table-responsive"><table class="table table-striped table-hover mb-0"><thead><tr><th>Full Name</th><th>Email Address</th><th>Phone Number</th><th>Actions</th></tr></thead><tbody>
<?php if (empty($customers)): ?><tr><td colspan="4" class="text-center py-4">No customers found.</td></tr><?php endif; ?>
<?php foreach ($customers as $customer): ?><tr><td><?= esc($customer['full_name']) ?></td><td><?= esc($customer['email']) ?></td><td><?= esc($customer['phone'] ?? '—') ?></td><td><a href="<?= site_url('customers/edit/' . $customer['id']) ?>" class="btn btn-sm btn-warning">Edit</a></td></tr><?php endforeach; ?>
</tbody></table></div></div></div></div></body></html>
