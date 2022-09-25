		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
		<div class="add-admin-form">



<article>
		<h2>Edit/update Admin Account</h2>

<?php 

if (isset($_POST['submit'])) {
	$uname = $_POST['username'];
	$useremail = $_POST['user-email'];
	$userrole = $_POST['user-role'];
	$profile_pic = $_FILES['profilePic']['name'];
	$profile_pic_temp = $_FILES['profilePic']['tmp_name'];
    move_uploaded_file("{$profile_pic_temp}", "../images/{$profile_pic}");
	$password = $_POST['New-User-Password'];
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    // $uid=$_SESSION['user_id'];
    $uid1 = $_GET['user_id'];
    date_default_timezone_set('Asia/Kathmandu');


    $insert_user_query = "UPDATE users SET username = :user_name, user_role = :usrrole, email = :user_email, registered_on = :date, user_profile_photo = :user_photo, password= :user_password WHERE id = :userid ";
    $stmt5 = $pdo->prepare($insert_user_query);
    $stmt5 -> execute([
     ':userid' => $uid1 ,
     ':user_name'=> $uname,
     ':usrrole'=> $userrole,
     ':user_email'=>$useremail,
     ':date'=> date("F j, Y, g:i a"),
     ':user_photo'=> $profile_pic,
     ':user_password'=> $hash_password, 
     
    ]);
    header("Location:view_admin.php");
    
   

   
      
}


        $uid = $_GET['user_id'];
        $get_from_user = "SELECT * FROM users WHERE id= :id ";
		$get = $pdo -> prepare($get_from_user);
		$get->execute([':id' => $uid]);
		$result = $get->fetch(PDO::FETCH_ASSOC) ;
		$username= $result['username'];
		$user_email=$result['email'];
 ?>



		<form action="./edit_admin.php?user_id=<?php echo $uid ?>" method="post" enctype="multipart/form-data">
			<?php  ?>
			<!-- <p>Forms are styled like so:</p> -->
			<label>Username: </label> <input type="text" name="username" value="<?php echo $username ;?>" /><br>
			<?php if (isset($email_error)) {
				echo "Email already exits!! Try Other Email";
			} ?>
			<label>User-Email: </label> <input type="email" name="user-email" value="<?php echo $user_email ;?>" /><br>
			
<?php if (isset($_SESSION['login']) && $_SESSION['user_role']=='news-poster-admin'){

}elseif (isset($_SESSION['login']) && $_SESSION['user_role']=='admin') {
	echo'<label for="user-role_lable">User-role: </label>
	<select name="user-role"> 
             <option value="admin" >Admin</option>
             <option value="news-poster-admin" >News Poster Admin</option>
             <option value="subscriber">Subscriber</option>
             </select>';
} ?>
             

			<label for="profilePic">Choose Profile image: </label> 
			<input type="file" name="profilePic" /><br>

		    <label>New-User-Password: </label> 
		    <input type="text" name="New-User-Password" />
			<input type="submit" name="submit" value="Update Account" />
		</form>
	</article>




		</div>



		<?php require './includes/footer.php'; ?>
