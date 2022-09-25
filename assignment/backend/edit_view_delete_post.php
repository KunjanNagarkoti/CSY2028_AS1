
		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
		
<table  class="cat-table" style="width:100%" align="center">
			
            <h3>My all Posts</h3>

			<tr>
			<th>post <br>Title </th>
			<th>Post <br>image </th>
			<th>Post <br>category</th>
			<th>Post <br>Comment</th>
			<th>Post <br>views</th>

			<th>Edit</th>
			<th>Delete</th>
			
			</tr>



			<?php 
		$get_from_user = "SELECT * FROM posts WHERE post_author=:auth ";
		$get = $pdo -> prepare($get_from_user);
		$get->execute([':auth'=>$_SESSION['user_name']]);
		while ($result = $get->fetch(PDO::FETCH_ASSOC)) {
        $post_title_name = substr($result['post_title'], 0,80);
        $post_author_name = $result['post_author'];
        $post_cat = $result['post_category'];
        $post_views =$result['post_views'];
        $post_image =$result['post_image']; 
        $post_comm =$result['post_comment'];
        $post_id =$result['post_id'];
			?>

           <tr>
			<td><a href="../single-post-page.php?post_id=<?php echo $post_id ?>"><?php echo $post_title_name ?></a></td>
			<td> <img src="../images/<?php echo $post_image ?>" height="50px" width="50px"></td>
			<td><?php echo $post_cat ?></td>
			<td><?php echo $post_comm ?></td>
		    <td><?php echo $post_views ?></td> 
			<td><a href="./edit_post.php?post_id=<?php echo $post_id ?>">Edit</a></td>
			<td><a href="./edit_view_delete_post.php?post_id=<?php echo $post_id ?>">Delete</a></td>
			
			
			
			</tr>

		<?php } ?>
			</table>


      <?php 
        if (isset($_GET['post_id'])) {
        $postid = $_GET['post_id'];
		$query2= "DELETE FROM posts WHERE post_id=:pt_id  ";
		$stmt31 = $pdo -> prepare ($query2);
		$stmt31->execute([':pt_id' => $postid]);
		header("Location:./edit_view_delete_post.php");
				}
       ?>
		<?php require './includes/footer.php'; ?>

