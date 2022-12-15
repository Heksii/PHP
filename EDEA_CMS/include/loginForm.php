<?php
session_start();

$_SESSION["loginErrors"] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["userToValidate"] = $_POST;
    ValidateUser();

    if (count($_SESSION["loginErrors"]) == 0) {
        $_SESSION["user"] = [
            "name" => $_SESSION["userToValidate"]["name"],
            "password" => $_SESSION["userToValidate"]["password"],
        ];
        unset($_SESSION["userToValidate"]);
        print_r($_SESSION);

        echo '<script>window.location.replace("index.php")</script>';
        //header("Location: loginLanding.php");
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
    <input type="text" name="name" placeholder="Brugernavn" required>

    <label for="password">Adgangskode:</label>
    <input type="text" name="password" placeholder="Adgangskode" required>

    <input type="submit" value="Log in">
</form>
