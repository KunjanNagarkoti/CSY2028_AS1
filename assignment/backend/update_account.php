		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
		<div class="add-admin-form">



<article>
		<h2>Edit Your Account</h2>

<?php 
if (isset($_POST['submit'])) { //if buttom is pressed 
	$uname = $_POST['username'];
	$useremail = $_POST['user-email'];
    //check if email already exit or Not
    $cekemailQuery = "SELECT * FROM users WHERE email= :user_Email";
    $cekemail = $pdo -> prepare($cekemailQuery);
    $cekemail->execute([':user_Email' => $useremail]);
    $email_count = $cekemail -> rowCount();//check if having similar Email
    if ($email_count > 1) {
    	$email_error = "Email already Exit!! Try other email";
    } 


    if (!isset($email_error)){//if not set $email_error check session 
        if (isset($_SESSION['login']) && $_SESSION['user_role']=='news-poster-admin') {
  	$userrole = $_SESSION['user_role'];
  }elseif (isset($_SESSION['login']) && $_SESSION['user_role']=='admin'){
  	$userrole = $_POST['user-role'];
  }
    //setting variable for gatting from input field
	$profile_pic = $_FILES['profilePic']['name'];
	$profile_pic_temp = $_FILES['profilePic']['tmp_name'];
    move_uploaded_file("{$profile_pic_temp}", "../images/{$profile_pic}");
	$password = $_POST['New-User-Password'];
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    $uid=$_SESSION['user_id'];
   date_default_timezone_set('Asia/Kathmandu');
	

//UPdating the users table with new metadeta
    $insert_user_query = "UPDATE users SET username = :user_name, user_role = :usrrole, email = :user_email, registered_on = :date, user_profile_photo = :user_photo, password= :user_password WHERE id = :userid ";
    $stmt5 = $pdo->prepare($insert_user_query);
    $stmt5 -> execute([
     ':userid' => $uid ,
     ':user_name'=> $uname,
     ':usrrole'=> $userrole,
     ':user_email'=>$useremail,
     ':date'=> date("F j, Y, g:i a"),
     ':user_photo'=> $profile_pic,
     ':user_password'=> $hash_password, 
     
    ]);
    
   

   
    }   
}

//getting the information of user on input field whose date is being updated, so that we dont need to retype if not to update
        $get_from_user = "SELECT * FROM users WHERE id= :id ";
		$get = $pdo -> prepare($get_from_user);
		$get->execute([':id' => $_SESSION['user_id']]);
		while ($result = $get->fetch(PDO::FETCH_ASSOC)) {
		$username= $result['username'];
		$user_email=$result['email'];}


 ?>




		<form action="update_account.php" method="post" enctype="multipart/form-data">
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
