<?php

// Connects to the database
require("connect.php");

// Placeholder
$reviews = [];

// Get all posts
$sql = "SELECT * FROM book_manager.reviews";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$reviews = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Review Submission | Admin</title>
</head>
<body>
    <h1>Admin Page</h1>
    <main>
        <!-- If there are no reviews, display a message, else display all reviews -->
        <?php if (empty($reviews)): ?>
            <p>No reviews yet</p>
        <?php else: ?>
            <div>
                <?php foreach ($reviews as $re): ?>
                    <section>
                        <h3><?= htmlspecialchars($re["title"]); ?></h3>
                        <p><em>Created On:<?= htmlspecialchars($re["created_at"]); ?></em></p>
                        <p>Author: <?=  htmlspecialchars($re["author"]); ?></p>
                        <p>Rating: <?=  htmlspecialchars($re["rating"]); ?></p>
                        <p>Review Text:<br>"<?=  htmlspecialchars($re["review_text"]); ?>"</p>
                        <h5> <!-- Empty h5 for spacing --> </h5>
                        <a href="update.php?id=<?= urlencode($re["id"]); ?>">Edit Review</a>
                        <a href="delete.php?id=<?= urlencode($re["id"]); ?>" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <a href="index.php">Return to Homepage</a>
</body>