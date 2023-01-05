<?php
session_start();

$db = new mysqli("localhost", "casp196b_edea_admin", "fg}LrBz%p4h}sp@W8l", "casp196b_edea");
$userDataQueryResult = $db->query("SELECT * FROM users WHERE username = '{$_SESSION["currentUser"]}'");

if ($db->error) {
    die();
}

$userData = $userDataQueryResult->fetch_assoc();

function ValidateUser($db)
{
    $user = $_SESSION["newUserData"];

    if (!isset($user)) {
        $_SESSION["errors"][] = "Fejl.";
        return;
    }

    // Tjek om en bruger med det indtastede navn allerede findes.
    $usernameCheckQueryResult = $db->query("SELECT COUNT(*) FROM `users` WHERE username = '{$user["name"]}' ");
    if ($usernameCheckQueryResult->fetch_assoc()["COUNT(*)"] > 0) {
        $_SESSION["errors"][] = "Brugeren <strong>{$user["name"]}</strong> findes allerede.";
    }

    // ^\w{3,}$ -- Mindst 3 tægn om enten er bogstaver, tal eller underscores.
    if (!(isset($user["name"]) and preg_match("/^\w{3,}$/", $user["name"]))) {
        $_SESSION["errors"][] = "Brugernavn skal mindst have <strong>3</strong> karakterer.";
    }

    // ^\S{8,}+$ -- Mindst 8 tægn hvor ingen af dem er whitespace.
    if (!(isset($user["password"]) and preg_match("/^\S{8,}+$/", $user["password"]))) {
        $_SESSION["errors"][] = "Kodeord skal mindst have <strong>8</strong> karakterer.";
    }

    if (!(isset($user["password-repeat"]) and $user["password"] == $user["password-repeat"])) {
        $_SESSION["errors"][] = "Gentag Adgangskode fælt passer ikke.";
    }

    if (isset($user["country"]) and strtolower($user["country"]) == "danmark") {

        // ^\d{4}$ -- 4 tal.
        if (!isset($user["zipcode"]) or !preg_match("/^\d{4}$/", $user["zipcode"])) {
            $_SESSION["errors"][] = "Ugyldigt postnummer.";
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
    <h1>Min Konto</h1>
        <section>
            <?print_r($userData)?>
            <ul class="error-box <?php echo count($_SESSION["errors"]) == 0 ?: "has-errors" ?>">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    foreach ($_SESSION["errors"] as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                }
                ?>
            </ul>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" readonly>
                <label for="username">Brugernavn:</label>
                <input type="text" name="name" value="<?=$userData["username"]?>" placeholder="Brugernavn" required>

                <label for="password">Adgangskode:</label>
                <input type="text" name="password" value="<?=$userData["password"]?>" placeholder="Adgangskode" required>

                <label for="first-name">Fornavn:</label>
                <input type="text" name="first-name" value="<?=$userData["firstname"]?>" placeholder="Fornavn" required>

                <label for="last-name">Efternavn:</label>
                <input type="text" name="last-name" value="<?=$userData["lastname"]?>" placeholder="Efternavn" required>

                <label for="address">Adresse:</label>
                <input type="text" name="address" value="<?=$userData["adresse"]?>" placeholder="Adresse" required>

                <label for="zipcode">Postnummer:</label>
                <input type="text" name="zipcode" value="<?=$userData["zipcode"]?>" placeholder="Postnummer" required>

                <label for="city">By:</label>
                <input type="text" name="city" value="<?=$userData["city"]?>" placeholder="By" required>

                <label for="country">Land:</label>
                <input type="text" name="country" value="<?=$userData["country"]?>" placeholder="Land" required>

                <label for="mail">Mail-adresse:</label>
                <input type="text" name="mail" value="<?=$userData["mail"]?>" placeholder="Mail-adresse" required>

                <label for="phone">Telefonnummer:</label>
                <input type="text" name="phone" value="<?=$userData["phonenumber"]?>" placeholder="Telefonnummer">

                <label for="gender">Køn:</label>
                <select name="gender">
                    <option value="unset">Vælger ikke at oplyse</option>
                    <option value="male">Mand</option>
                    <option value="female">Kvinde</option>
                    <option value="other">Ikke-binær / Andet</option>
                </select>

                <label for="age">Alder:</label>
                <input type="text" name="age" value="<?=$_SESSION["userToValidate"]["age"]?>" placeholder="Alder">

                <input type="submit" value="Rediger">
            </form>
        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>