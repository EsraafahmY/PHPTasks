<?php 

$server = "localhost";
$dbName = "group5";
$dbUser = "root";
$dbPassword = "";


   $con = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

   if(!$con){

    die('Error '.mysqli_connect_error());
   
}

// echo "Connected successfully";

?>