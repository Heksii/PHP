<?php session_start(); ?>

<footer>
    <ul>
        <li>
            <a href="#">Kundeservice</a>
        </li>
        <li>
            <a href="#">Handelsbetingelser</a>
        </li>
        <li>
            <a href="#">Klinger</a>
        </li>
        <li>
            <a href="#">FAQ</a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="#">Presse</a>
        </li>
        <li>
            <a href="#">Kontakt</a>
        </li>
        <li>
            <p>Følg os:</p>
        </li>
        <li class="flex">
            <a href="#">
                <img src="img/FacebookIcon-bw.png" alt="Facebook logo">
            </a>
            <a href="#">
                <img src="img/InstagramIcon-bw.png" alt="Instagram logo">
            </a>
            <a href="#">
                <img src="img/TwitterIcon-bw.png" alt="Twitter logo">
            </a>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">
                <img src="img/YoutubeIcon-bw.png" alt="YouTube logo">
            </a>
        </li>
    </ul>
    <form action="newsletterLanding.php" method="post">
        <h2>Nyhedsbrev</h2>

        <label for="fname">Fornavn:</label>
        <input type="text" name="name" placeholder="Fornavn" required>

        <label for="mail">mail:</label>
        <input type="text" name="mail" placeholder="Email" required>

        <input type="submit" value="Tilmeld">
    </form>
</footer>