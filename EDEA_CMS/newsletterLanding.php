<?php
session_start();
$newsletterUser = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsletterUser = $_POST;
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
        <h1>Nyhedsbrev</h1>
        <p>Kære <?php echo $newsletterUser["name"]; ?> Du er nu tilmeldt vores nyhedsbrev. Vi glæder os til hver måned at bringe dig spændende nyheder far kunstskøjteløbets verden. Husk, at du altid kan afmelde dig nyhedsbrevet igen ved at følge linket i bunden af nyhedsbrevet. Med venlig hilsen di Edea team.</p>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>