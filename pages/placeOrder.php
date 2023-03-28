<?php
    include 'connect.php';

    session_start();

    $landscaperID=$_SESSION['landscaperID'];

    //When form is submitted
    if(isset($_POST['submit']))
    {
        $fName = $_POST['clientFirstName'];
        $lName = $_POST['clientLastName'];
        $userID = $_POST['clientID'];
        $clientAddress = $_POST['clientAddress'];
        $serviceID = $_POST['serviceID'];
        $productType = $_POST['productType'];

        //Query to validate client info
        $q= "SELECT * FROM `Client`
        WHERE clientFirstName='$fName'
        AND clientLastName='$lName'
        AND clientID='$userID'";
        $r=mysqli_query($con, $q);

        //Query to validate if appointment was created
        $q2="SELECT * FROM `ClientAppointments` WHERE ServiceID = '$serviceID'";
        $r2=mysqli_query($con,$q2);

        if($r->num_rows > 0)
        {
            if($r2->num_rows > 0)
            {   

                $landscaperID=$_SESSION['landscaperID'];

                //Query to insert order into database
                $q3="INSERT INTO `ClientOrder`(`ProductType`, `ShippingAddress`, `OrderNumber`, `LandscaperID`, `ClientID`, `ServiceID`)
                VALUES ('$productType', '$clientAddress', (RAND()*100), '$landscaperID', '$userID', '$serviceID')";
                $r3=mysqli_query($con, $q3);
                echo "<script>alert('Order Made')</script>";
            }
            else{
                echo "<script>alert('There is no Appointment made for that Service ID, Please check Service ID and enter correct info')</script>";
            }
        }
        else{
            echo "<script>alert('No account for client in database. Please enter correct client info or create new client')</script>";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Place an Order</title>
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
                <li><a href="appointment.php">Make Appointment</a></li>
                <li><a class="active" href="placeOrder.php">Place Order</a></li>
                <li><a href="updateOrder.php">Update Order</a></li>
                <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Place an Order</h2>

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

                <label for="clientAddress">Client Address: </label>
                <input type="text" id="clientAddress" name="clientAddress" value="<?php echo$_POST['clientAddress']; ?>" required><br>

                <label for="serviceID">Service ID: </label>
                <input type="text" id="serviceID" name="serviceID" value="<?php echo$_POST['serviceID']; ?>" required><br>

                <label for="productType">Products Needed: </label>
                <input type="text" id="productType" name="productType" value="<?php echo$_POST['productType']; ?>" required><br>

                <button onclick="confirmFunction()" type="submit" name="submit">Submit</button>
            </form>
        </div>
        <div>
            <?php
                $q4="SELECT * 
                FROM `ClientOrder` 
                INNER JOIN `Client` ON ClientOrder.ClientID = Client.ClientID
                WHERE LandscaperID = '$landscaperID'";
                $r4=mysqli_query($con,$q4);

                if($r4)
                {
                    echo '<table class="format">
                        <tr>
                        <td><b>Client First Name</b></td>
                        <td><b>Client Last Name</b></td>
                        <td><b>Client ID</b></td>
                        <td><b>Shipping Address</b></td>
                        <td><b>Product to Ship</b></td>
                        <td><b>LandscaperID</b></td>
                        <td><b>ServiceID</b></td>
                        <td><b>OrderNumber</b></td>
                        </tr>';

                        While($row = mysqli_fetch_array($r4,MYSQLI_ASSOC))
                        {
                            echo 
                            '<tr><td>'.$row['ClientFirstName']
                            .'</td><td>'.$row['ClientLastName']
                            .'</td><td>'.$row['ClientID']
                            .'</td><td>'.$row['ShippingAddress']
                            .'</td><td>'.$row['ProductType']
                            .'</td><td>'.$row['LandscaperID']
                            .'</td><td>'.$row['ServiceID']
                            .'</td><td>'.$row['OrderNumber']
                            .'</td></tr>';
                        }                        
                }

            ?>

        </div>
    </body>
</html>    
