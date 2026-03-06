<?php
    // Connects to the database
    require("connect.php");

    // If the server request method is not post, kill the page
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Invalid Request");
    }

    // Grab form data and sanitize
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
    $rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_NUMBER_INT);
    $text = filter_input(INPUT_POST, "review_text", FILTER_SANITIZE_SPECIAL_CHARS);

    // Empty array to catch errors
    $errors = [];

    

?>