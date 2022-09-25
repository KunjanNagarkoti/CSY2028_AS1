<?php session_start(); ?>
<?php require_once './includes/header.php';  ?>
<?php require_once './includes/navigation.php'; ?>
<img src="./images/banners/randombanner.php"   style="height:140px;width: 100%"  />


<?php 
$update_views = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = :pid";
$stmt99 = $pdo -> prepare ($update_views);
$stmt99->execute([':pid'=>$_GET['post_id']]); 
?>


<?php 
if (!$_GET['post_id']) {//if post_id is get from the url parameter
  // $wrong="Wrong URL Parameter";
  // echo "<script>alert($wrong)</script>";
  // header("Location: ./index.php");
}else{
$id=$_GET['post_id'];
//code for getting post table data fro mthe database
$query= "SELECT * FROM posts WHERE post_id =:postid ";
$stmt3 = $pdo -> prepare ($query);
$stmt3->execute([':postid' => $id]);
$post_data = $stmt3-> fetch(PDO::FETCH_ASSOC); 
$post_title_name = $post_data['post_title'];
$post_details = $post_data['post_detail'] ;
$post_author_name = $post_data['post_author'];
$post_date = $post_data['post_date'];
$post_cat = $post_data['post_category'];
$post_views =$post_data['post_views'];
$post_image =$post_data['post_image']; 
$post_ids =$post_data['post_id'];
$total_post = $stmt3 -> rowCount();

if ($id == $post_ids ) {

}else{
  header("Location:./index.php");
}}
 ?>

<div class="article_part_body">
  </h2> 
  <div class="article_part">
    <div class="latest-main-article"> 
      <div class="post-title"> <a href="#"><h2><?php echo $post_title_name; ?></h2></a>   </div> <br>
    <img alt="Post Image is loading"  src="./images/<?php echo $post_image; ?>" style="height: 200px; width: 350px;margin-left: 23%; margin-top: 0px">
<div class="latest-post-other-details">
    <span class="post-author pv">Author: <a href="author_post.php?author_name=<?php echo $post_author_name; ?>"><?php echo $post_author_name; ?></a>:  </span> 
    <span class="post-views pv"> post views: <?php echo $post_views; ?>  :</span>
    <span class="post-date pv">   Post Date: <?php echo $post_date; ?></span><br>
    <span class="post-category pv">Category: <a href="./categories_page.php?cat_name=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a></span>
</div>
       <p class="post-details"> <?php echo $post_details; ?></p>
       
       <?php require_once './share-post.php'; ?><hr>


<?php if (isset($_POST['submit'])) {
  $comment_text= trim($_POST['comment_field']);
  $insert_comment_query = "INSERT INTO comments (comt_post_id, comt_detail, comt_user_name, comt_user_id, comt_date, comt_status) VALUES (:com_post_id,:com_details, :com_user_name, :com_user_id, :com_date, :com_status)";
    $stmt5 = $pdo->prepare($insert_comment_query);

   $stmt88 = $pdo->prepare("SELECT * FROM users WHERE id = :id");
   $stmt88->execute([':id'=>$_SESSION['user_id']]);
   $data = $stmt88-> fetch(PDO::FETCH_ASSOC); 
   $user_nam = $data['username'];

    $stmt5->execute([
     ':com_post_id'=> $_GET['post_id'],
     ':com_details'=> $comment_text,
     ':com_user_name'=>$user_nam,
     ':com_date'=> date("F j, Y, g:i a"),
     ':com_user_id'=>$_SESSION['user_id'],
     ':com_status'=>'unapproved', 
    ]);
  }
     ?>



<?php 
$get_com = "SELECT * FROM comments WHERE comt_status = :status AND comt_post_id = :com_p_id";
$stmt31 = $pdo->prepare($get_com);
$stmt31 ->execute([
':status'=>'approved',
':com_p_id'=> $_GET['post_id'],
]);

$com_count = $stmt31 ->rowCount();
if ($com_count == 0) {
  echo "No comments has been posted.....";
}else{

while ($comment = $stmt31-> fetch(PDO::FETCH_ASSOC)) {
  $com_id =$comment['comt_id'];
  $com_username =$comment['comt_user_name'];
  $com_date =$comment['comt_date'];
  $com_details =$comment['comt_detail'];
 ?>

<ul>
    <li><p><?php echo $com_details ?> <br>
By <?php echo $com_username." At ". $com_date ?> <br>
<a href="./single-post-page.php?post_id=<?php echo $post_ids.'&'.'rep_id='.$com_id ;?>" name="reply">Reply</a>
<?php 
if (isset($_GET['rep_id'])) {
echo 'replied';
}
 ?>

    </p></li>
  </ul>


<?php }} ?>





<?php if (isset($_SESSION['login'])) { ?>
  <hr>
    <form method="post" action="./single-post-page.php?post_id=<?php echo $post_ids ?>">


<label><h3>Comment on This Post Here :: </h3><br></label>
<textarea placeholder="Enter Comment For this post..." rows="4" cols="50" name="comment_field" style="margin-left: 20px; margin-top: -30px;  margin-bottom: 10px;"></textarea>
<br><button name="submit" type="submit" class="comt_bth">Post Comment</button>



  </form>
  <hr>
    <hr>
      <hr>
<?php
}else{?>
   <div class="cmt">
Login to Comment... <br><a href="./login.php">Click Here for login</a>  Not have Account??  <a href="./register.php">Register Here</a> </div>

<?php } ?>
      
  
  </div>

 
  <br>
  <hr>
</div>
<hr>
<hr>
<?php require_once './includes/footer.php'; ?>