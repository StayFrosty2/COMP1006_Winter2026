<?php 
require "includes/header.php";
// access the form data and then echo on the screen in a confirmation message

// $firstName = $_POST["first_name"];
// $lastName = $_POST["last_name"];
// $address = $_POST["address"];
// $email = $_POST["email"];
// $items = $_POST["items"];

// A better method, including data sanitization:

// Grab the data, clear, and store in a variable
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$items = $_POST['items'] ?? [];

// Validation Time - Serverside

$errors = [];

//require text fields
if ($firstName == null || $firstName == '') {
    $errors[] = "First Name is Required.";
}

if ($lastName == null || $lastName == '') {
    $errors[] = "Last Name is Required.";
}

// email validation

if ($email == null || $email == "") {
    $errors[] = "Email is Required.";
}
elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $errors[] = "Email must be a valid email.";
}

// address validation

if ($address == null || $address == '') {
    $errors[] = "Address is required.";
}

$itemsOrdered = [];

// check that the order quantity is a number

foreach($items as $item => $quantity) {
    if(filter_var($quantity, FILTER_VALIDATE_INT) != false && $quantity > 0) {
        $itemsOrdered[$item] = $quantity;
    }
}

if(count($itemsOrdered) == 0) {
    $errors[] = "Please order at least one item.";
}

if(!empty($errors)) {
    foreach ($errors as $error): ?>
    <li><?php echo $error; ?></li>
    <?php endforeach;
    exit;
}


// if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo "<p>Email Entered was Validated!</p>";
// }
// else {
//     echo "<p><strong>WARNING:</strong> The email you entered was invalid, order may not have been sent correctly</p>";
// }


?>
<main>
    <?php echo "<h2>Thanks for your order " . $firstName . "</h2>"; ?>
    <h3>Your Receipt:</h3>
    <ul>
    <?php foreach($items as $item => $quantity): ?>
        <li><?php echo $item ?> - <?php echo $quantity ?> </li>
    <?php endforeach; ?>
    </ul>
</main>

<!-- send email using mail function -->
<!-- mail($to, $subject, $message); -->

<?php require "includes/footer.php"; ?>