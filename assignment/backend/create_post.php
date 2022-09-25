		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
		<?php require_once './includes/left-panel.php' ?>

			<?php require_once './includes/right-panel.php' ?>
		  

		<div class="add-admin-form">
<article>
		<h2>Add New Post here</h2>

<?php 
if (isset($_POST['submit'])) {// if the submit buttom is pressed the the if statement will run for storeing the post in the posts table
	$news_title = $_POST['news_title'];//storing the new post title to news_title vaiable
	$post_cat = $_POST['post_cat'];//storing the new post category to post_cat vaiable
    $post_details = $_POST['post-details'];//storing the new post details to post_details vaiable
    $pic_news = $_FILES['news_pic']['name'];
    $pic_news = $_FILES['news_pic']['name'];
    $news_pic_temp = $_FILES['news_pic']['tmp_name'];
       move_uploaded_file("{$news_pic_temp}", "../images/{$pic_news}");//for moving the file/image inthe given path
   date_default_timezone_set('Asia/Kathmandu');//function for gettig the current date an d the time

// Query for inserting the posts inthe posts table 
    $insert_post_query = "INSERT INTO posts (post_title, post_detail, post_image, post_category,post_date, post_author) VALUES (:title,:detail, :image, :cat_name, :reg_date, :creator)";
    $stmt5 = $pdo->prepare($insert_post_query);
    $stmt5->execute([
     ':title'=> $news_title,
     ':detail'=> $post_details,
     ':image'=>$pic_news,
     ':cat_name'=>$post_cat,
     ':reg_date'=> date("F j, Y, g:i a"),
     // ':reg_date'=> date("M n, Y"),
     ':creator'=> $_SESSION['user_name'],
    ]);
    header("Location:create_post.php");
       
}

 ?>

		<form action="create_post.php" method="post" enctype="multipart/form-data">
			<label>News-Tilte: </label> <input type="text" name="news_title" /><br>
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
		    <textarea rows="4" cols="50" name="post-details"></textarea> 
			<input type="submit" name="submit" value="Create Post" />
		</form>
	</article>




		</div>



		<?php require './includes/footer.php'; ?>
