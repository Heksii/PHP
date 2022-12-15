<?php session_start(); ?>

<header>
    <a href="#">
        <img src="img/FacebookIcon-bw.png" alt="Facebook logo">
    </a>
    <a href="#">
        <img src="img/InstagramIcon-bw.png" alt="Instagram logo">
    </a>
    <a href="#">
        <img src="img/TwitterIcon-bw.png" alt="Twitter logo">
    </a>
    <a href="#">
        <img src="img/YoutubeIcon-bw.png" alt="YouTube logo">
    </a>
    <div class="grow"></div>
    <?php
    print_r($_SESSION["user"]);
    if (isset($_SESSION["user"])) {
        echo '<p>Velkommmen, ' . $_SESSION["user"]["name"] . '</p>';
    }
    else {
        echo '<a href="login.php">Login</a>';
    }
    
    ?>

    <a class="flex" href="#">
        <img src="img/shopping-cart-solid.svg" alt="">
        <p>Min kurv</p>
    </a>
</header>
<nav>
    <a href="index.php">
        <img src="img/edea-skates-logo.png" alt="EDEA logo">
    </a>
    <ul>
        <li>
            <a href="index.php">Forside</a>
        </li>
        <li>
            <a href="shop.php">Shop</a>
        </li>
        <li>
            <a href="aboutUs.php">Om Os</a>
        </li>

        <?php
        if (!isset($_SESSION["user"])) {
            echo '
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="createUser.php">Opret Bruger</a>
            </li>
            ';
        }
        else {
            echo '
            <li>
                <a href="#">Min Konto</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            ';
        }
        ?>
    </ul>
</nav>