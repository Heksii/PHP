<?php
session_start();

$db = new mysqli("localhost", "casp196b_edea_admin", "fg}LrBz%p4h}sp@W8l", "casp196b_edea");
$userData = $db->query("SELECT * FROM users WHERE username = '{$_SESSION["currentUser"]}'");

function ValidateUser($db)
{
    $user = $_SESSION["newUserData"];

    if (!isset($user)) {
        $_SESSION["registerErrors"][] = "Fejl.";
        return;
    }

    // Tjek om en bruger med det indtastede navn allerede findes.
    $usernameCheckQueryResult = $db->query("SELECT COUNT(*) FROM `users` WHERE username = '{$user["name"]}' ");
    if ($usernameCheckQueryResult->fetch_assoc()["COUNT(*)"] > 0) {
        $_SESSION["registerErrors"][] = "Brugeren <strong>{$user["name"]}</strong> findes allerede.";
    }

    // ^\w{3,}$ -- Mindst 3 tægn om enten er bogstaver, tal eller underscores.
    if (!(isset($user["name"]) and preg_match("/^\w{3,}$/", $user["name"]))) {
        $_SESSION["registerErrors"][] = "Brugernavn skal mindst have <strong>3</strong> karakterer.";
    }

    // ^\S{8,}+$ -- Mindst 8 tægn hvor ingen af dem er whitespace.
    if (!(isset($user["password"]) and preg_match("/^\S{8,}+$/", $user["password"]))) {
        $_SESSION["registerErrors"][] = "Kodeord skal mindst have <strong>8</strong> karakterer.";
    }

    if (!(isset($user["password-repeat"]) and $user["password"] == $user["password-repeat"])) {
        $_SESSION["registerErrors"][] = "Gentag Adgangskode fælt passer ikke.";
    }

    if (isset($user["country"]) and strtolower($user["country"]) == "danmark") {

        // ^\d{4}$ -- 4 tal.
        if (!isset($user["zipcode"]) or !preg_match("/^\d{4}$/", $user["zipcode"])) {
            $_SESSION["registerErrors"][] = "Ugyldigt postnummer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php 

$title = "Min Konto - EDEA";
include "include/head.php" 

?>
<body>
    <?php include "include/header-nav.php" ?>
    <main>
        
    </main>
    <?php include "include/footer.php" ?>
</body>