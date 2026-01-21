<?php
$items = ["Home", "About", "Contact"];
include 'includes/header.php';
?>

<ul>
<?php foreach ($items as $item): ?>
    <li><?= $item ?></li>
<?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>