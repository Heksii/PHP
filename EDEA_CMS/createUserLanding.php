<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>
<?php $title = "Logout";
include "include/head.php" ?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <h1>Velkommen til, <?= $_SESSION["currentUser"] ?>.</h1>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>