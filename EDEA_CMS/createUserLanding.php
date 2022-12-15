<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["user"] = $_POST;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>
<?php $title = "Logout";
include "include/head.php" ?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <h1>Velkommen til, <?= $_SESSION["user"]["name"] ?>. Du kan logge ind her:</h1>
        <section>
            <?php include "include/loginForm.php" ?>
        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>