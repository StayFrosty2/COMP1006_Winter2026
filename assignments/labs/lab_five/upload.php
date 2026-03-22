<?php
session_start();

// Sends the user back to the login if they aren't signed in properly
if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
    exit();
}

require "includes/connect.php";

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_SESSION["username"];
    $userId = $_SESSION["user_id"];

    $imagePath = null;

    if ($username === '') {
        $errors[] = "No username specified.";
    }

    if ($userId === null || $userId < 0) {
        $errors[] = "No user id specified.";
    }

    if(isset($_FILES['pfp']) && $_FILES['pfp']['error'] !== UPLOAD_ERR_NO_FILE) {
        if($_FILES['pfp']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "There was a problem uploading your file!";
        }
        else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            $detectedType = mime_content_type($_FILES['pfp']['tmp_name']);

            if(!in_array($detectedType, $allowedTypes, true)) {
                $errors[] = "Only .jpeg, .jpg, .webp, and .png files are allowed.";
            }
            else {
                $extension = pathinfo($_FILES['pfp']['username'], PATHINFO_EXTENSION);
                $safeFilename = uniqid('pfp_', true) . "." . strtolower($extension);
                $destination = __DIR__ . '\\uploads\\' . $safeFilename;
                if(move_uploaded_file($_FILES['pfp']['tmp_name'], $destination)) {
                    $imagePath = 'uploads\\' . $safeFilename;
                }
                else {
                    $errors[] = "Image upload failed!";
                }
            }
        }
    }
    if (empty($errors)) {
        $sql = "UPDATE users11 (image_path)
                SET (:image_path)
                WHERE user_id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $success = "Profile Picture added successfully!";
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
            <h1>Add Product</h1>

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
                    <a href="index.php">Return to main page</a>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="mt-3">

                <label for="pfp" class="form-label">Product Image</label>
                <input
                    type="file"
                    id="pfp"
                    name="pfp"
                    class="form-control mb-4"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <button type="submit" class="btn btn-primary">Add PFP</button>
            </form>
        </main>
    </body>
</html>