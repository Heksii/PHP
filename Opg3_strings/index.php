<body>
    <?php
    function GeneratePassword(
        int     $length = 8, 
        string  $chars  = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz"
    )
    {
        $output = "";
        for ($i = 0; $i < $length; $i++) {
             $output .= $chars[rand(0, strlen($chars))];
        }
        return $output;
    }

    function IsPalindrome(string $input = "") {
        return strrev(strtoupper($input)) == strtoupper($input)
        ? $input . " is a palindrome."
        : $input . " is not a palindrome.";
    }

    $string = "the quick brown fox jumped over the lazy dog";
    
    echo "<p>" . $string . "</p><br>";

    echo "<p>" . strtoupper($string) . "</p><br>";

    echo "<p>" . ucwords($string) . "</p><br>";

    echo "<p>" . (strpos($string, "quick") ? "True" : "False") . "</p><br>";
    echo "<p>" . (strpos($string, "white") ? "True" : "False") . "</p><br>";

    echo "<p>" . explode("@", "halu@aspit.dk")[0] . "</p><br>";

    echo "<p>" . GeneratePassword(99000, "Illl") . "</p><br>";

    echo "<p>" . IsPalindrome("Racecar") . "</p><br>";
    echo "<p>" . IsPalindrome("Hello") . "</p><br>";
    ?>

    <style>
        body {
            background: #222;
            color: #fff;
            font-family: sans-serif;
            max-width: 100vw;
            overflow-wrap: break-word;
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</body>