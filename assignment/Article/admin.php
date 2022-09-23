<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Northampton News - Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles.css'>
    <script src='main.js' defer></script>
</head>
	<?php require_once '../include/header.php';?>
    
        
    <nav>
                <ul>
            
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="#">Select Category</a>
                        <ul>
                            <li><a class="articleLink" href="#">Technology</a></li>
                            <li><a class="articleLink" href="#">Entertainment</a></li>
                            <li><a class="articleLink" href="#">Sports</a></li>
                        </ul>
                    
                    <li><a href="../form/register.php">Sign Up</a></li>
                    </a>
                    </li>
                </ul>
            </nav>
		
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					<li><a href="#">Artice</a></li>
					<li><a href="#">Add Article</a></li>
					<li><a href="#">Edit Artile</a></li>
					<li><a href="#">Full Article</a></li>
				</ul>
			</nav>
		
                <?php require_once '../include/article.php';?>
		


				            
			   
						




		 </main>
		<?php require_once '../include/footer.php';?>
        

		</body>

			

	
</html>