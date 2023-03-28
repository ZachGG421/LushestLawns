<?php
    include 'connect.php';

    session_start();

    if(isset($_POST['submit']))
    {
        $userID = $_POST['clientID'];
        $orderID = $_POST['orderID'];

        //Query to delete order
        $q = "DELETE FROM `ClientOrder`

        WHERE `OrderNumber` = '$orderID'";

        //Query to validate client info
        $q2 = "SELECT * FROM `ClientOrder`
        WHERE `ClientID` ='$userID'
        AND `OrderNumber` = '$orderID'";
        
        $r2=mysqli_query($con,$q2);

        if($r2->num_rows > 0)
        {
            $r=mysqli_query($con,$q);
            echo "<script>alert('Order Deleted')</script>";
            
        }
        else
        {
            echo "<script>alert('No Order made with OrderID')</script>";
        }
        echo("ERROR: ". $mysqli -> error);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cancel Order</title>
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
                <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a class="active" href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Cancel Order</h2>

    </head>

    <body>
        <div>
            <form action="" method="POST">
                <label for="clientID">Client ID: </label>
                <input type="text" id="clientID" name="clientID" value="<?php echo$_POST['clientID']; ?>" required><br>

                <label for="orderID">Order ID: </label>
                <input type="text" id="orderID" name="orderID" value="<?php echo$_POST['orderID']; ?>" required><br>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>


    </body>
</html>    
