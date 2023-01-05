<?php
if (!isset($_SESSION)) {
    session_start();
}

$db = new mysqli("localhost", "casp196b_edea_admin", "fg}LrBz%p4h}sp@W8l", "casp196b_edea");
$_SESSION["registerErrors"] = [];
$_SESSION["userToValidate"] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["userToValidate"] = $_POST;
    ValidateUser($db);
    
    if (count($_SESSION["registerErrors"]) == 0) {
        $user = $_SESSION["userToValidate"];

        InsertUserInDb($db, $_SESSION["userToValidate"]);

        if (!$db->error) {
            $_SESSION["currentUser"] = $user["name"];

            unset(
                $_SESSION["userToValidate"], 
                $_SESSION["registerErrors"],
            );
            print_r($user);
            echo "INSERT INTO users (username, password, firstname, lastname, adresse, zipcode, city, country, mail, phonenumber, gender) VALUES ('{$user["name"]}','{$user["password"]}','{$user["first-name"]}','{$user["last-name"]}','{$user["address"]}','{$user["zipcode"]}','{$user["city"]}','{$user["country"]}','{$user["mail"]}','{$user["phone"]}','{$user["gender"]}')";
            //header("Location: createUserLanding.php");
        }
        else {
            $_SESSION["registerErrors"][] = "Kunne ikke gemme bruger i databasen.\n" . $db->error;
        }
    }
}

function InsertUserInDb($db, $user)
{
    return $db->query("INSERT INTO users (username, password, firstname, lastname, adresse, zipcode, city, country, mail, phonenumber, gender) VALUES ('{$user["name"]}','{$user["password"]}','{$user["first-name"]}','{$user["last-name"]}','{$user["address"]}','{$user["zipcode"]}','{$user["city"]}','{$user["country"]}','{$user["mail"]}','{$user["phone"]}','{$user["gender"]}')");
}
function ValidateUser($db)
{
    $user = $_SESSION["userToValidate"];

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

$title = "Opret Bruger - EDEA";
include "include/head.php" 

?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <h1>Opret Bruger</h1>
        <section>
            <ul class="error-box <?php echo count($_SESSION["registerErrors"]) == 0 ?: "has-errors" ?>">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    foreach ($_SESSION["registerErrors"] as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                }
                ?>
            </ul>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="username">Brugernavn:</label>
                <input type="text" name="name" value="<?=$_SESSION["userToValidate"]["name"]?>" placeholder="Brugernavn" required>

                <label for="password">Adgangskode:</label>
                <input type="text" name="password" value="<?=$_SESSION["userToValidate"]["password"]?>" placeholder="Adgangskode" required>
 
                <label for="password-repeat">Gentag Adgangskode:</label>
                <input type="text" name="password-repeat" value="<?=$_SESSION["userToValidate"]["password-repeat"]?>" placeholder="Gentag Adgangskode" required>

                <label for="first-name">Fornavn:</label>
                <input type="text" name="first-name" value="<?=$_SESSION["userToValidate"]["first-name"]?>" placeholder="Fornavn" required>

                <label for="last-name">Efternavn:</label>
                <input type="text" name="last-name" value="<?=$_SESSION["userToValidate"]["last-name"]?>" placeholder="Efternavn" required>

                <label for="address">Adresse:</label>
                <input type="text" name="address" value="<?=$_SESSION["userToValidate"]["address"]?>" placeholder="Adresse" required>

                <label for="zipcode">Postnummer:</label>
                <input type="text" name="zipcode" value="<?=$_SESSION["userToValidate"]["zipcode"]?>" placeholder="Postnummer" required>

                <label for="city">By:</label>
                <input type="text" name="city" value="<?=$_SESSION["userToValidate"]["city"]?>" placeholder="By" required>

                <label for="country">Land:</label>
                <input type="text" name="country" value="<?=$_SESSION["userToValidate"]["country"]?>" placeholder="Land" required>

                <label for="mail">Mail-adresse:</label>
                <input type="text" name="mail" value="<?=$_SESSION["userToValidate"]["mail"]?>" placeholder="Mail-adresse" required>

                <label for="phone">Telefonnummer:</label>
                <input type="text" name="phone" value="<?=$_SESSION["userToValidate"]["phone"]?>" placeholder="Telefonnummer">

                <label for="gender">Køn:</label>
                <select name="gender">
                    <option value="unset">Vælger ikke at oplyse</option>
                    <option value="male">Mand</option>
                    <option value="female">Kvinde</option>
                    <option value="other">Ikke-binær / Andet</option>
                </select>

                <label for="age">Alder:</label>
                <input type="text" name="age" value="<?=$_SESSION["userToValidate"]["age"]?>" placeholder="Alder">

                <input type="submit" value="Opret">
            </form>
        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>