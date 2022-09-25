
            <?php require_once './includes/header.php'; ?>
			<?php require_once './includes/navigation.php' ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
           

           <div class="cat-list">
<!-- This part of table html code is taken from https://www.w3schools.com/html/html_tables.asp website on 02-jan-2021  -->
			<table  class="cat-table" style="width:100%" align="center">
            <h3>View/Edit/Update All Category </h3>

			<tr>
			<th>Category <br> ID</th>
			<th>Category Name</th>
			<th>Created_By</th>
			<th>Created_On</th>
			<th>Edit<br>category</th>
			<th>Delete<br>category</th>
			</tr>
			<?php 

		$get_cat = "SELECT * FROM categories";
		$get = $pdo -> prepare($get_cat);
		$get->execute();
		while ($result = $get->fetch(PDO::FETCH_ASSOC)) {
		$cat_id= $result['category_id'];
		$cat_name= $result['category_name'];
		$created_by= $result['created_by'];
		$created_on= $result['created_on'];	?>

           <tr>
			<td><?php echo $cat_id ?></td>
			<td><?php echo $cat_name ?></td>
			<td><?php echo $created_by ?></td>
			<td><?php echo $created_on ?></td>
			<td><a href="./view_edit_category.php?cate_id=<?php echo $cat_id ;?>">Edit</a></td>
			<td><a href="./delete.php?cate_id=<?php echo $cat_id; ?>">Delete</a></td>
			</tr>

		<?php } ?>
			</table>






<?php 
if (!isset($_GET['cate_id'])) {
// echo "string";
}else{
        $get_cat_id = $_GET['cate_id'];
        $gt_cat = "SELECT * FROM categories WHERE category_id=:ct_id";
		$get = $pdo -> prepare($gt_cat);
		$get->execute([
       ':ct_id'=> $get_cat_id

		]);
		$resut = $get->fetch(PDO::FETCH_ASSOC);
		$cat_name= $resut['category_name']; ?>

				<form action="./view_edit_category.php?cate_id=<?php echo $get_cat_id ;?>" method="post">
					<p style="color: red;">Note: if you edit old_catagory which has its posts, then the old_post's category will replace with Newest one..</p>
				<label>Edit Category Here :</label>
				<input type="text" name="newcat" value='<?php echo $cat_name ;?>'/>
				<input type="submit" name="SubmitButon" value="Update" />
				</form> 
<?php }

 ?>

 
     <?php

if(isset($_POST['SubmitButon'])){ //
	$get_cat_id = $_GET['cate_id'];
	$new_cat = $_POST['newcat'];
    $old_cat_name =$cat_name;

	$up_cat_query = "UPDATE categories SET category_name = :ct_name WHERE category_id = :catid";
    $stmt55 = $pdo->prepare($up_cat_query);
    $stmt55 -> execute([
     ':catid' => $get_cat_id,
     ':ct_name'=> $new_cat,
    ]);
///Changing the Category of The post When the name of category having Post is Updated
    $up_post_cat = "UPDATE posts SET post_category = :pt_ct_name WHERE post_category = :oldcatname";
    $stmt555 = $pdo->prepare($up_post_cat);
    $stmt555 -> execute([
    	':pt_ct_name'=> $new_cat,
     ':oldcatname' => $old_cat_name ,
     
    ]);
    
   

}    
?>
			

			</div>
   







<?php require './includes/footer.php'; ?>
