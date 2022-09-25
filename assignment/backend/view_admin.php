
<?php require_once './includes/header.php'; ?>
			<?php require_once './includes/navigation.php' ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
           

           <div class="cat-list">
<!-- This part of table html code is taken from https://www.w3schools.com/html/html_tables.asp website on 02-jan-2021  -->




			
			<table  class="cat-table" style="width:100%" align="center">
			
            <h3>View/Edit/Update Admins</h3>

			<tr>
			<th>user <br> ID</th>
			<th>User <br> Name</th>
			<th>User <br> Role</th>
			<th>User email</th>
			<th>registered<br>on</th>
			<th>Profile <br>Pic </th>
			<th>Edit</th>
			<th>Delete</th>
			
			</tr>



			<?php 
//getting all the user/admins form the user table in the tabular form
		$get_from_user = "SELECT * FROM users ";
		$get = $pdo -> prepare($get_from_user);
		$get->execute();
		while ($result = $get->fetch(PDO::FETCH_ASSOC)) {
	    $user_id= $result['id'];
		$username= $result['username'];
		$user_role= $result['user_role'];
		$user_email=$result['email'];
		$user_photo=$result['user_profile_photo'];
		$registered_on=$result['registered_on'];	
			?>

           <tr>
			<td><?php echo $user_id ?></td>
			<td><?php echo $username ?></td>
			<td><?php echo $user_role ?></td>
			<td><?php echo $user_email ?></td>
			<td><?php echo $registered_on ?></td>
			<td> <img src="../images/<?php echo $user_photo ?>" height="50px" width="50px"></td>
			<td><a href="./edit_admin.php?user_id=<?php echo $user_id ?>">Edit</a></td>
			<td><a href="./delete.php?user_id=<?php echo $user_id ?>">Delete</a></td>
			
			
			
			</tr>

		<?php } ?>
			</table>



			</div>









<?php require './includes/footer.php'; ?>
