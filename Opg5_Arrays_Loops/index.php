<?php
function findInArray(array $haystack, string $needle): int
{
    foreach ($haystack as $key => $value) {
        if ($value == $needle) return $key;
    }

    return count($haystack);
}

function writeMonths(array $months)
{
    foreach ($months as $name => $length) {
        echo "<p>" . ucfirst($name) . ": " . $length . "</p>";
    }
}

$elever = ["casper", "mathias", "philip", "bastian", "sebastian", "andrei", "victor", "rasmus", "julius"];
$find = "bastian";

$months = [
    "januar" => 31,
    "febuar" => 28,
    "marts" => 31,
    "april" => 30,
    "maj" => 31,
    "juni" => 30,
    "august" => 31,
    "september" => 30,
    "oktober" => 31,
    "november" => 30,
    "december" => 31
];

$longMonths = [];
$shortMonths = [];

foreach ($months as $name => $length) {
    if ($length < 31)
        $shortMonths[$name] = $length;
    else
        $longMonths[$name] = $length;
}

$teachers = [
    [
        "fornavn" => "Hanne",
        "efternavn" => "Lund",
        "fag" => "Visualisering"
    ],

    [
        "fornavn" => "Jens",
        "efternavn" => "Clausen",
        "fag" => "Softwarekonstruktion"
    ],

    [
        "fornavn" => "Ronni",
        "efternavn" => "Hansen",
        "fag" => "Teknik"
    ],

    [
        "fornavn" => "Ulf",
        "efternavn" => "Skaaning",
        "fag" => "AspIT-Lab"
    ],
];



?>

<body>
    <pre>
        <?= print_r($elever); ?> 
    </pre>
    <p>
        <?= 'Index of "' . ucfirst($find) . '" is ' . array_search("bastian", $elever); ?>
    </p>
    <div class="month-display">
        <div>
            <?php writeMonths($shortMonths) ?>
        </div>
        <div>
            <?php writeMonths($longMonths) ?>
        </div>
    </div>
    <pre>
        <?php print_r($teachers) ?>
    </pre>
    <?php
    foreach ($teachers as $teacher) {
        echo "<article>";

        foreach ($teacher as $key => $value) {
            echo "<p>" . ucfirst($key) . ": " . $value . "</p>";
        }

        echo "</article><br>";
    }
    ?>

    <style>
        .month-display {
            display: flex;
            gap: 4rem;
        }
    </style>
</body>