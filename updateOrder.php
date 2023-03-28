<?php
    include 'connect.php';

    session_start();

    if(isset($_POST['submit']))
    {
        
        $userID = $_POST['clientID'];
        $orderID = $_POST['orderID'];
        $update = $_POST['update'];


        //Query to validate client info
        $q = "SELECT * FROM `ClientOrder`
        WHERE `ClientID` = '$userID'
        AND `OrderNumber` = '$orderID' ";

        $r=mysqli_query($con, $q);
        echo("ERROR: ". $mysqli->error);

        if($r->num_rows > 0)
        {   
            //query to update existing order
            $q2 = "UPDATE `ClientOrder` 
            SET `ProductType` = '$update'
            WHERE `OrderNumber` = '$orderID' ";

            $r2=mysqli_query($con,$q2);
            echo "<script>alert('Order Updated')</script>";
            echo("ERROR: ". $mysqli -> error);
        }
        else
        {
            echo "<script>alert('Invalid data,  check to make sure order is placed')</script>";
            echo("ERROR: ". $mysqli -> error);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update an Order</title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="llalstylesheet.css">

        <h1>Lushest Lawns and Landscaping</h1>
        
        <div>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="search.php">Search Landscapers Records</a></li>
                <li><a href="appointment.php">Make Appointment</a></li>
                <li><a href="placeOrder.php">Place Order</a></li>
                <li><a class="active" href="updateOrder.php">Update Order</a></li>
                <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Update an Order</h2>

    </head>

    <body>
    <div>
            <form action="" method="POST">
                <label for="clientID">Client ID: </label>
                <input type="text" id="clientID" name="clientID" value="<?php echo$_POST['clientID']; ?>" required><br>

                <label for="orderID">Product Order ID: </label>
                <input type="text" id="orderID" name="orderID" value="<?php echo$_POST['orderID']; ?>" required><br>

                <label for="update">Change Product: </label>
                <input type="text" id="update" name="update" value="<?php echo$_POST['update']; ?>" required><br>


                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </body>
</html>    