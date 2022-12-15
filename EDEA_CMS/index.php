<?php session_start(); ?>
<?php
$month = date('m');
$monthName = [
    "Januar",
    "Febuar",
    "Marts",
    "April",
    "Maj",
    "Juni",
    "Juli",
    "August",
    "September",
    "Oktober",
    "November",
    "December",
][$month - 1];

$season = round(($month + 1) % 12 / 4);
$seasonName = [
    "vinter",
    "forår",
    "sommer",
    "efterår"
][$season];
$seasonText = [
    "Er dine skøjter helt up to date til sæsonenes sidste konkurrencer?",

    "Skal du have nye skøjter klar til næste sæsons programmer?",

    "Off-ice træning er i fuld gang. Vidste du at vi også sælger in-line rulleskøjtehjul til at sætte under dine Edea støvler?",
    
    "Er du kommet godt i gang med sæsonen? Er dine skøjter klar til de første konkurrencer?",
][$season];

$heroImageURL = $month <= 6
    ? "img/edea-ice-skate-collection-2018.jpg"
    : "img/edea-home-of-champions.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = "EDEA - Home of Champions";
include "include/head.php" ?>

<body>
    <?php include "include/header-nav.php" ?>
    <main>
        <section>
            <br>
            <h4>
                <?php print_r($_SESSION); ?>
                <?= "Det er ".$monthName." og dermed ".$seasonName.". <br>".$seasonText ?>
            </h4>
            <br>
            <?='<img src=' . $heroImageURL . '>'?>
            <article>
                <h1>
                    Edea støvler - høj kvalitet til top præsentationer!
                </h1>

                <p>
                    Kunstskøjteløbere har altid flyttet grænser, og de ønsker den nyeste teknologi til at hjælpe dem med dette. Edea's højt kvalificerede teknikere har fået feedback på, hvilke ønsker og krav skøjteløbere har til støvler. Dette, kombineret med den nyeste forskning, gør Edeas støvler både revoloutionerende og af højeste kvalitet.
                </p>
            </article>
            <article>
                <h2>Udvalgte Produkter:</h2>
                <div id="cards">
                    <div class="card">
                        <img src="img\imagecomingsoon.png" alt="">
                        <div>
                            <h2>Edea Flamenco Ice</h2>
                            <p>
                                <span>Antal stjerner: 6</span>
                                <span>Støvle stivhed: 70</span>
                                <span>Understøtter: Alle-danseniveauer</span>
                                <span>Pris: 2500,-</span>
                                <span>På lager: Ja </span>
                            </p>

                            <h3>
                                Beskrivelse:
                            </h3>
                            <p>
                                Flamenco Ice er fremstillet med henblik på den ynde og elegance, der kendetegner dansesporten.
                                Ved hjælp af Edeas mangeårige erfaring har vi lavet en støvle, som givere dansere fuld kontrol over deres skær og ekstra fleksibilitet med den lave støvle.
                                Den unikke indersål giver bedre føling med isen og stabilitet.
                            </p>
                        </div>
                        <button>KØB NU!</button>
                    </div>
                    <div class="card">
                        <img src="img\piano-edea-skates.jpg" alt="">
                        <div>
                            <h2>Edea Piano</h2>
                            <p>
                                <span>Antal stjerner: 6</span>
                                <span>Støvle stivhed: 95</span>
                                <span>Understøtter: Triplespring Quadspring</span>
                                <span>Pris: 4500,-</span>
                                <span>På lager: Ja</span>
                            </p>
                            <h3>
                                Beskrivelse:
                            </h3>
                            <p>
                                Kunstskøjteløbere forsøger altid at flytte grænserne, og med den nyeste teknologi er det nu blevet endnu lettere.
                                Vores dygtige teknikere har med feedback fra verdens bedste skøjteløbere og med brug af den allernyeste teknologi skabt en helt unik ny støvle, Piano.
                                Edea Piano er 100% håndlavet italiensk design. Vores første støvle, der giver ekstra stabilitet, kraft og bevægelse med det dobbelte antichok system og revolutionære design.
                            </p>
                        </div>
                        <button>KØB NU!</button>
                    </div>
                    <div class="card">
                        <img src="img\overture-edea-skates.jpg" alt="">
                        <div>
                            <h2>Edea Overture</h2>
                            <p>
                                <span>Antal stjerner: 3</span>
                                <span>Støvle stivhed: 48</span>
                                <span>Understøtter: Enkeltspring Axel</span>
                                <span>Pris: 1175,-</span>
                                <span>På lager: Ja</span>
                            </p>
                            <h3>
                                Beskrivelse:
                            </h3>
                            <p>
                                Overture er en kombination af let design og Edea teknologi. Det er den mest solgte Edea støvle. Støvlen har stor støtte og fleksibilitet for kunstskøjteløbere, der arbejder på deres grundløb, enkeltspring og axel.
                                Overture er baseret på vores teknologisk viden om kunstskøjteløb på højt niveau og er baseret på vores passion for kunstskøjteløb.
                                Edea Overture er 100% håndlavet italiensk design. Støvlen er letvægtsdesign, som sikrer god responsivitet. Den giver en god fornemmelse for isen, som gør det lettere at udvikle det grundlæggende skøjteløb.
                            </p>
                        </div>
                        <button>KØB NU!</button>
                    </div>
                </div>
            </article>

        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>