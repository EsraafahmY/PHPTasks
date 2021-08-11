<?php 

session_start();

  
if(isset($_SESSION['name']) && isset($_SESSION['email'])){

echo $_SESSION['name'].'<br>'.$_SESSION['email'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
.error {color: #FF0000;}
</style>
  <title>Upload File</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


