<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
*/

/* 
    First, move the items into a seperate section. Including them at the top like this is convient, but becomes tedious. I moved them to
    a seperate PHP file alongside the navigation, as they are only used for that one thing, and will be included on other pages as well.
*/
?>

<!DOCTYPE html>
<html>

<head>
    <title>My PHP Page</title>
</head>

<body>
    <!--
        The entire header is now a couple lines in this document. The H1 and Navigation would be included on every page of this website, so it
        makes sense for them to be easy to incorporate on every page. What's more is that it's now easier to edit them as the page gains more
        and more content, and is divided up into further sections.
    -->

    <?php
    include "nav.php";
    ?>

    <main>
        <!-- CONTENT WOULD GO HERE -->
    </main>

    <footer>
        <p>&copy; 2026</p>
    </footer>

</body>

</html>