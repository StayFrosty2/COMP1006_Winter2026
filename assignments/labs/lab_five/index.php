<?php
require "includes/connect.php";

// Get all users and show their pfps (no way to do this without)
$sql = "SELECT * FROM lab_5.users11 ORDER BY created_at ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <header>
        <h1>Novachat</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="upload.php">Upload a Profile Picture</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (empty($users)): ?>
            <p>No users yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($users as $user): ?>
                    <li>
                        <p>ID: <?= htmlspecialchars($user['user_id']); ?></p>
                        <p>Name: <?= htmlspecialchars($user['username']); ?></p>
                        <?php if (!empty($user['image_path'])): ?>
                            <img
                                src="<?= htmlspecialchars($user['image_path']); ?>"
                                class="profile-picture"
                                alt="<?= htmlspecialchars($user['username']); ?>'s Profile Picture">
                        <?php else: ?>
                            <p>(No Profile Picture Set)</p>
                        <?php endif; ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif; ?>
    </main>
</body>

</html>