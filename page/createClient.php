<?php
    include 'connect.php';

    session_start();

    //idCon
    $idCon="/[0-9]{6}/";

    if(isset($_POST['submit']))
    {   
        if(preg_match($idCon,$_POST['clientID'])!=1)
        {
            echo "<script>alert('ID is only 6 digits')</script>";
        }
        else
        {   

            $clientFirstName = $_POST['clientFirstName'];
            $clientLastName = $_POST['clientLastName'];
            $clientID = $_POST['clientID'];
            
            //query to insert new client info into Database
            $q="INSERT INTO `Client`(ClientFirstName, ClientLastName, ClientID)
            VALUES ('$clientFirstName', '$clientLastName', '$clientID')";
    
            
            //query to validate client info
            $q2="SELECT * FROM `Client`
            WHERE clientFirstName='$clientFirstName'
            AND clientLastName='$clientLastName'
            AND clientID='$clientID'";
    
            $r2=mysqli_query($con, $q2);
    
            if($r2->num_rows > 0)
            {
                echo "<script>alert('Client account exists. Enter new info')</script>";
            }
            else
            {
                $r=mysqli_query($con,$q);
                if($r)
                {
                    echo "<script>alert('Client registered')</script>";
                }
                else{
                    echo "<script>alert('Client Registration ERROR')</script>";
                }
            }
        }
        

        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Client Account</title>
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
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a class="active" href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Create Client Account</h2>

    </head>

    <body>
        <div>
            <form action="" method="POST">
                <label for="clientFirstName">Client First Name: </label>
                <input type="text" id="clientFirstName" name="clientFirstName" value="<?php echo$_POST['clientFirstName']; ?>" required><br>

                <label for="clientLastName">Client Last Name: </label>
                <input type="text" id="clientLastName" name="clientLastName" value="<?php echo$_POST['clientLastName']; ?>" required><br>

                <label for="clientID">Client ID: </label>
                <input type="text" id="clientID" name="clientID" value="<?php echo$_POST['clientID']; ?>" required><br>


                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        
    </body>
</html>    
