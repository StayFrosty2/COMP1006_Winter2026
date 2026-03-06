<?php
// Connects to the database
require("connect.php");

// If the server request method is not post, kill the page
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Request");
}

// Grab form data and sanitize
$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
$author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
$rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_NUMBER_INT);
$text = filter_input(INPUT_POST, "review_text", FILTER_SANITIZE_SPECIAL_CHARS);

// Empty array to catch errors
$errors = [];

// If any of the data is null or missing, add an error to the error array
if ($title === null || $title === "") {
    $errors[] = "Username is Required";
}
if ($author === null || $author === "") {
    $errors[] = "Username is Required";
}
if ($rating === null || $rating === "") {
    $errors[] = "Username is Required";
}
if ($text === null || $text === "") {
    $errors[] = "Username is Required";
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
    insert into reviews
    values (:title, :author, :rating, :text);
";

// Prepare Query
$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(":title", $title);
$stmt->bindParam(":author", $author);
$stmt->bindParam(":rating", $rating);
$stmt->bindParam(":text", $text);

// Execute Query
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Review Submission | Post Successful</title>
</head>

<body>
    <p>Your review was posted successfully.</p>
    <a href="index.php">Return to Homepage</a>
</body>

</html>