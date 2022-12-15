<?php
if (!isset($_SESSION)) {
    session_start();
}

echo session_status();
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = "Logout";
include "include/head.php" ?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <pre>
            <?php
            print_r($_SESSION);
            ?>
        </pre>
        <h1>Du er nu logget ind.</h1>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>