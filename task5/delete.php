<?php 
 require 'dbConnection.php';

$id = $_GET['id'];

$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);


if(filter_var($id,FILTER_VALIDATE_INT)){
    # Fetch Data .... 
$sql1 = "select * from posts where id = $id";
$op1 = mysqli_query($con,$sql1);
$data = mysqli_fetch_assoc($op1);
// mysqli_close($con);

   // CODE ..... 
   $sql = "delete from posts where id = ".$id;

   $op = mysqli_query($con,$sql);

   if($op){
    $imgdir = $data['imgdir'];
    header("Location: showPosts.php ");
   }else{
       echo 'error';
   }

}else{

    header("Location: showPosts.php ");
}



?>