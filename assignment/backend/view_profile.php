
		<?php require_once './includes/header.php'; ?>
		<?php require_once './includes/navigation.php'; ?>


		<?php require_once './includes/left-panel.php' ?>

		<?php require_once './includes/right-panel.php' ?>
		<div class="profile_details">
		<div class="profile_info">
		<?php 

		$get_from_user = "SELECT * FROM users WHERE id= :user_id";
		$get = $pdo -> prepare($get_from_users);
		$get->execute([':user_id' => $_SESSION['user_id']]);
		$result = $get->fetch(PDO::FETCH_ASSOC);
		$username= $result['username'];
		$user_role= $result['user_role'];
		$user_email=$result['email'];
		$user_photo=$result['user_profile_photo'];
		$registered_on=$result['registered_on'];

		?>


		<h2>Your Profile Details:  </h2><hr>
		<h3>UserName: <?php if (isset($_SESSION['login'])) {
		echo $_SESSION['user_name'] ;
		} ?> </h1><br>
		<h3>Email-address: <?php echo $user_email; ?> </h3><br>
		<h3>Registered date:  <?php echo $registered_on ?> </h3><br>
		<h3>Role: <?php echo $user_role ?> </h3>

		</div>
		<div>
		<img src="../images/<?php echo $user_photo ?>" style="height: 250px;width: 250px; " class="profile_img">
		</div>


		</div>
		<?php require './includes/footer.php'; ?>


