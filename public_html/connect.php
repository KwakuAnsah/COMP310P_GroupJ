<?php

    $dbhost = "localhost";
    $dbuser = "test";
    $dbpass = "test";
    $dbname = "sakila";
    
    $connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
            
     if (!$connection) {
    die("Connection failed: " . mysqli_connect_errno());
    
     }
     echo "Connected succcessfully\t";
    
    
echo("\n\n\t hellooooooooooooooo");

$query = "SELECT first_name, family_name FROM Users";
$result = mysqli_query($connection,$query)
or die('Error making select users query'.mysql_error()); 

$row = mysqli_fetch_array($result);
$row[‘first_name’];
$row[‘family_name’];

    
mysqli_close($connection); 
?>


