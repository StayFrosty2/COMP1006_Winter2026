<?php
// Connect to the server
require("connect.php");

// Check if an id is set, if not, send the user back to the homepage
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

// Get the ID for the page
$id = $_GET["id"];

// Runs when the user submits their edit, runs an SQL script to update the review and sends them back to the admin page
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Grab form data and sanitize
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_NUMBER_INT);
    $text = filter_input(INPUT_POST, "review_text", FILTER_SANITIZE_SPECIAL_CHARS);

    // Empty array to catch errors
    $errors = [];

    // If any of the data is null or missing, add an error to the error array
    if ($title === null || $title === "") {
        $errors[] = "Title is Required";
    }
    if ($author === null || $author === "") {
        $errors[] = "Author is Required";
    }
    if ($rating === null || $rating === "") {
        $errors[] = "Rating is Required";
    }
    if ($text === null || $text === "") {
        $errors[] = "Review Text is Required";
    }

    if (!empty($errors)) {
        echo "<title>ERROR</title>";
        echo "<p>An error occured, please fix the following:</p>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='index.php'>Return to Homepage</a>";
        exit;
    }

    // SQL Query
    $sql = "
        update book_manager.reviews
        set title = :title, author = :author, rating = :rating, review_text = :text
        where id = :id;
    ";

    // Prepare Query
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":author", $author);
    $stmt->bindParam(":rating", $rating, PDO::PARAM_INT);
    $stmt->bindParam(":text", $text);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    // Execute Query
    $stmt->execute();
}

// Creates and executes and SQL script to get the content of a specific post
$sql = "SELECT * FROM book_manager.reviews WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

// Attempts to get the posts content and set it to a variable
$re = $stmt->fetch();

// If the post does not exist, kill the page
if (!$re) {
    die("Review not found.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Review Submission | Update</title>
</head>

<body>
    <h1>Edit a Book Review</h1>

    <form action="process.php" method="POST">

        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title">

        <label for="author">Author:</label>
        <input type="text" id="author" name="author">

        <label for="rating">Rating (1 to 5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5">

        <label for="review_text">Review:</label>
        <textarea id="review_text" name="review_text" rows="6" cols="40"></textarea>

        <button type="submit">Submit Review</button>

    </form>
</body>

</html>