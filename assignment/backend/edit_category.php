<!-- 		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
		<div class="add-admin-form">


<?php 
if (isset($_POST['submit_update_category'])) {
	if (!$_GET['cate_id']) {
		header("Location:view_edit_category.php");
	}else{
     // $cat_get_id = $_GET['cate_id']; 
	echo "<script>alert('hello');</script>";
	}
}
 ?>
	<article>
				<h2>Edit Category here</h2>
				<form action="edit_category.php" method="post">
					<label>Edit Category: </label> <input type="text" name="update_cat" value="" /><br>
					<input type="submit" name="submit_update_category" value="Edit/Update category" />
				</form>
			</article>




		</div>



		<?php require './includes/footer.php'; ?> -->