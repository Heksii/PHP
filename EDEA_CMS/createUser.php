<?php
session_start();

$_SESSION["registerErrors"] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["userToValidate"] = $_POST;
    ValidateUser();

    if (count($_SESSION["registerErrors"]) == 0) {
        $_SESSION["user"] = $_SESSION["userToValidate"];
        unset($_SESSION["userToValidate"]);

        header("Location: createUserLanding.php");
    }
}

function ValidateUser()
{
    $user = $_SESSION["userToValidate"];

    if (!isset($user)) {
        $_SESSION["registerErrors"][] = "Fejl.";
        return;
    }

    // ^\w{3,}$ -- Mindst 3 tægn om enten er bogstaver, tal eller underscores.
    if (!(isset($user["name"]) and preg_match("/^\w{3,}$/", $user["name"]))) {
        $_SESSION["registerErrors"][] = "Brugernavn skal mindst have 3 karakterer.";
    }

    // ^\S{8,}+$ -- Mindst 8 tægn hvor ingen af dem er whitespace.
    if (!(isset($user["password"]) and preg_match("/^\S{8,}+$/", $user["password"]))) {
        $_SESSION["registerErrors"][] = "Kodeord skal mindst have 8 karakterer.";
    }

    if (!(isset($user["password-repeat"]) and $user["password"] == $user["password-repeat"])) {
        $_SESSION["registerErrors"][] = "Gentag kodeord fælt passer ikke.";
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
<?php $title = "Opret Bruger - EDEA";
include "include/head.php" ?>

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
                <input type="text" name="name" placeholder="Brugernavn" required>

                <label for="password">Adgangskode:</label>
                <input type="text" name="password" placeholder="Adgangskode" required>

                <label for="password-repeat">Gentag Adgangskode:</label>
                <input type="text" name="password-repeat" placeholder="Gentag Adgangskode" required>

                <label for="first-name">Fornavn:</label>
                <input type="text" name" name="first-name" placeholder="Fornavn" required>

                <label for="last-name">Efternavn:</label>
                <input type="text" name" name="last-name" placeholder="Efternavn" required>

                <label for="address">Adresse:</label>
                <input type="text" name="address" placeholder="Adresse" required>

                <label for="zipcode">Postnummer:</label>
                <input type="text" name="zipcode" placeholder="Postnummer" required>

                <label for="city">By:</label>
                <input type="text" name="city" placeholder="By" required>

                <label for="country">Land:</label>
                <input type="text" name="country" placeholder="Land" required>

                <label for="mail">Mail-adresse:</label>
                <input type="text" name="mail" placeholder="Mail-adresse" required>

                <label for="phone">Telefonnummer:</label>
                <input type="text" name="phone" placeholder="Telefonnummer">

                <label for="gender">Køn:</label>
                <select name="gender">
                    <option value="unset">Vælger ikke at oplyse</option>
                    <option value="male">Mand</option>
                    <option value="female">Kvinde</option>
                    <option value="other">Ikke-binær / Andet</option>
                </select>

                <label for="age">Alder:</label>
                <input type="text" name="age" placeholder="Alder">

                <input type="submit" value="Opret">
            </form>
        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>