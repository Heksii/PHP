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

$season = round(($month - 1) % 12 / 4);
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
                <? 
                $productCount = 3;
                include("include/productDisplay.php") 
                ?>
            </article>

        </section>
    </main>
    <?php include "include/footer.php" ?>
</body>

</html>