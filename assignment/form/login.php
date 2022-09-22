<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Northampton News - Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles.css'>
    <script src='main.js'></script>
</head>
	<?php require_once '../include/header.php';?>
<body>
		
<nav>
			<ul>
				<li><a href="../index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
				
			</ul>
		</nav>

		<main>
            
           
		<form action="login.php" method="POST">	
				<h3 class="reg">Log In here...</h3>
				
			

                <div class="form">
					<label>Email</label>
					<input type="email"  name="email" />
				</div>
				<div class="form">
					<label>Password</label>
					<input type="password"  name="password" />
				</div>

                <label>
                    <button>
                <a href="../index.php"> 
                    Login 
                </a>
                    </button>
                </label>
               
				
                <label>
                <a href="register.php">Become A New User ?</a>
                </label>
                

				</form>
			
			
		</main>


           <!-- Extract -->
        <?php
	session_start();
	
	require_once '../dbconnect.php';
	
	// if(ISSET($_POST['login'])){
	// 	if($_POST['email'] != "" || $_POST['password'] != ""){
	// 		$email = $_POST['email'];
	// 		// md5 encrypted
	// 		// $password = md5($_POST['password']);
	// 		$password = $_POST['password'];
	// 		$sql = "SELECT * FROM `users` WHERE `email`=? AND `password`=? ";
	// 		$query = $conn->prepare($sql);
	// 		$query->execute(array($email,$password));
	// 		$row = $query->rowCount();
	// 		$fetch = $query->fetch();
	// 		if($row > 0) {
	// 			$_SESSION['user'] = $fetch['mem_id'];
	// 			header("location: ../index.php");
	// 		} else{
	// 			echo "
	// 			<script>alert('Invalid email     or password')</script>
	// 			<script>window.location = 'index.php'</script>
	// 			";
	// 		}
	// 	}else{
	// 		echo "
	// 			<script>alert('Please complete the required field!')</script>
	// 			<script>window.location = 'index.php'</script>
	// 		";
	// 	}
	// }


	session_start();
	
	require_once '../dbconnect.php';
	
	if(ISSET($_POST['login'])){
		if($_POST['email'] != "" || $_POST['password'] != ""){
			$email = $_POST['email'];
			// md5 encrypted
			// $password = md5($_POST['password']);
			$password = $_POST['password'];
			$sql = "SELECT * FROM `member` WHERE `email`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($email,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['mem_id'];
				header("location: home.php");
			} else{
				echo "
				<script>alert('Invalid email or password')</script>
				<script>window.location = 'index.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
?>



		<?php require_once '../include/footer.php';?>

	</body>
</html>