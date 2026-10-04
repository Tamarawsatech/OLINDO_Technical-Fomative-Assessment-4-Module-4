<nav class="mb-4">
    <a href="<?= site_url('/') ?>">Home</a> |
    <a href="<?= site_url('about') ?>">About</a> |
    <a href="<?= site_url('customers') ?>">Customers</a> |
    <a href="<?= site_url('users') ?>">Users</a> |
    <?php if (session()->get('isLoggedIn')): ?>
        <span>Signed in as <?= esc(session()->get('fullName')) ?></span> |
        <a href="<?= site_url('logout') ?>">Logout</a>
    <?php else: ?>
        <a href="<?= site_url('login') ?>">Login</a>
    <?php endif; ?>
</nav>
