		<?php require_once '../includes/dbconnection.php'; ?>

		<?php 

if ($_GET['cate_id']) {

	//if get cate_id from the url parameter then the following code will be executed
	    $id=$_GET['cate_id'];// store the got cate_id in teh id variable 
	    // query for getting category for delete wher cate id is the $id variable
		$get_cat = "SELECT * FROM categories WHERE category_id=:catt_id ";
		$get = $pdo -> prepare($get_cat);
		$get->execute([':catt_id' => $id]);
		$result = $get->fetch(PDO::FETCH_ASSOC) ;
		if ($result['category_total_post'] >=1) {// if the category contains some of its post then the alert will arear saying that, this catregory has some psot cannt delets it 

			echo '<script>
			alert("This category has Some post !! Can not delete");
			window.location.href="view_edit_category.php";
			</script>';

		
		}else {//if if not have any post in the category the run/execute the following commands
			//quey for deleting teh category where category id is the id from the url get cate_id variable
		$query= "DELETE FROM categories WHERE category_id =:catid ";
		$stmt3 = $pdo -> prepare ($query);
		$stmt3->execute([':catid' => $id]);
		header("Location:./view_edit_category.php");
		}
}elseif ($_GET['user_id']){
        $uid=$_GET['user_id'];
		$get_uid = "SELECT * FROM users WHERE id=:usr_id ";
		$getuid = $pdo -> prepare($get_uid);
		$getuid->execute([':usr_id' => $uid]);
		$result2 = $getuid->fetch(PDO::FETCH_ASSOC) ;
		if ($result2['id'] <1 ) {
		header("Location:view_admin.php") ; 
		}else {
		$query2= "DELETE FROM users WHERE id =:uid ";
		$stmt31 = $pdo -> prepare ($query2);
		$stmt31->execute([':uid' => $uid]);
		header("Location:./view_admin.php");

}
}else{
       echo '<script>
alert("Wrong Url Parameter");
window.location.href="index.php";
</script>';

}
				?>