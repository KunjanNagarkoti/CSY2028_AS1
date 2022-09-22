<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Northampton News - Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css'>
    <script src='main.js' defer></script>
</head>
	<?php require_once './include/header.php';?>
<body>
		<?php require_once './include/nav.php';?>
		<img src="images/banners/randombanner.php" />
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					<li><a href="#">Sidebar</a></li>
					<li><a href="#">Add Category</a></li>
					<li><a href="#">Be removed</a></li>
					<li><a href="#">When not needed</a></li>
				</ul>
			</nav>
		
			<?php require_once './include/article.php';?>
		</main>
		<?php require_once './include/footer.php';?>

	</body>
</html>