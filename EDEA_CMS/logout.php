<?php 

if (!isset($_SESSION)) {
    session_start();
}

unset($_SESSION["currentUser"]);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"?>
<?php $title = "Logout"; include "include/head.php"?>
<body>
    <?php include "include/header-nav.php"?>
    <main>
        <h1>Logget ud.</h1>
        <p>Du er nu logget ud!</p>
    </main>
    <?php include "include/footer.php"?>
</body>
</html>