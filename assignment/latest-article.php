<?php session_start(); ?>
<?php require_once './includes/header.php';  ?>
<?php require_once './includes/navigation.php'; ?>
<img src="./images/banners/randombanner.php"   style="height:140px;width: 100%"  />



<div class="article_part_body">
  <h2>Latest Post: 
  </h2> 
  <div class="article_part">
   <?php 
   //getting data /posts from the posts table according to post id and applying limit of 3

$stmt3 = $pdo -> prepare ("SELECT * FROM posts ORDER BY post_id DESC LIMIT 0,3");
$stmt3->execute();
while ( $post_data = $stmt3-> fetch(PDO::FETCH_ASSOC)) {
$post_title_name = $post_data['post_title'];
$post_details = substr($post_data['post_detail'], 0,150) ;
$post_author_name = $post_data['post_author'];
$post_date = $post_data['post_date'];
$post_cat = $post_data['post_category'];
$post_views =$post_data['post_views'];
$post_image =$post_data['post_image']; 
$post_ids =$post_data['post_id'];
$total_post = $stmt3 -> rowCount();
?>
    <div class="latest-main-article"> 
      <div class="post-title"> <a href="./single-post-page.php?post_id=<?php echo $post_ids ?>"><h2><?php echo $post_title_name; ?> </h2></a>   </div> <br>
    <img alt="Post Image is loading" src="./images/<?php echo $post_image ?>" style="height: 200px; width: 350px;margin-left: 23%; margin-top: 0px">
<div class="latest-post-other-details">
  <span class="post-author pv">Author: <a href="./author_post.php?author_name=<?php echo $post_author_name; ?>"><?php echo $post_author_name; ?></a>:  </span> 
    <span class="post-views pv"> post views: <?php echo $post_views; ?>  :</span>
    <span class="post-date pv">   Post Date: <?php echo $post_date; ?></span><br>
    <span class="post-category pv">Category: <a href="./categories_page.php?cat_name=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a></span>

</div>
       <p class="post-details"> <?php echo $post_details; ?></p>
  </div><hr>



<?php
}
 ?> 
</div>



<?php require_once './includes/footer.php'; ?>