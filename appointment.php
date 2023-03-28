<?php
    include 'connect.php';

    session_start();

    $landscaperID=$_SESSION['landscaperID'];

    //When form is submit
    if(isset($_POST['submit']))
    {
        $fName = $_POST['clientFirstName'];
        $lName = $_POST['clientLastName'];
        $userID = $_POST['clientID'];
        $clientService = $_POST['clientService'];
        $dateOfService = $_POST['dateOfService'];

        //validate to check if client info is correct
        $q= "SELECT * FROM `Client`
        WHERE clientFirstName='$fName'
        AND clientLastName='$lName'
        AND clientID='$userID'";

        $r=mysqli_query($con, $q);

        if($r->num_rows > 0)
        {   
            //Query to insert appointment info
            $q3="INSERT INTO ClientAppointments(ServiceType, DateOfService, LandscaperID, ClientID, ServiceID)
            VALUES ('$clientService', '$dateOfService', '$landscaperID', '$userID', (RAND()*100))";
            $r3=mysqli_query($con, $q3);
            echo "<script>alert('Appointment has been made')</script>";

        }
        else
        {
            echo "<script>alert('No account for client in database. Please enter correct client info or create new client')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Make an Appointment</title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="llalstylesheet.css">
        <style type ="text/css">
            table.format
            {   table-layout:fixed; 
                align:center;
                margin-left:auto;
                margin-right:auto;
                width:100%;
                
            }
            th, td 
            {
                text-align:center;
                background-color:white;
                opacity: 0.8;
            }

        </style>

        <h1>Lushest Lawns and Landscaping</h1>
        
        <div>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="search.php">Search Landscapers Records</a></li>
                <li><a class="active" href="appointment.php">Make Appointment</a></li>
                <li><a href="placeOrder.php">Place Order</a></li>
                <li><a href="updateOrder.php">Update Order</a></li>
                <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Make an Appointment</h2>

    </head>

    <body>
    <div>
            <form action="" method="POST">
                <label for="clientFirstName">First Name: </label>
                <input type="text" id="clientFirstName" name="clientFirstName" value="<?php echo$_POST['clientFirstName']; ?>" required><br>

                <label for="clientLastName">Last Name: </label>
                <input type="text" id="clientLastName" name="clientLastName" value="<?php echo$_POST['clientLastName']; ?>" required><br>

                <label for="clientID">Client ID: </label>
                <input type="text" id="clientID" name="clientID" value="<?php echo$_POST['clientID']; ?>" required><br>

                <label for="clientService">Type of Service: </label>
                <input type="text" id="clientService" name="clientService" value="<?php echo$_POST['clientService']; ?>" required><br>

                <label for="dateOfService">Date of Service: </label>
                <input type="text" id="dateOfService" name="dateOfService" value="<?php echo$_POST['dateOfService']; ?>" required><br>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <div>
            <?php

                //Query to post Appointment Info 
                $q4="SELECT * 
                FROM `ClientAppointments` 
                INNER JOIN `Client` ON ClientAppointments.ClientID = Client.ClientID
                WHERE LandscaperID = '$landscaperID'";
                $r4=mysqli_query($con,$q4);

                //Table used to see appointment info
                if($r4)
                {
                    echo '<table class="format">
                        <tr>
                        <td><b>Client First Name</b></td>
                        <td><b>Client Last Name</b></td>
                        <td><b>Client ID</b></td>
                        <td><b>Service</b></td>
                        <td><b>Date Of Service</b></td>
                        <td><b>LandscaperID</b></td>
                        <td><b>ServiceID</b></td>
                        </tr>';
                        
                        While($row = mysqli_fetch_array($r4,MYSQLI_ASSOC))
                        {
                            echo 
                            '<tr><td>'.$row['ClientFirstName']
                            .'</td><td>'.$row['ClientLastName']
                            .'</td><td>'.$row['ClientID']
                            .'</td><td>'.$row['ServiceType']
                            .'</td><td>'.$row['DateOfService']
                            .'</td><td>'.$row['LandscaperID']
                            .'</td><td>'.$row['ServiceID']
                            .'</td></tr>';
                        }                        
                }


     

            ?>

        </div>

    </body>
</html>    