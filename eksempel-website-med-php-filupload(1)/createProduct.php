<?php

    $errormessage = "";
    // Start or continue current session
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    // If user has pushed a submit button
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // Copy all values from $_POST to $_SESSION to keep them available for the whole session
        $_SESSION += $_POST;
        // Put ' ' around login-username to use as comparison in SQL Select statement
        $username = "'" . $_SESSION["login-username"] . "'";
        // Create database connection. Returns MySQLi object.
        $db = new MySQLi("localhost", "brugernavn", "adgangskode", "database");

        // Define targe-directory for uploaded files
        $imageDir = "img\\";
        // Initialise array to hold error-messages related to file-upload
        $imageErr[] = "";

        // If the array with information about file uploads ($_FILES) is not empty
        if(!empty($_FILES['newproduct-image']))
        {
            // Count how many images were uploaded. Do the for loop as many times as pictures were uploaded.
            for($i = 0; $i < count($_FILES['newproduct-image']['name']); $i++)
            {
                // If no error was returned at the upload of the current image
                if($_FILES['newproduct-image']['error'][$i] == 0)
                {
                    // Remove spaces in image filename - if any and add to array containing all image names from this one submit action
                    $noSpaceString[] = str_replace(' ', '', $_FILES['newproduct-image']['name'][$i]);
                    // Move image current temp location/name to variable
                    $imageTmp = $_FILES['newproduct-image']['tmp_name'][$i];
                    // Retrieve just the filename from the image name
                    $imageFileName = basename($noSpaceString[$i]);
                    // Combine the path for image uploads with the image filename
                    $imageFullPath = $imageDir . $imageFileName;

                    // Check if file was moved correctly from $imageTmp to $imageFullPath
                    if(move_uploaded_file($imageTmp, "img/".$imageFileName))
                    {
                        $imageErr[$i] = 0; // If move was successfull errormessage is 0
                    }
                    else
                    {
                        $imageErr[$i] = "Billedet kunne ikke flyttes";
                    }
                }
                else
                {
                    $imageErr[$i] = "Fejl i upload af billedet:" . $_FILES['newproduct-image']['error'][$i];
                }
            }
            // Convert array of image names (with spaces removed) to string, where image names are separated by space
            $prodImagesString = implode(" ", $noSpaceString);
        }
        else
        {
            // If $_FILES is empty nothing was uploaded. Add name of standard no image picture (which will then be uploaded to database)
            $prodImagesString = "No_image_available.png";
        }

        
        // Check if connection to database failed
        if($db->connect_error) 
        {
            // Finish script and write error message
            die("Connection to database failed: ". $db->connect_error);
        }
        else // If connection to database succeeded
        {
            // Initialise array to contain (possible) multiple values from select-field "newproduct-supports"
            $prodSupports = array();

            // If the user selected one or more values in select-field "newproduct-supports"
            if(!empty($_POST['newproduct-supports']))
            {
                // Convert the values selected from array to string
                $prodSupportsString = implode(" ", $_POST['newproduct-supports']);
            }
            // Do SQL query to insert data from form fields (and a few others) into table "products"
            // Test if SQL query succeeded
            if($db->query("INSERT INTO products (PPic, PName, PStars, PDesc, PStiff, PSupp, PPrice, PStock) VALUE ('{$prodImagesString}', '{$_POST['newproduct-name']}', '{$_POST['newproduct-stars']}', '{$_POST['newproduct-longdesc']}', '{$_POST['newproduct-stiff']}', '{$prodSupportsString}', '{$_POST['newproduct-price']}', '{$_POST['newproduct-stock']}')"))
            {
                $errormessage = "Produktoprettelse lykkedes.";
                echo ("<script>window.location.replace('index.php')</script>");
            }
            else
            {
                $errormessage = "Produktoprettelse lykkedes ikke: ".$db->error;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Opret nyt produkt</title>
</head>
<body>
    <?php 
        include "includes/topmenu.php";

        include "includes/sidemenu.php";

    ?>

    <div class="content">
        <main>
            <h1>Opret nyt produkt</h1>
            <!-- enctype="multipart/form-data" allows for file-uploads -->
            <form method="post" enctype="multipart/form-data">
                <p>
                    <label for="newproduct-name">Produkt navn: </label>
                    <input type="text" name="newproduct-name" placeholder="Produktnavn">
                </p>

                <p>
                    <label for="newproduct-image">Klik for at uploade produkt billede</label>
                    <!-- name="newproduct-image[]" indicates that multiple uploads are allowed and stored in array -->
                    <input type="file" name="newproduct-image[]" multiple>
                    <p>ctrl + klik for at markere og uploade flere billeder.</p>
                </p>

                <p>
                    <label for="newproduct-stars">Antal stjerner:</label>
                    <select name="newproduct-stars">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>  
                        <option value="5">5</option>  
                        <option value="6">6</option>                  
                    </select>
                </p>
                
                <p>
                    <label for="newproduct-longdesc">Beskrivelse: </label>
                    <input type="text" name="newproduct-longdesc" placeholder="Beskrivelse">
                </p>

                <p>
                    <label for="newproduct-stiff">Stivhed: </label>
                    <select name="newproduct-stiff">
                        <option value="48">48</option>
                        <option value="85">85</option>
                        <option value="90">90</option>
                        <option value="95">95</option>
                </select>
                </p>
                
                <p>
                    <label for="newproduct-supports">Understøtter (hold ctrl nede for at vælge flere): </label>
                    <!-- name="newproduct-supports[]" indicates that multiple values are allowed and stored in array -->
                    <select name="newproduct-supports[]" multiple size="4">
                        <option value="enkeltspring" selected>Enkeltspring</option>
                        <option value="dobbeltspring">Dobbeltspring</option>
                        <option value="triplespring">Triplespring</option>
                        <option value="quadspring">Quadspring</option>
                    </select>
                </p>

                <p>
                    <label for="newproduct-price">Pris: </label>
                    <input type="text" name="newproduct-price" placeholder="Pris">
                </p>
                
                <p>
                    <label for="newproduct-stock">På lager: </label>
                    <input type="text" name="newproduct-stock" placeholder="Lagerbeholdning">
                </p>
                
                <p>
                    <input type="submit" name="newproduct-submit" value="Opret" class="submitbtn">
                </p>

            </form>
                    
        </main>
        <!-- For test/development purposes print $_FILES, $_POST, and $_SESSION -->
        <h3>$_FILES:</h3>
        <pre><?php  
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                print_r($_FILES);
            } 
            
            ?></pre>
        <h3>$_SESSION:</h3>
        <pre><?php print_r($_SESSION); ?></pre>
        <h3>$_POST:</h3>
        <pre><?php print_r($_POST); ?></pre>

        <?php include "includes/footer.php"; ?>

    </div>
    
</body>
</html>