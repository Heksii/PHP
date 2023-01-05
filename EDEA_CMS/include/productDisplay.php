<?
$db = new mysqli("localhost", "casp196b_edea_admin", "fg}LrBz%p4h}sp@W8l", "casp196b_edea");
$db->query("SET NAMES utf8");

 // Hvis $productCount er null, så set den til 3 med ??= operatoren (null coalescing assignment).
$productCount ??= 3;

$productsQueryResult = $db->query("SELECT * FROM products ORDER BY PID DESC LIMIT {$productCount}");
$products = [];

while ($row = $productsQueryResult->fetch_assoc()) {
    $products[] = $row;
}

function GetImageURLsFromString($string) {
    // boom
    $images = explode(' ', $string);

    // Brug array_map til at iterere over alle elementerne i
    // $images med en callback function der gør følgene:
    //   -Kom "img\" bag på alle strings i $images.
    //   -Læg en placeholder ind hvis billede url'en er null.
    //
    // returner derefter det nye array med billederne i.
    return array_map(function($url) {
        return 'img\\' . ($url ?: "imagecomingsoon.png");
    }, $images);
}

function DisplayProduct($product)
{
    echo '<div class="card">';
    echo '<img src="' . GetImageURLsFromString($product["PPic"])[0] . '" alt="">';
    echo '<div>';
    echo '<h2>' . $product["PName"] . '</h2>';
    echo '<p>';
    echo '<span>Antal stjerner: ' .  $product["PStars"] .  '</span>';
    echo '<span>Støvle stivhed: ' .  $product["PStiff"] . '</span>';
    echo '<span>Understøtter: ' . $product["PSupp"] . '</span>';
    echo '<span>Pris: ' . $product["PPrice"] . ',-</span>';
    echo '<span>På lager: ' . ($product["PStock"]>0 ? "Ja" : "Nej") . '</span>';
    echo '</p><br>';
    echo '<h3>Beskrivelse:</h3>';
    echo '<p>';
    echo  $product["PDesc"];
    echo '</p>';
    echo '</div>';
    echo '<button>KØB NU!</button>';
    echo '</div>';
}
?>

<div id="cards">
    <?
    foreach ($products as $product) {
        DisplayProduct($product);
    }
    ?>
</div>