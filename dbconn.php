<?php
    // $conn = mysqli_connect("sql105.epizy.com", "epiz_26803955", "s35rVT1Yp0G", "epiz_26803955_boardTable");
    $conn = mysqli_connect("localhost", "root", 1234, "boardTable");
    // $conn = mysqli_connect($server, $username, $password, $dbname);
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
