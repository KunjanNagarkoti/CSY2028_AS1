<?php require_once '../includes/dbconnection.php'; ?>
<nav>
	<ul>
				<li><a href="../index.php">Home</a></li>
				<li><a href="../latest-article.php">Latest Articles</a></li>
				<li><a href="../all-news.php">All News</a></li>
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
		<li><a href="../categories_page.php?cat_name=<?php echo $catagory_names ?>"><?php echo $catagory_names." --> ". $total_post ." Post" ;?></a></li>

		<?php
		}
		?> 		

		</ul>


		</li>
		<!-- <li><a href="contact.php">Contact us</a></li> -->
	</ul>
</nav>


<main>
