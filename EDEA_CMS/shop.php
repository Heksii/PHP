<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<?php $title = "Produkter - EDEA"; include "include/head.php"?>
<body>
    <?php include "include/header-nav.php"?>
    <main>
        <h1>EDEA Shop</h1>
        <article id="cards">
            <?
            $productCount = 1000;
            include("include/productDisplay.php") 
            ?>
        </article>
    </main>
    <?php include "include/footer.php"?>
</body>
</html>