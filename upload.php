<?php

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {

        // DECLARE VARIABLES
        $msg        = "";               // PRESET $MSG VARIABLE TO BLANK
        $photo_okay = false;            // PRESET PHOTO STATUS TO FALSE UNTIL VERIFIED

        $name       = htmlspecialchars($_POST['name']);   // HOLDS 'NAME' DATA FROM HTML
        $email      = htmlspecialchars($_POST['email']);  // HOLDS 'EMAIL' DATA FROM HTML 
        
        // VALIDATE FILE AND CHECK FOR ERRORS
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

            // SET LOCAL VARIABLES TO STORE SUBMITTED DATA
            $file_name      = $_FILES["photo"]["name"];
            $file_type      = $_FILES["photo"]["type"];
            $file_size      = $_FILES["photo"]["size"];
            $file_tmp_name  = $_FILES["photo"]["tmp_name"];
            $file_error     = $_FILES["photo"]["error"];

            //PRINT VALUES FOR TESTING
            // print "<pre>";
            // print_r($_FILES);
            // print "</pre>";

            // CHECKS FILE TYPE AND EXECUTES SUCCESS OR ERROR MESSAGE
            if ($file_type != 'image/jpeg' && $file_type != 'image/png') {

                $msg = "<span class=red>You must upload a jpg, jpeg, or png file.</span>";
            
            } else {

                move_uploaded_file($file_tmp_name, "uploads/" . $file_name);

                $photo_okay = true;
                $msg = "Thank you $name for entering our photo contest.  You have submitted the below photo:";

            }

        }

    } else {

        // STOPS INVALID ACCESS TO PHP DOCUMENT.  REDIRECTS USER TO MAIN HTML PAGE.
        header('Location: contest.html');
        exit();

    }

?>

<!DOCTYPE html><!-- Ryan King -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Contest</title>
    <style>
        img {
             width: 100%;   /*PHOTOS WILL BE RESPOSIVE AND FIT WITHIN SCREEN*/
        }
    </style>
</head>
<body>

    <header>
        <h1>Photo Contest</h1>
    </header>

    <p><?php print $msg;?></p>
        <?php
            if ($photo_okay) {

                print "<img src=uploads/" . $file_name . " alt=photo>";
            
            }
        ?>

</body>
</html>