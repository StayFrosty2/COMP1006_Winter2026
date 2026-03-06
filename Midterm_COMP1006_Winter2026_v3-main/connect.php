<!-- connects to the database -->
<?php
$host = "localhost"; // hostname
$db = "book_manager"; // database
$user = "root"; // user is root
$password = ""; // password is nothing

// Points to the database
$dsn = "mysql:host$host;dbname=$db";

// Try to connect, on failure display a message
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Database connection failed, could not generate posts: " . $e->getMessage());
}
?>