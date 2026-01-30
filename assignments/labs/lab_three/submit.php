<?php 
    include "includes/header.php";

    // Get information from user and sanitize
    $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validation - Serverside

    $errors = [];

    // Ensure First and Last Name have a value

    if($firstName == null || $firstName == "") {
        $errors[] = "First Name is Required.";
    }
    if($lastName == null || $lastName == "") {
        $errors[] = "Last Name is Required.";
    }

    // Ensure Email has a value, and is a valid email

    if($email == null || $email == "") {
        $errors[] = "Email Address is required";
    }
    else if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = "Email Address is invalid, please enter a valid email.";
    }

    // Ensure Message has a value and is at least 10 characters (prevents spam messages)

    if($message == null || $message == "") {
        $errors[] = "No message indicated, please enter a message before submitting.";
    }
    else if(strlen($message) < 10) {
        $errors[] = "Message is too short, please do not enter messages under 10 characters (This is to prevent spam messages)";
    }

    if(!(empty($errors))) {
        foreach($errors as $error): ?>
        <li><?php echo $error; ?> </li>
        <?php endforeach;
        echo '<a href="contact.php">Return To Contact Page</a>';
        exit;
    }
?>

<main>
    <?php echo "<h2>Thank You " . $firstName . "</h2>"?>
    <p>Someone will email you back with an answer soon!</p>
    <a href="index.php">Return to main page</a>
</main>

<?php include "includes/footer.php" ?>