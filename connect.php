<?php
        $servername = "sql1.njit.edu";
        $username = "zg74";
        $password = "Skyrim421!";
        $dbname = "zg74";
        $con = mysqli_connect($servername,$username,$password,$dbname);
        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        ?>