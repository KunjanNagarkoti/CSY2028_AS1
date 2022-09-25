<?php require_once  './includes/dbconnection.php'; ?>
<?php require_once  './controller/authenticationController.php'; ?>

<!DOCTYPE html>
<html>
<head>  
	<title>Register-Uon NewsPaper</title>
	<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<form class="login" action="register.php" method="post">
  <div class="login-box">
  <h1>User-SignUp | Northampton News</h1>
  <div class="error_container">
  <?php  if(count($php_errors)>0): //if there is any error in in register form then this code get executes.?>
 
     <?php foreach ($php_errors as $error): ?>
      <li style="color: red; list-style: none;" class="error_list"><?php echo $error; ?></li>
     <?php endforeach; ?>
   
<?php endif; ?>
</div>
  <div class="textbox">
    <input type="text" value="<?php echo $username; ?>" name="username" placeholder="Enter a new username">
  </div>

  <div class="textbox">
    <input id="login" type="email" value="<?php echo $email; ?>" name="email" placeholder="Please Enter New Email">
  </div>

  <div class="textbox">
    <input type="password" name="password"  placeholder="Please Enter New Password">
  </div>

  <div class="textbox">
    <input type="password" name="re_password" placeholder="Re-Enter Your Password">
  </div>
  
  <button type="submit" class="btn" name="register_btn" >Register</button>
  <p>Already a Member?</p> 
  <a href="login.php">Sign In</a>
</form>
</div>
</body>
</html>



 