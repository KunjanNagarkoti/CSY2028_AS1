		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
		<div class="add-admin-form">
<?php 
if (isset($_POST['submit_add_category'])) {// is the submit category buttom is got pressed then run this if statement 

	$new_cat_name =trim($_POST['add_cat']);//storing the given input category in a new_cat_name variable

	if ($new_cat_name == "") {//if the category field is empty and pressed add button the referesh the same page
		header("location:add_category.php");
	}
	////query for checking if the inserted catecory is already inthe database or not
    $cekCatQuery = "SELECT * FROM categories WHERE category_name= :cat_name";
    $cekCat = $pdo -> prepare($cekCatQuery);
    $cekCat->execute([':cat_name' => $new_cat_name]);
    $cat_count = $cekCat -> rowCount();
    if ($cat_count >= 1) {// if already existed the category the error will say allready exit!! can not make another category
    	$cat_error = "Already Exist!! Can not make Another Category.";
    	echo $cat_error;
       
    } elseif (!isset($cat_error)){//if no occur any erro then this id statement will run. 

    	date_default_timezone_set('Asia/Kathmandu');//function for getting my location current time and date
	//query for inserting data in to the categories table
    $insert_cat_query = "INSERT INTO categories (category_name, created_by,created_on) VALUES (:cat_name,:creator,:date)";
    $stmt5 = $pdo->prepare($insert_cat_query);
    $stmt5->execute([
     ':cat_name'=> $new_cat_name,
     ':creator'=>$_SESSION['user_name'],
     ':date'=> date("F j, Y, g:i a")
    ]);

    header("location:view_edit_category.php");
    } 
}

 ?>
	<article>
				<h2>Add New Category here</h2>
				<form action="add_category.php" method="post">
					<label>Add New Category: </label> <input type="text" name="add_cat" /><br>
					<input type="submit" name="submit_add_category" value="Add New Category" />
				</form>
			</article>




		</div>



		<?php require './includes/footer.php'; ?>

