<?php
    include 'connect.php';

    session_start();

    //Regex 
    $specialChar = "/[!@#$%^&*)(+=._-]/";
    $upperCase="/[A-Z]/";
    $numericCon="/[0-9]/";
    $idCon="/[0-9]{6}/";
    $pNumberCon="/(1-)?\d{3}-\d{3}-\d{4}/";
    $emailCon="/@[A-Za-z]{1,15}.{2,4}/";

    $fName = $_POST['fName'];
    $lName = $_POST['lName'];


    if(isset($_POST['submit']))
    {   
        //password validation
        if(preg_match($upperCase,$_POST['password'])!=1)
        {
            
            echo "<script>alert('Password must contain an uppercase character')</script>";
        }
        else if(preg_match($specialChar,$_POST['password'])!=1)
        {
            echo "<script>alert('Password must contain a special character')</script>";
        }
        else if(preg_match($numericCon,$_POST['password'])!=1)
        {
            echo "<script>alert('Password must contain a numeral character')</script>";
        }
        else
        {   
            $password = $_POST['password'];

            //ID validation
            if(preg_match($idCon,$_POST['userID'])!=1)
            {
                echo "<script>alert('ID is only 6 digits')</script>";
            }
            else{
                $userID = $_POST['userID'];

                //Phone number validation
                if(preg_match($pNumberCon,$_POST['phoneNum'])!=1)
                {
                    echo "<script>alert('Phone Number in format: xxx-xxx-xxxx')</script>";
                }
                else{
                    $phoneNum = $_POST['phoneNum'];

                    //Validation with email
                    if($_POST['emailCheck']==true)
                    {   
                        if($_POST['email']==null)
                        {
                            echo "<script>alert('Enter email')</script>";
                        }
                        else if(preg_match($emailCon, $_POST['email'])!=1)
                        {
                            echo "<script>alert('Invalid Email')</script>";
                        }
                        else
                        {

                            $fName = $_POST['fName'];
                            $lName = $_POST['lName'];
                
                
                            $q= "SELECT * FROM `Landscaper` 
                            WHERE LandscaperFirstName='$fName'
                            AND LandscaperLastName='$lName'
                            And LandscaperPassword='$password'
                            And LandscaperID='$userID'
                            AND LandscaperPhoneNumber='$phoneNum'";
                        
                
                            $r=mysqli_query($con, $q);

                            //if login info is correct
                            if($r->num_rows > 0)
                            {
                                $row = mysqli_fetch_assoc($r);
                                $_SESSION['fName'] = $row['LandscaperFirstName'];
                                $_SESSION['lName'] = $row['LandscaperLastName'];
                                $_SESSION['password'] = $row['LandscaperPassword'];
                                $_SESSION['landscaperID'] = $row['LandscaperID'];
                                $_SESSION['phoneNum'] = $row['LandscaperPhoneNumber'];
                
                
                            
                                if($_POST['transactionSelect']=='search')
                                {
                                    header("Location: search.php");
                
                                }
                                else if($_POST['transactionSelect']=='appointment')
                                {
                                    header("Location: appointment.php");
                                }
                                else if($_POST['transactionSelect']=='placeOrder')
                                {
                                    header("Location: placeOrder.php");
                                }
                                else if($_POST['transactionSelect']=='updateOrder')
                                {
                                    header("Location: updateOrder.php");
                                }
                                else if($_POST['transactionSelect']=='cancelAppointment')
                                {
                                    header("Location: cancelAppointment.php");
                                }
                                else if($_POST['transactionSelect']=='cancelOrder')
                                {
                                    header("Location: cancelOrder.php");
                                }
                                else if($_POST['transactionSelect']=='createClient')
                                {
                                    header("Location: createClient.php");
                                }
                            }
                            else
                            {
                                echo "<script>alert('Wrong Credentials')</script>";
                            }
                        }
                        
                    }
                    //validation without email
                    else
                    {
                        $fName = $_POST['fName'];
                        $lName = $_POST['lName'];
                
                
                        $q= "SELECT * FROM `Landscaper` 
                        WHERE LandscaperFirstName='$fName'
                        AND LandscaperLastName='$lName'
                        And LandscaperPassword='$password'
                        And LandscaperID='$userID'
                        AND LandscaperPhoneNumber='$phoneNum'";
                        
                
                        $r=mysqli_query($con, $q);
                        if($r->num_rows > 0)
                        {
                            $row = mysqli_fetch_assoc($r);
                            $_SESSION['fName'] = $row['LandscaperFirstName'];
                            $_SESSION['lName'] = $row['LandscaperLastName'];
                            $_SESSION['password'] = $row['LandscaperPassword'];
                            $_SESSION['landscaperID'] = $row['LandscaperID'];
                            $_SESSION['phoneNum'] = $row['LandscaperPhoneNumber'];
                
                
                            
                            if($_POST['transactionSelect']=='search')
                            {
                                header("Location: search.php");
                
                            }
                            else if($_POST['transactionSelect']=='appointment')
                            {
                                header("Location: appointment.php");
                            }
                            else if($_POST['transactionSelect']=='placeOrder')
                            {
                                header("Location: placeOrder.php");
                            }
                            else if($_POST['transactionSelect']=='updateOrder')
                            {
                                header("Location: updateOrder.php");
                            }
                            else if($_POST['transactionSelect']=='cancelAppointment')
                            {
                                header("Location: cancelAppointment.php");
                            }
                            else if($_POST['transactionSelect']=='cancelOrder')
                            {
                                header("Location: cancelOrder.php");
                            }
                            else if($_POST['transactionSelect']=='createClient')
                            {
                                header("Location: createClient.php");
                            }
                
                        }
                        else
                        {
                            echo "<script>alert('Wrong Credentials')</script>";
                        }                        
                    }
                }
            }
        }

        
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LLAL Login</title>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="llalstylesheet.css">

        <h1>Lushest Lawns and Landscaping</h1>
        <h2>Login</h2>
    </head>
    <body>
        <div>
            <form action="" method="POST">
                <label for="fName">First Name: </label>
                <input type="text" id="fName" name="fName" value="<?php echo$_POST['fName']; ?>" required><br>

                <label for="lName">Last Name: </label>
                <input type="text" id="lName" name="lName" value="<?php echo$_POST['lName']; ?>" required><br>

                <label for="password">Password: </label>
                <input type="text" id="password" name="password" value="<?php echo$_POST['password']; ?>" required><br>

                <label for="userID">Landscaper ID: </label>
                <input type="text" id="userID" name="userID" value="<?php echo$_POST['userID']; ?>" required><br>

                <label for="phoneNum">Phone Number: </label>
                <input type="text" id="phoneNum" name="phoneNum" value="<?php echo$_POST['phoneNum']; ?>" required><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email"><br><br>

                <input type="checkbox" id="emailCheck" name="emailCheck" checked>
                <label for="emailCheck">Check to verify email</label><br><br>

                <label for="transactionSelect">Choose a transaction:</label>
                <select name="transactionSelect" id="transactionSelect">
                    <option value="search">Search the Landscaper's Records</option>
                    <option value="appointment">Book a Customer's Appointment</option>
                    <option value="placeOrder">Place a Customer's Order</option>
                    <option value="updateOrder">Update a Customer's Order</option>
                    <option value="cancelAppointment">Cancel a Customer's Appointment</option>
                    <option value="cancelOrder">Cancel a Customer's Order</option>
                    <option value="createClient">Create a Customer's Account</option>
                </select>

                <button name="submit">Login</button>
            </form>
        </div>

    </body>
</html>
