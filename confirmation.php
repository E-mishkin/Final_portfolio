<?php
    /* This is a guestbook confirmation page
     * Dec 1, 2019
     * Evgenii Mishkin
    */

    // Turn on error reporting - this is critical!
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Guestbook Form</title>

</head>
<body>
    <div class="form-group m-5">
        <h3 class="mb-2">Thank you for completing this application form and for your interest in volunteering with us.</h3>
        <hr>
        <br>
        <h4 >Summary</h4>
        <br>
    <?php
        //Connect to db
        require ('/home/emishkin/connect.php');

        //fields
        $first = $_POST['firstName'];
        $last = $_POST['lastName'];
        $title = mysqli_real_escape_string($cnxn, $_POST['title']);
        $company = mysqli_real_escape_string($cnxn, $_POST['company']);
        $linkedIn = $_POST['linkedIn'];
        $email = $_POST['email'];
        $comment = mysqli_real_escape_string($cnxn, $_POST['comment']);
        //$mailing = $_POST['mailing'];
        $meet = $_POST['meet'];
        $meetOther = $_POST['other'];
        //$html = $_POST['html'];
        //$text = $_POST['text'];

        //Validate the data
        $isValid = true;

        if (!empty($first)) {
            $first = mysqli_real_escape_string($cnxn, $first);
        } else {
            echo "<p class='text-danger'>First name is required</p>";
            $isValid = false;
        }

        if (!empty($last)) {
            $last = mysqli_real_escape_string($cnxn, $last);
        } else {
            echo "<p class='text-danger'>Last name is required</p>";
            $isValid = false;
        }

        if (filter_var($linkedIn, FILTER_VALIDATE_URL)) {
            $linkedIn = mysqli_real_escape_string($cnxn, $linkedIn);
        } else {
            echo "<p class='text-danger'>LinkedIn is not a valid URL</p>";
            $isValid = false;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = mysqli_real_escape_string($cnxn, $email);
        } else {
            echo "<p class='text-danger'>Email is not a valid email</p>";
            $isValid = false;
        }

        if (isset($meet)) {
            $meet = mysqli_real_escape_string($cnxn, $meet);
            if($meet == 'other') {
                $meet = $meetOther;
            }
        } else {
            echo "<p>Select where did you meet</p>";
            $isValid = false;
        }

        if (isset($_POST['mailing'])) {
            $mailing = mysqli_real_escape_string($cnxn, $_POST['mailing']);
            /*
            if (isset($_POST['html'])) {
                $html = mysqli_real_escape_string($cnxn, $_POST['html']);
            } elseif (isset($_POST['text'])) {
                $text = mysqli_real_escape_string($cnxn, $_POST['text']);
            } else {
                $html = '';
                $text = '';
            }
            */
        } else {
            $mailing = 'no';
        }


        //Print summary if date is valid
        if ($isValid) {
            $sql = "INSERT INTO guestbook (guest_id, guest_first, guest_last, title, company, linkedin, email, 
                    comment, mailing, meat, date)
                    VALUES (default, '$first', '$last', '$title', '$company', '$linkedIn', '$email', '$comment', 
                    '$mailing', '$meet', default)";


            $result = mysqli_query($cnxn, $sql);

            //If successful, print summary
            if ($result) {
                echo "<p>Name: $first $last</p>";
                echo "<p>Title: $title</p>";
                echo "<p>Company: $company</p>";
                echo "<p>LinkedIn: $linkedIn</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Comment: $comment</p>";
                echo "<p>Mailing: $mailing</p>";
                echo "<p>Where did you meet: $meet</p>";
            }

        }

    ?>
        <br>
        <hr>
        <button id="submit2" type="button" class="btn btn-primary" name="admin">Admin Page</button>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/guestbook.js"></script>
</body>
</html>