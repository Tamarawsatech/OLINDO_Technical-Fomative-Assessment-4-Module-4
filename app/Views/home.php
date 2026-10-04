<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f8;
            color: #222;
        }

        nav {
            background: #123b63;
            padding: 15px;
        }

        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
        }

        main {
            background: white;
            margin-top: 20px;
            padding: 30px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?= view('partials/navigation') ?>

    <main>
        <h1>Point-of-Sale System</h1>
        <p>Welcome to the first version of my CodeIgniter 4 POS application.</p>
        <p>Use the navigation links to view the customer and user accounts.</p>
    </main>
</body>
</html>
