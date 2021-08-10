<?php

$nameErr = "";
$emailErr = "";
$genderErr = "";
$addressErr = "";
$linkedinUrlErr = "";
$passwordErr = "";

$name = "";
$email = "";
$gender = "";
$password = "";
$address = "";
$linkedinUrl = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    if (strlen($password) < 6) {
      $passwordErr = "Password must be more than 6 characters";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  }else {
    $address = test_input($_POST["address"]);
    if (strlen($address) > 10) {
      $addressErr = "Address must be less than 10 characters";
    }
  }
    
  if (empty($_POST["linkedinUrl"])) {
    $linkedinUrlErr = "Url is required";
  } else {
    $linkedinUrl = test_input($_POST["linkedinUrl"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$linkedinUrl)) {
      $linkedinUrlErr = "Invalid URL";
    }    
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  password: <input type="password" name="password">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  address: <input type="text" name="address" maxlength="10">
  <span class="error">* <?php echo $addressErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  linkedin Url: <input type="text" name="linkedinUrl">
  <span class="error">* <?php echo $linkedinUrlErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php

echo "Welcome ", "<h1>$name</h1>";
// echo "<br>";
echo "<h2>Your data: </h2>";
echo $email;
// echo "<br>";
// echo $password;
echo "<br>";
echo $address;
echo "<br>";
echo $gender;
echo "<br>";
echo $linkedinUrl;
?>

</body>
</html>