<?php 
require 'dbConnection.php';

$id = $_GET['id'];

$id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);


if(!filter_var($id,FILTER_VALIDATE_INT)){

    header("Location: showPosts.php");

}

function CleanInputs($input){
$input = trim($input);
$input = stripslashes($input);
$input = htmlspecialchars($input);

return $input;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $errors = [];

  $title  = CleanInputs($_POST['title']);
  $content = CleanInputs($_POST['content']);
  $image = CleanInputs($_POST['image']);
  $imagedir = CleanInputs($_POST['imgdir']);




  if(empty($title)){

    $errors['title'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$title)){

    $errors['title'] = "Invalid String";
  }
  if(empty($content)){

    $errors['content'] = " Field Required";

  }elseif(!preg_match("/^[a-zA-Z\s*']+$/",$content)){

    $errors['content'] = "Invalid String";
  }

  if(!empty($_FILES['image']['name'])){
    $name = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];
  
    $nameArray =  explode('/',$type);

    $extension =  strtolower($nameArray[1]);
  
    $FinalName = rand().time().'.'.$extension;

    $allowedExt = array('png','jpg','jpeg'); 

    if(in_array($extension,$allowedExt)){
         $folder = "./uploads/";

         $finalPath = $folder.$FinalName;

        if(move_uploaded_file($temp,$finalPath)){

          echo 'File Uploaded';
        }else{

          echo 'error try again';
        }
    }else{

      echo 'Invalid Extension';
    }
 }else{

      echo 'File Required';
     }  

    if(count($errors) > 0){

        foreach($errors as $key => $error){

            echo '* '.$key.' : '.$error.'<br>';
        }
     }else{
       unlink($finalPath);

     $sql = "update posts set title='$title' , content='$content' , imgdir='$finalPath'  where id = $id";

     $op =  mysqli_query($con,$sql);

    if($op){

        echo 'data updated';
        header("Location: showPosts.php");

    }else{
        echo 'Error Try Again';
    }
    }
}

# Fetch Data .... 
$sql = "select * from posts where id = $id";
$op = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op);

mysqli_close($con);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Update</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>Update</h2>
<form  method="post"  action="edit.php?id=<?php echo $data['id'];?>"  enctype ="multipart/form-data">



<div class="form-group">
<label for="exampleInputEmail1">Title :</label>
<input type="text"  name="title"  value="<?php echo $data['title'];?>"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Title ...">
</div>


<div class="form-group">
<label for="exampleInputEmail1">Content :</label>
<input type="text" name="content" value="<?php echo $data['content'];?>" class="form-control" id="exampleInputEmail1" placeholder="Content ...">
</div>
<div class="form-group">
  <label for="image"> Choose Image: </label><input type="file" name="image" class="form-control">

</div>


<button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

</body>
</html>















