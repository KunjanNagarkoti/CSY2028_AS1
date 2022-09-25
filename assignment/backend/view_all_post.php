
<?php require_once './includes/header.php'; ?>
			<?php require_once './includes/navigation.php' ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
           <div class="cat-list">
<!-- This part of table html code is taken from https://www.w3schools.com/html/html_tables.asp website on 02-jan-2021  -->			
			<table  class="cat-table" style="width:100%" align="center">
			
            <h3>List Of All Posts</h3>

			<tr>
			<th>Post <br> ID</th>
			<th>Post <br> Title</th>
			<th>Post <br>category </th>
			<th>post <br> Auther</th>
			<th>Post<br>Image</th>
			<th>Post<br>Views</th>
			<th>Post <br> Date</th>
			</tr>
 

<?php 
//for getting all post form posts table ordered by post_id in desending order
$stmt3 = $pdo -> prepare ("SELECT * FROM posts ORDER BY post_id DESC");
$stmt3->execute();
while ( $post_data = $stmt3-> fetch(PDO::FETCH_ASSOC)) {
$post_title_name = substr($post_data['post_title'], 0,30);
$post_author_name = $post_data['post_author'];
$post_cat = $post_data['post_category'];
$post_date = $post_data['post_date'];
$post_views =$post_data['post_views'];
$post_image =$post_data['post_image']; 
$post_ids =$post_data['post_id'];
$total_post = $stmt3 -> rowCount();

?>


           <tr>
			<td><?php echo $post_ids ?></td>
			<td><a href="../single-post-page.php?post_id=<?php echo $post_ids ?>"><h4><?php echo $post_title_name; ?> </h4></a></td>
			<td><a href="../categories_page.php?cat_name=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a></td>
			<td><a href="../author_post.php?author_name=<?php echo $post_author_name; ?>"><?php echo $post_author_name; ?></a></td>
			<td> <img src="../images/<?php echo $post_image ?>" height="40px" width="40px"></td>
			<td><?php echo $post_views ?></td>
			<td><?php echo $post_date ?></td>
			
			
			
			</tr>

		<?php } ?>
			</table>



			</div>









<?php require './includes/footer.php'; ?>
