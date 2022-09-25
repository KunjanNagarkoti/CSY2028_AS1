		<?php require_once './includes/dbconnection.php'; 
        date_default_timezone_set('Asia/Kathmandu');
        
		?>
		<header>
			<div class="page_header">
				<div class="date"><?php echo "Todays: " .date("F j, Y, g:i a"); ?></div>
				<div class="pagelogo"><h1>Northampton News</h1></div>

				<div ><p class="welcome"> Welcome: <?php if (isset($_SESSION['login'])) {
					echo ":". $_SESSION['user_name'];
				}else{ echo ":". "Guest"; }  ;?> (<?php if (isset($_SESSION['login'])) {
					echo $_SESSION['user_role'];
				}else{echo "Visitor"; } ?>)       </p></div>
				<div class="header_buttons">

					<form method="post" action="./search.php"> 
					<button class="search" type="submit">Search</button>
					<!-- <label >Search:</label> -->
					<input class="search_input" type="text" name="search" placeholder="Search here.......">
		            </form>


		             <?php if (isset($_SESSION['login']) ) { ?>
		             	<form action="logout.php">
		             		<button class="logout_button">Logout</button>
		             	</form>

                    <!--  <select name="" onchange="location = this.value;">
                      <option value=""></option>
                       <option value="logout.php">Logout</option>
                        </select> -->
		             <?php } else {
		             echo '<a class="buttons" href="./login.php">Login</a>';
					 echo '<a class="buttons" href="./register.php">SignUP</a>';
		             } ?>

<?php if (isset($_SESSION['login']) && $_SESSION['user_role']=='news-poster-admin') {
echo '<a href="./backend" class="go_to_admin_link">Go to admin Panel</a>';

 }elseif (isset($_SESSION['login']) && $_SESSION['user_role']=='admin'){
 	echo '<a href="./backend" class="go_to_admin_link">Go to admin Panel</a>';
 }elseif(isset($_SESSION['login']) && $_SESSION['user_role']=='subscriber'){


 }
 ?>

		</div>
			</div>

		</header>

		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="latest-article.php">Latest Articles</a></li>
				<li><a href="all-news.php">All News</a></li>
				<li><a href="#">Select Category</a>
					<ul class="catagory_item">
		<?php 
          


		$stmt3 = $pdo -> prepare ("SELECT * FROM categories");
		$stmt3->execute();
		while ( $category_item = $stmt3 -> fetch(PDO::FETCH_ASSOC)) {
		// $cat_total_post = $category_item['category_total_post'];	
		$catagory_names= $category_item['category_name'];
        $stmt32 = $pdo->prepare("SELECT * FROM posts WHERE post_category=:cat_n"); 
        $stmt32->execute([':cat_n' => $catagory_names]);
        $category_n = $stmt32 -> fetch(PDO::FETCH_ASSOC);
        $total_post = $stmt32 ->  rowCount();

        

		?>

		<?php $update_views = "UPDATE categories SET category_total_post = :tol_post WHERE category_name=:cat_nn";
        $stmt99 = $pdo -> prepare ($update_views);
        $stmt99->execute([':tol_post'=>$total_post,':cat_nn'=>$catagory_names]); ?>
		<li><a href="./categories_page.php?cat_name=<?php echo $catagory_names ?>"><?php echo $catagory_names." --> ". $total_post ." Post" ;?></a></li>

		<?php
		}
		?> 		

		</ul>
				</li>
				<!-- <li><a href="contact.php">Contact us</a></li> -->
				
			</ul>
		</nav><main>




