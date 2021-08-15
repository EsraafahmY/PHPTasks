<?php
require 'dbConnection.php';

$title = "";
$content ="";
$image = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = [];

  if (empty($_POST["title"])) {
    $errors['title']   = "Title is required";
  } else {
    $title = test_input($_POST["title"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$title)) {
      $errors['title']   = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["content"])) {
    $errors['content']   = "Content is required";
  } else {
    $content = test_input($_POST["content"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$content)) {
      $errors['content']   = "Only letters and white space allowed";
    }
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
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
   $sql = "insert into posts (title,content,image,imgdir) values ('$title','$content','$file' , '$finalPath')";

    $op =  mysqli_query($con,$sql);

    if($op){

        echo 'data Inserted';
    
    }else{
        echo 'Error Try Again';
    }

    }
  }
  include 'header.php';
?>

<div class="container">
  <h2>Add Post</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  
<div class="form-group">
  <label for="title">Title:</label> <input type="text" name="title" class="form-control">
</div>
<div class="form-group">
 <label for="content"> Content: </label><input type="text" name="content" class="form-control">
</div>
<div class="form-group">
  <label for="image"> Choose Image: </label><input type="file" name="image" class="form-control">

</div>

  <input type="submit" name="submit" value="Submit" class="btn btn-primary">  
</form>
</div>

<?php 

include 'footer.php';

?>