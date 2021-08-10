<?php

// $color= ["red" , "green" , "blue"];//indexed array
// sort($color);
// // rsort($color);
// print_r($color);
// $student=["a" =>3.5 , "c" => 2 , "b"=>5];//asosiated array
// asort($student);
// arsort($student);
// ksort($student);
// print_r($student);

// $num = 4;
// function message(){
//     echo $GLOBALS['num'];
// }

// message();

// $_SERVER
// echo $_SERVER['SERVER_NAME'];
// echo $_SERVER['SCRIPT_NAME'];

// echo $_SERVER['REMOTE_ADDR'];

// echo $_SERVER['REQEST_METHOD'];// for server data
// $title = $_POST["title"]; 
// $content = $_POST["content"]; 

// function add (){
//     if($_SERVER['REQUEST_METHOD'] = 'post'){
//         $GLOBALS[$title];;
//         $GLOBALS[$content];; 
     
//      if($_POST["title"] === "" || $_POST["content"] === ""){
//          echo "It's empty title and content"; 
//      }
//      else {
//          echo $_POST["title"]."<br>".$_POST["content"]."<br>"; 
//      }
//      }
// }

$result_str = $result = '';
if (isset($_POST['btnsubmit'])) {
    $title = $_POST["title"]; 
    $content = $_POST["content"]; 
        if (!empty($title) || !empty($content)) {
        // $result = add($title , $content);
        echo $_POST["title"]."<br>".$_POST["content"]."<br>"; 
    }else{
        echo "It's empty title and content"; 

    }
}

?>

<!DOCTYPE html>

<body>
	<div id="page-wrap">
		<h1>Calculate Electricity Bill</h1>

		<form action=<?php echo $_SERVER['PHP_SELF']?> method="post">
            	<input type="text" name="title" id="title" placeholder="Please enter title" />
                <input type="text" name="content" id="content" placeholder="Please enter content" />

            	<input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
		</form>

		<div>
		    <?php echo '<br />' . $result_str; ?>
		</div>
	</div>
</body>
</html>