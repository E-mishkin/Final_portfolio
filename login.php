<?php
    //Start a session
    session_start();

    //If the user is already logged in
    if (isset($_SESSION['username'])) {
        //Redirect to page 1
        header('location: summary.php');
    }

    //If the login form has been submitted
    if(isset($_POST['submit'])) {
        //Include creds.php (eventually, passwords should be moved to a secure location
        //or stored in a database)
        include ('creds.php');

        //Get the username and password from the POST array
        $username = $_POST["username"];
        $password = $_POST["password"];

        //If the username and password are correct
        if (array_key_exists($username, $logins) && $logins["$username"] == $password) {
            //Store login name in a session variable
            $_SESSION['username'] = $username;

            //Redirect to page 1
            header('location: summary.php');
        }

        //Login credentials are incorrect
        echo "<div class='form-group'><p class='alert-danger text-center p-2'>Invalid login</p></div>";
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/guestbook.css">

    <title>Log In</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <form method="post" action="#">

        <div class="container" id="main">
            <div class="row">
                <div class="col">
                    <label>Username:</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <br>
                </div>

                <div class="col">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                </div>

            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <button id="submit3" type="button" class="btn btn-primary">Form Page</button>
        </div>



    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/guestbook.js"></script>

</body>
</html>


