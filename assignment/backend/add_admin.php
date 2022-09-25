		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>


			<?php require_once './includes/left-panel.php' ?>

			<?php require_once './includes/right-panel.php' ?>
		  

		<div class="add-admin-form">



<article>
		<h2>Add New Admin/Subscriber</h2>

<?php 
if (isset($_POST['submit'])) {//if the submit button is pressed the run this if statement
	$username = $_POST['username'];//store the username in username variable
	$useremail = $_POST['user-email'];//store the user-email in useremail variable
    //check if email already exit or Not
    $cekemailQuery = "SELECT * FROM users WHERE email= :user_Email";
    $cekemail = $pdo -> prepare($cekemailQuery);
    $cekemail->execute([':user_Email' => $useremail]);
    $email_count = $cekemail -> rowCount();
    if ($email_count >= 1) {//if the email is already exit the this commage will run
    	$email_error = "Email already Exit!! Try other email";
        

    } 
    if (!isset($email_error)){// is not any error is displayed or occored then run this if statement
    $userrole = $_POST['user-role'];//store user role in userrole variable
	
	date_default_timezone_set('Asia/Kathmandu');// function for getting the current time of my location i.e nepal/kathmandu

    	// $profile_pic = $_FILES['profilePic']['name'];
    	if (!empty($profile_pic = $_FILES['profilePic']['name'])) {//if the profile image is empty the set the default image
    		$profile_pic = $_FILES['profilePic']['name'];
    	}else{
    		$profile_pic="default-profile-image.png";
    	}
	$profile_pic_temp = $_FILES['profilePic']['tmp_name'];
    move_uploaded_file("{$profile_pic_temp}", "../images/{$profile_pic}");//move tthe files/images in the given profile picture
	$password = $_POST['New-User-Password'];//storing the inserted password in the a password variable
    $hash_password = password_hash($password,PASSWORD_DEFAULT);// hashing the user passwor for security purpose
    //Storing the insert into users command/query in the insert_user_query variable. 
    $insert_user_query = "INSERT INTO users (username, user_role, email, registered_on, user_profile_photo, password) VALUES (:user_name,:userrole, :user_email, :reg_date, :user_photo, :user_password)";
    $stmt5 = $pdo->prepare($insert_user_query);
    $stmt5->execute([
     ':user_name'=> $username,
     ':userrole'=> $userrole,
     ':user_email'=>$useremail,
     ':reg_date'=> date("F j, Y, g:i a"),
     ':user_photo'=>$profile_pic,
     ':user_password'=> $hash_password, 
    ]);
    header("Location:view_admin.php");
    }   
}

 ?>

		<form action="add_admin.php" method="post" enctype="multipart/form-data">
			<!-- <p>Forms are styled like so:</p> -->
			<label>Username: </label> <input type="text" name="username" /><br>
			<?php if (isset($email_error)) {
				echo "Email already exits!! Try Other Email";
			} ?>
			<label>User-Email: </label> <input type="email" name="user-email" /><br>
			<label for="user-role_lable">User-role: </label>

             <select name="user-role"> 
             <option value="admin" >Admin</option>
             <option value="news-poster-admin" >News Poster Admin</option>
             <option value="subscriber">Subscriber</option>
             </select>

			<label for="profilePic">Choose Profile image: </label> 
			<input type="file" name="profilePic" /><br>

		    <label>New-User-Password: </label> 
		    <input type="password" name="New-User-Password" />
			<input type="submit" name="submit" value="Add User" />
		</form>
	</article>




		</div>



		<?php require './includes/footer.php'; ?>
