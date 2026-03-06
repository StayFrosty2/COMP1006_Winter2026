<?php

// Connects to the database
require("connect.php");

// Check if an id is set, if not, send the user back to the homepage
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

// Get the id from the url
$id = $_GET["id"];

// create and run an sql script to delete the post from the server
$sql = "DELETE FROM book_manager.reviews WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

// Return the user to the admin page and exit
header("Location: admin.php");
exit();
