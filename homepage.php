<?php
    include 'connect.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Homepage</title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="llalstylesheet.css">

        <h1>Lushest Lawns and Landscaping</h1>
        
        <div>
            <ul>
                <li><a class="active" href="homepage.php">Home</a></li>
                <li><a href="search.php">Search Landscapers Records</a></li>
                <li><a href="">Make Appointment</a></li>
                <li><a href="">Place Order</a></li>
                <li><a href="">Update Order</a></li>
                <li><a href="">Cancel Appointment</a></li>
                <li><a href="">Cancel Order</a></li>
                <li><a href="">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Homepage</h2>
    </head>
    <body>
        
        <br><br>
        <div>
            <p>
                <?php
                    echo "Welcome back, ".$_SESSION['fName']." ".$_SESSION['lName']."<br>";

                ?>  
            </p>
        </div>

    </body>
        <div>
            <a href="logout.php">Logout</a>
        </div>
</html>