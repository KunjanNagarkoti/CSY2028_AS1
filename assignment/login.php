<?php session_start();
require_once('./includes/dbconnection.php');


if (isset($_POST['login'])) {
  if($_POST["email"]=="" or $_POST["password"]==""){
    echo "Email can not be empty!!.";
  }
  else{
    $email=trim($_POST["email"]);
  
    $password=strip_tags(trim($_POST["password"]));
    $query=$db->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $query->execute(array($email,$password));
    $control=$query->fetch(PDO:FETCH_OBJ);
    if($control>0){
      $_SESSION["username"]=$username;
        header("Location:./backend/index.php");
    }
      echo "Incorrect email or password";
  }

}
    



   



?>

<!DOCTYPE html>
<html>
<head>
	<title>Login-Uon NewsPaper</title>
	<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<form class="login" action="./backend/index.php" method="post">
  <div class="login-box">
  <h1>User-Login | Northampton News</h1>
  <div class="error_container">


  <div class="textbox">
    <input id="login" type="email"  name="email" placeholder="Please Enter Your Email">
  </div>

  <div class="textbox">
    <input type="password" name="password" placeholder="Please Enter Your Password">
  </div>

  <input type="submit" name="sign_in" class="btn" value="Login">
  <p>Not have Account?</p> 
  <a href="register.php">Register Here</a>
</div>
   
</body>
</html>



 