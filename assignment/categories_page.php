<?php //var_dump($_GET);die();?>
<?php session_start(); ?>
<?php require_once './includes/header.php';  ?>
<?php require_once './includes/navigation.php'; ?>


<img src="./images/banners/randombanner.php"   style="height:140px;width: 100%"  />



<?php
// $stmt3 = $pdo -> prepare ("SELECT * FROM posts");
// $stmt3->execute(); 
// $total_post = $stmt3 -> rowCount();
 ?>

   <!-- <div class="total_post">
     <h3>Total post : <?php echo $total_post ; ?></h3>
   </div> -->
<div class="total_post">
     <h3>All post of category: <?php echo $_GET['cat_name'] ; ?></h3>
   </div>

  <div class="article_part">
  
<div class="article_part_body"> 
 

<?php 
$cate_name=$_GET['cat_name'];
if (!$_GET['cat_name']) {
  $wrong="Wrong URL Parameter";
  header("Location: ./index.php");
}else{
//getting/fetching post of a specific category using category table
$stmt30 = $pdo -> prepare ("SELECT * FROM posts WHERE post_category=:cat");
$stmt30->execute([':cat' => $cate_name]);
while ( $cat_post_data = $stmt30-> fetch(PDO::FETCH_ASSOC)) {
$post_title_name = $cat_post_data['post_title'];
$post_details = substr($cat_post_data['post_detail'], 0,150) ;
$post_cat =$cat_post_data['post_category'];
$post_auth_name = $cat_post_data['post_author'];
$post_date = $cat_post_data['post_date'];
$post_views =$cat_post_data['post_views'];
$post_image =$cat_post_data['post_image']; 
$post_ids =$cat_post_data['post_id'];
?>
    <div class="latest-main-article"> 
      <div class="post-title"> <a href="./single-post-page.php?post_id=<?php echo $post_ids; ?>"><h2><?php echo $post_title_name; ?> </h2></a>   </div> <br>
    <img alt="Post Image is loading"  src="./images/<?php echo $post_image ?>" style="height: 200px; width: 350px;margin-left: 23%; margin-top: 0px">
<div class="latest-post-other-details">
  <span class="post-author pv">Author: <a href="./author_post.php?author_name=<?php echo $post_auth_name; ?>"><?php echo $post_auth_name; ?></a>: </span> 
    <span class="post-views pv"> post views: <?php echo $post_views; ?>  :</span>
    <span class="post-date pv">   Post Date: <?php echo $post_date; ?></span><br>
    <span class="post-category pv">Category: <a href="./categories_page.php?cat_name=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a></span>

</div>
       <p class="post-details"> <?php echo $post_details; ?></p>
  </div><hr>
<?php
}}
 ?> 

</div>
<?php require_once './includes/footer.php';  ?>