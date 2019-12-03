<?php
    /* This is a guestbook confirmation page
     * Dec 1, 2019
     * Evgenii Mishkin
    */

    //Start a session
    session_start();

    //If user is not logged in, reroute them to the login page
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }

    include 'nav.php';

    // Turn on error reporting - this is critical!
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Guestbook Summary</title>

</head>
<body>
    <div class="form-group m-5">
        <h3 class="mb-2">Summary</h3>
        <hr>
        <br>
        <?php
            //Connect to db
            require ('/home/emishkin/connect.php');

            //Define the query
            $sql = 'SELECT DISTINCT guest_id, guest_first, guest_last, title, company, linkedin, email, 
                        comment, mailing, meat, date FROM guestbook';

            //Send the query to the database
            $result = mysqli_query($cnxn, $sql);
        ?>

        <table id="student-table" class="display">
            <thead>
            <tr>
                <th>Guest id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Title</th>
                <th>Company</th>
                <th>LinkedIn</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Mailing List</th>
                <th>Where we meet</th>
                <th>Date</th>

            </tr>
            </thead>
            <tbody>
                <?php
                    //Print the results
                    while ($row = mysqli_fetch_assoc($result)) {
                            $guest_id = $row['guest_id'];
                            $guest_first = $row['guest_first'];
                            $guest_last = $row['guest_last'];
                            $title = $row['title'];
                            $company = $row['company'];
                            $linkedin = $row['linkedin'];
                            $email = $row['email'];
                            $comment = $row['comment'];
                            $mailing = $row['mailing'];
                            $meat = $row['meat'];
                            $date = $row['date'];

                        echo "<tr>
                                  <td>$guest_id</td>
                                  <td>$guest_first</td>
                                  <td>$guest_last</td>
                                  <td>$title</td>
                                  <td>$company</td>
                                  <td>$linkedin</td>
                                  <td>$email</td>
                                  <td>$comment</td>
                                  <td>$mailing</td>
                                  <td>$meat</td>
                                  <td>$date</td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>

        <hr>
        <button id="submit3" type="button" class="btn btn-primary">Form Page</button>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="scripts/guestbook.js"></script>
    <script>
        $('#student-table').DataTable();
    </script>
</body>
</html>