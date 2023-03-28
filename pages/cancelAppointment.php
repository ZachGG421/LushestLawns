<?php
    include 'connect.php';

    session_start();

    if(isset($_POST['submit']))
    {
        $userID = $_POST['clientID'];
        $serviceID = $_POST['serviceID'];

        //Query to delete Client Appointments
        $q = "DELETE FROM `ClientAppointments`

        WHERE `ServiceID` = '$serviceID'";

        //Query to validate Client info
        $q2 = "SELECT * FROM `ClientAppointments`
        WHERE `ClientID` ='$userID'
        AND `ServiceID` = '$serviceID'";
        
        $r2=mysqli_query($con,$q2);

        if($r2->num_rows > 0)
        {
            $r=mysqli_query($con,$q);
            echo "<script>alert('Appointment Deleted')</script>";
            
        }
        else
        {
            echo "<script>alert('No Appointment has been made with ServiceID')</script>";
        }
        echo("ERROR: ". $mysqli -> error);
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cancel Appointment</title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="llalstylesheet.css">

        <h1>Lushest Lawns and Landscaping</h1>
        
        <div>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="search.php">Search Landscapers Records</a></li>
                <li><a href="appointment.php">Make Appointment</a></li>
                <li><a href="placeOrder.php">Place Order</a></li>
                <li><a href="updateOrder.php">Update Order</a></li>
                <li><a class="active" href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Cancel Appointment</h2>

    </head>

    <body>
        <div>
            <form action="" method="POST">
                <label for="clientID">Client ID: </label>
                <input type="text" id="clientID" name="clientID" value="<?php echo$_POST['clientID']; ?>" required><br>

                <label for="serviceID">Service ID: </label>
                <input type="text" id="serviceID" name="serviceID" value="<?php echo$_POST['serviceID']; ?>" required><br>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>


    </body>
</html>    
