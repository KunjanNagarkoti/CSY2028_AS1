
<?php require_once './includes/header.php'; ?>
			<?php require_once './includes/navigation.php' ?>
			<?php require_once './includes/left-panel.php' ?>
			<?php require_once './includes/right-panel.php' ?>
           <div class="cat-list">
<!-- This part of table html code is taken from https://www.w3schools.com/html/html_tables.asp website on 02-jan-2021  -->			
			
 			<table  class="cat-table" style="width:100%" align="center">
           <h3>All Comments for your posts</h3>

			<tr>
			<th>Post<br>Title</th>
			<th>Coment's <br> details</th>
			<!-- <th>comment's <br>user </th> -->
			<th>comment's <br> date</th>
			<th>Status</th>
			<th>Permission</th>
			<th>Delete</th>
			</tr>
 

<?php 
$stmt3 = $pdo -> prepare ("SELECT * FROM comments");
// $stmt3 = $pdo -> prepare ("SELECT * FROM posts WHERE post_id :id");
$stmt3->execute();
while ( $commt_data = $stmt3-> fetch(PDO::FETCH_ASSOC)) {

$commt_id  =$commt_data['comt_id'];
$commt_details  =$commt_data['comt_detail'];
$commt_post_id  =$commt_data['comt_post_id'];
$commt_date  =$commt_data['comt_date'];
$commt_status  =$commt_data['comt_status'];
$commt_user_id  =$commt_data['comt_user_id'];

//getting the user name from user table
$stmt33 = $pdo -> prepare ("SELECT * FROM users WHERE id=:id");
$stmt33->execute([
':id'=>$commt_user_id,
]);
$user_data = $stmt33-> fetch(PDO::FETCH_ASSOC);
$user_name =$user_data['username'];
$user_id =$user_data['id'];

//getting post title from the post table
$stmt34 = $pdo -> prepare ("SELECT * FROM posts WHERE post_id=:id");
$stmt34->execute([
':id'=>$commt_post_id,
]);
$post_data = $stmt34-> fetch(PDO::FETCH_ASSOC);
$post_title_name = substr($post_data['post_title'], 0,30);

//delete the Comment by the post author
if (isset($_GET['com_id'])) {
	    $comt_post_id = $_GET['com_id'];
        $query2= "DELETE FROM comments WHERE comt_id =:cid ";
		$stmt31 = $pdo -> prepare ($query2);
		$stmt31->execute([':cid' => $comt_post_id]);
		header("Location:./post_comments.php");


//Approving Comments
}elseif (isset($_GET['approve'])){
 $update_status = "UPDATE comments SET comt_status = :comm_st WHERE comt_id =:id";
    $stmt5 = $pdo->prepare($update_status);
    $stmt5 -> execute([
     ':comm_st' => 'approved' ,
     ':id' => $_GET['approve'] ,
    ]);
    header("Location:./post_comments.php");

}



?>


           <tr>
			<td><a href="../single-post-page.php?post_id=<?php echo $commt_post_id ?>"><h4><?php echo $post_title_name; ?></td>
			<td><h4><?php echo $commt_details; ?> </h4></td>
			<!-- <td><a href="./view_user_comments.php?uid=<?php echo $user_id; ?>"><?php echo $user_name; ?></a></td> -->
			<td><?php echo $commt_date; ?></td>
			<td><?php echo $commt_status ?></td>
			<td><a href="./post_comments.php?approve=<?php echo $commt_id; ?>">
<?php 
if ($commt_status =='approved') {
	echo "Approved";
}else{ echo "Approve";}
 ?>
			</a></td>
			<td><a href="./post_comments.php?com_id=<?php echo $commt_id; ?>">Delete</a></td>
			<!-- <td><a href="./post_comments.php?comment_id=<?php echo $_GET['comt_post_id']; ?>">Delete</a></td> -->
			
			
			
			</tr>

		<?php } ?>
			</table>



			</div>










<?php require './includes/footer.php'; ?>
