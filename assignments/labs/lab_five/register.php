<?php
require "includes/connect.php";

$errors = [];

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($username === '') {
        $errors[] = "Username is required.";
    }

    if ($password === '') {
        $errors[] = "Password is required.";
    }

    if ($confirmPassword === '') {
        $errors[] = "Please confirm your password.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (empty($errors)) {

        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetch()) {
            $errors[] = "That username is already in use.";
        }
    }
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password)
                VALUES (:username,:password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        $success = "Account created.";
    }
}
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
        <main class="container mt-4">
            <h2>Sign Up</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <h3>Please fix the following:</h3>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($success !== ""): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success); ?>
                    <br>
                    <a href="login.php" class="btn btn-sm btn-success mt-2">Go to Login</a>
                </div>
            <?php endif; ?>
            <form method="post" class="mt-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control mb-3"
                    value="<?= htmlspecialchars($username ?? ''); ?>"
                    required>
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control mb-3"
                    required>
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    class="form-control mb-4"
                    required>
                <button type="submit" class="btn btn-primary">Create Account</button>
                <a href="login.php" class="btn btn-secondary">Login Instead</a>
            </form>
        </main>
    </body>
</html>