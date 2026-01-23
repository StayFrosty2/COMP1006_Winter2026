<header>
    <h1> Welcome! </h1>

    <nav>
        <ul>
            <?php
            // The would-be clickable links were this an actual websites navigation menu
            $items = ["Home", "About", "Contact"];


            // Includes the following HTML after the foreach in the document to build the website's navigation menu
            foreach ($items as $item):
            ?>
                <li><?= $item ?></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>