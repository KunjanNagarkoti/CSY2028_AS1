		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
		<?php require_once './includes/left-panel.php' ?>

			<?php require_once './includes/right-panel.php' ?>
		  

		<div class="add-admin-form">
<article>
		<h2>Edit Post here</h2>

<?php 

    $pt_id = $_GET['post_id'];

    

    if ((isset($_GET['post_id']) && (isset($_POST['submit'])))) {
    
    $news_title = $_POST['news_title'];
    $post_cat = $_POST['post_cat'];
    $post_details = $_POST['post-details'];
    $pic_news = $_FILES['news_pic']['name'];
    $pic_news = $_FILES['news_pic']['name'];
    $news_pic_temp = $_FILES['news_pic']['tmp_name'];
       move_uploaded_file("{$news_pic_temp}", "../images/{$pic_news}");

     $update_post_query = "UPDATE posts SET post_title = :pt_title, post_detail = :pt_details, post_image = :pt_image, post_category = :pt_category WHERE post_id = :pid ";
    $stmt51= $pdo->prepare($update_post_query);
    $stmt51 -> execute([
    ':pid'=> $pt_id,
     ':pt_title'=> $news_title,
     ':pt_details'=> $post_details,
     ':pt_category'=>$post_cat,
     ':pt_image'=> $pic_news,
      
     
    ]);
    header("Location:edit_view_delete_post.php");
    
    }

       


 ?>
  <?php 

            $get_post ="SELECT * FROM posts WHERE post_id =:pid";
            $stmt44 =$pdo ->prepare($get_post);
            $stmt44 ->execute(['pid'=> $pt_id]);
            $post_details = $stmt44 -> fetch(PDO::FETCH_ASSOC);
            $post_title =$post_details['post_title'];
            $post_detail =$post_details['post_detail'];


         ?>

		<form action="edit_post.php?post_id=<?php echo $pt_id; ?>" method="post" enctype="multipart/form-data">
			<label>News-Tilte: </label> <input type="text" name="news_title" value=" <?php echo $post_title ?>" /><br>
            <label>Select Category:</label>
             <select name="post_cat">
        <?php 
        $stmt3 = $pdo -> prepare ("SELECT * FROM categories");
        $stmt3->execute();
        while ( $category_item = $stmt3 -> fetch(PDO::FETCH_ASSOC)) {
        $cat_total_post = $category_item['category_total_post'];    
        $catagory_names= $category_item['category_name'];

        ?>
        <option value="<?php echo $catagory_names; ?>" ><?php echo $catagory_names; ?></option>

        <?php
        }
        ?>
             </select>
			<label for="news_pic">Choose news image: </label> 
			<input type="file" name="news_pic" /><br>
            
		    <label>News details: </label> 
		    <textarea style="color: #000" rows="4" cols="50" name="post-details" ><?php echo $post_detail ?> </textarea> 
			<input type="submit" name="submit" value="Update Post" />
		</form>
	</article>




		</div>



		<?php require './includes/footer.php'; ?>
