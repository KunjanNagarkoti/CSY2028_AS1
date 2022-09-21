<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Northampton News - Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <script src='main.js'></script>
</head>
	<?php require_once './include/header.php';?>
<body>
		<!-- <?php require_once './include/nav.php';?> -->
		<!-- <img src="images/banners/randombanner.php" /> -->
		<main>
            
           
        <form action="registration.php" method="POST">	
				<h3 class="reg">Register here...</h3>
				
				<div class="form-reg">
					<label>First Name</label>
					<input type="text"  name="firstname" />
				</div>
				<div class="form-reg">
					<label>Middle Name</label>
					<input type="text"  name="middlename" />
				</div>
				<div class="form-reg">
					<label>Sur Name</label>
					<input type="text"  name="surname" />
				</div>
				<div class="form-reg">
					<label>User Name</label>
					<input type="text"  name="username" />
				</div>


                <div class="form-reg">
					<label>Email</label>
					<input type="email"  name="email" />
				</div>
				<div class="form-reg">
					<label>Password</label>
					<input type="password"  name="password" />
				</div>
               
				<input type="submit" name="submit">

				</form>

			
					<!-- <label>
					<button class="btn1" name="register">Register</button>
                	<button class="btn1" name="exiting">Already User Login</button>
					</label> -->
				
	
<?php
     require_once 'dbconnect.php';
    if(ISSET($_POST['submit'])){

        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $password = $_POST['password'];

            if($_POST['firstname'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
          echo "<script>alert('Please fill up the required field!')</script>";
        }
                  else{

         $stmt = $conn->prepare('INSERT INTO users(firstname, middlename,surname, username, email, password)
			VALUES (:firstname, :middlename, :surname, :username, :email, :password)');
			$criteria = [
			':firstname' => $_POST['firstname'],
			':middlename' => $_POST['middlename'],
			':surname' => $_POST['surname'],
			':username' => $_POST['username'],
            ':email' => $_POST['email'],
			':password' => md5($_POST['password'])];
		$stmt->execute($criteria);
				}
           
            }

			?>

			
		</main>
		<?php require_once './include/footer.php';?>

	</body>
</html>