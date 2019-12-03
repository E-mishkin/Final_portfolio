<?php
    //If user is logged in, get username
    if (isset($_SESSION['username'])) {

        //Display a welcome message
        echo "<p class='m-5'>Welcome ". $_SESSION['username']." <a href=\"logout.php\">logout</a></p>";

    }
?>