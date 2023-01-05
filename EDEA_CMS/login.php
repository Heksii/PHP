<?php
if (!isset($_SESSION)) {
    session_start();
}

$db = new mysqli("localhost", "casp196b_edea_admin", "fg}LrBz%p4h}sp@W8l", "casp196b_edea");
$_SESSION["loginErrors"] = [];
$_SESSION["userToValidate"] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["userToValidate"] = $_POST;
    ValidateUser();

    if (count($_SESSION["loginErrors"]) == 0) {

        $user = $_SESSION["userToValidate"];

        $passwordQueryResult = $db->query("
        SELECT password 
        FROM users 
        WHERE username = '{$_SESSION["userToValidate"]["name"]}'
        ")->fetch_assoc();

        if (!$db->error) {
            $password = $passwordQueryResult["password"];

            if ($password != $user["password"]) {
                $_SESSION["loginErrors"][] = "Forkert brugernavn eller kodeord.";
            } else {
                $_SESSION["currentUser"] = $user["name"];

                unset(
                    $_SESSION["userToValidate"],
                    $_SESSION["loginErrors"],
                    $_SESSION["user"]
                );

                header("Location: loginLanding.php");
            }
        } else {
            $_SESSION["loginErrors"][] = "Forkert brugernavn eller kodeord.";
        }
    }
}

function ValidateUser()
{
    $user = $_SESSION["userToValidate"];

    if (!isset($user)) {
        $_SESSION["loginErrors"][] = "Fejl.";
        return;
    }

    // ^\w{3,}$ -- Mindst 3 tægn som enten er bogstaver, tal eller underscores.
    if (!(isset($user["name"]) and preg_match("/^\w{3,}$/", $user["name"]))) {
        $_SESSION["loginErrors"][] = "Brugernavn skal mindst have 3 karakterer.";
    }

    // ^\S{8,}+$ -- Mindst 8 tægn hvor ingen af dem er whitespace.
    if (!(isset($user["password"]) and preg_match("/^\S{8,}+$/", $user["password"]))) {
        $_SESSION["loginErrors"][] = "Kodeord skal mindst have 8 karakterer.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php

$title = "Login - Edea";
include "include/head.php";

?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <h1>Login</h1>
        <section>
            <ul class="error-box <?php echo count($_SESSION["loginErrors"]) == 0 ?: "has-errors" ?>">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    foreach ($_SESSION["loginErrors"] as $error) {
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

                <input type="submit" value="Log in">
            </form>

        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>