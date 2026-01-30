<?php 
    include "includes/header.php";

    // Get information from user and sanitize
    $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

    // Validation - Serverside

    $errors[] = [];

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

?>