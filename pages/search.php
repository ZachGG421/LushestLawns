<?php
    include 'connect.php';

    session_start();
    
    $landscaperID=$_SESSION['landscaperID'];

    //Query with join to display all columns
    //Only shows records with all information filled out
    $q = "SELECT Landscaper.LandscaperFirstName, Landscaper.LandscaperLastName, Landscaper.LandscaperID, 
    Landscaper.LandscaperPhoneNumber, Landscaper.LandscaperEmail,

    Client.ClientFirstName, Client.ClientLastName, Client.ClientID, ClientOrder.ShippingAddress, ClientAppointments.ServiceType,
    ClientAppointments.DateOfService, ClientAppointments.ServiceID, ClientOrder.ProductType, ClientOrder.OrderNumber
    
    FROM `Landscaper`
    INNER JOIN ClientOrder ON Landscaper.LandscaperID=ClientOrder.LandscaperID
    INNER JOIN Client ON ClientOrder.ClientID=Client.ClientID
    INNER JOIN ClientAppointments ON ClientOrder.ServiceID=ClientAppointments.ServiceID
    WHERE Landscaper.LandscaperID='$landscaperID'";
    $r = mysqli_query ($con, $q);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search Landscaper</title>
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
                <li><a class="active"  href="search.php">Search Landscapers Records</a></li>
                <li><a href="appointment.php">Make Appointment</a></li>
                <li><a href="placeOrder.php">Place Order</a></li>
                <li><a href="updateOrder.php">Update Order</a></li>
                <li><a href="cancelAppointment.php">Cancel Appointment</a></li>
                <li><a href="cancelOrder.php">Cancel Order</a></li>
                <li><a href="createClient.php">Create Client Account</a></li>
            </ul>
        </div>
        
        <h2>Search Landscaper</h2>

    </head>

    <body>
    <?php
        //table created 
        if($r)
        {
            echo '<table class="format">
                <tr>
                <td><b>Landscaper First Name</b></td>
                <td><b>Landscaper Last Name</b></td>
                <td><b>Landscaper ID</b></td>
                <td><b>Landscaper Phone Number</b></td>
                <td><b>Landscaper Email</b></td>
                <td><b>Client First Name</b></td>
                <td><b>Client Last Name</b></td>
                <td><b>Client ID</b></td>
                <td><b>Address</b></td>
                <td><b>Type of Service</b></td>
                <td><b>Date of Service</b></td>
                <td><b>Service ID</b></td>
                <td><b>Product Type</b></td>
                <td><b>Order Number</b></td>
                </tr>';

            While($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
            {
                echo 
                '<tr><td>'.$row['LandscaperFirstName']
                .'</td><td>'.$row['LandscaperLastName']
                .'</td><td>'.$row['LandscaperID']
                .'</td><td>'.$row['LandscaperPhoneNumber']
                .'</td><td>'.$row['LandscaperEmail']
                .'</td><td>'.$row['ClientFirstName']
                .'</td><td>'.$row['ClientLastName']
                .'</td><td>'.$row['ClientID']
                .'</td><td>'.$row['ShippingAddress']
                .'</td><td>'.$row['ServiceType']
                .'</td><td>'.$row['DateOfService']
                .'</td><td>'.$row['ServiceID']
                .'</td><td>'.$row['ProductType']
                .'</td><td>'.$row['OrderNumber']
                .'</td></tr>';
            }
        }
    ?>

    </body>
</html>    
