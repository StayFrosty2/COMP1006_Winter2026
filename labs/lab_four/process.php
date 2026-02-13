<?php
// Connect to the database
require "includes/connect.php";

// Grab form data
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// SQL Query
$sql = "
    insert into subscribers (first_name, last_name, email)
    values (:first_name, :last_name, :email)
";

// Prepare Query
$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(":first_name", $firstName);
$stmt->bindParam(":last_name", $lastName);
$stmt->bindParam(":email", $email);

// Execute Query
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->
        <p>Thank you for subscribing, <?=  htmlspecialchars($firstName) ?>. You'll be notified when we post new content at <?= htmlspecialchars($email) ?></p>

        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>