<?php include "includes/header.php" ?>
<main>
    <h2>Contact Us</h2>
    <form action="submit.php" method="post">
        <!-- User Information -->
        <fieldset>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Write your message here:</label>
            <textarea id="message" name="message" rows="5" minlength="10" required></textarea>
        </fieldset>
        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</main>
<?php include "includes/footer.php" ?>