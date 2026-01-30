<?php include "includes/header.php" ?>
<main>
    <h2>Contact Us</h2>
    <form action="submit.php" method="post">
        <!-- User Information -->
        <fieldset>
            <legend>Customer Information</legend>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" >
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email">
            <label for="message">Write your message here:</label>
            <input type="text" id="message" name="message">
        </fieldset>
        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</main>
<?php include "includes/footer.php" ?>