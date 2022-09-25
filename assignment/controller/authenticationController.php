<?php 
session_start();
date_default_timezone_set('UTC');
require_once 'dbconnection.php';
require_once './includes/dbconnection.php'; 

$username="";
$email="";


$php_errors = array();

//if the user click on signup button the following code will be implemented.
if (isset($_POST['register_btn'])) {//if register is clicke
	$username= $_POST['username'];//store registered username in $username variable
	$email= $_POST['email'];//store registered email in $email variable
	$password= $_POST['password'];//store registered password in $password variable
	$re_password= $_POST['re_password'];//store registered password in $re_password variable 
    
//for validating the user input for registration

	if (empty($username)) {
		$php_errors['username_error'] = "\"Username is Manadtory !!\"";
	}
	if (!filter_var($email,FILTER_VALIDATE_EMAIL )) {
		$php_errors['email_error'] = "\"Email address in not valid.\"";
	}
	if (empty($email)) {
		$php_errors['email_error'] = "\"Email is Manadtory !!\"";
	}
	if (empty($password)) {
		$php_errors['password_error'] = "\"Password is Manadtory !!\"";
	}
	if ($password != $re_password) {
		$php_errors['password_error'] = "\"Re-Entered password Does not Matched.\"";
	}

    

$stmt = $pdo -> prepare('SELECT * FROM users WHERE email =:Email LIMIT 1');
$criteria = ['Email' => $_POST['email']];
$stmt -> execute($criteria);
$result = $stmt->fetch();
// $userEmailCount = $result -> num_rows;
// $stmt->close();
if ($result > 0) {
	$php_errors['email_error'] = "\"Email already exits! Click Sign in for Login \"";
}
if (count($php_errors) === 0) {

$_POST['password'] = password_hash($password,PASSWORD_DEFAULT);
date_default_timezone_set('Asia/Kathmandu');

$stmt = $pdo->prepare('INSERT INTO users(username,email,password,registered_on) VALUES(:username,:email,:password,:date)');
$criteria = [
	'username' => $_POST['username'], 
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'date'=> date("F j, Y, g:i a")
];

if ($stmt -> execute($criteria)) {
	    echo "<script>alert('Successfully register!!! Click OK for login');</script>";



	    echo "<script> window.location.replace(index.php); </script>";



} else {
	$php_errors['db_error']="Datebase error: failed to register";
}

}

}

//----------------------------------------------------------------------------------

if (isset($_POST['sign_in'])) {
$email= $_POST['email'];//store registered email in $email variable
$password= $_POST['password'];//store registered password in $password variable


if (empty($email)) {
	$php_errors['email'] ="\"Email can not be empty!!.\"";
}

if (empty($password)) {
	$php_errors['password'] = "\"Password Can not be empty!!.\"";
}
if (count($php_errors) == 0) {

$emailCheck = $pdo -> prepare('SELECT * FROM users WHERE email =:Email LIMIT 1');
$placeholder = [':Email' => $_POST['email']];
$emailCheck -> execute($placeholder);
$result = $emailCheck->fetch(PDO::FETCH_ASSOC);

$session_user_id= $result['id'];
$session_username= $result['username'];
$session_user_role= $result['user_role'];



if ($result <= 0) {
	$php_errors['email'] = "\"Email Does not exits\"";

}

if (password_verify($_POST['password'], $result['password'])) {
	  $_SESSION['user_id'] =$session_user_id;
      $_SESSION['user_name']=$session_username;
      $_SESSION['user_role']=$session_user_role;
      $_SESSION['login']='success';
      echo $session_user_id;
	echo "<script>alert('Successfully Login!!!Wellcome to Northampton News');</script>";
	echo "<script> window.location.replace(index.php); </script>";

}else{
	$php_errors['password'] ="\"Incorrect password \"";
}



}



}
?>
