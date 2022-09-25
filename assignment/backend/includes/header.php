

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1><?php if (isset($_SESSION['login']) && $_SESSION['user_role']=='news-poster-admin') { echo "News Poter Admin Panel";}else{echo "Northampton News || Admin Panel";}?></h1>
				<?php if (isset($_SESSION['login'])) { ?>
                 	<form action="../logout.php">
                 		<button class="logout_button">Logout</button>
                 	</form>
                 <?php } else {
                 echo '<a class="buttons" href="./login.php">Login</a>';
				 echo '<a class="buttons" href="./register.php">SignUP</a>';
                 } ?>
			</section>

		</header>
<body>

