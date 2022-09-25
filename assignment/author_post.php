<?php //var_dump($_GET);die();?>
<?php session_start(); ?>
<?php require_once './includes/header.php';  ?>
<?php require_once './includes/navigation.php'; ?>


<img src="./images/banners/randombanner.php"   style="height:140px;width: 100%"  />

<div class="total_post">
     <h3>All post by Author:: <?php echo $_GET['author_name'] ; ?></h3>
   </div>
  <div class="article_part">
  
<div class="article_part_body"> 
 

<?php 
$auth_name=$_GET['author_name'];
if (!$_GET['author_name']) {
  $wrong="Wrong URL Parameter";
  header("Location: ./index.php");
}else{
//getting/fetching post of a specific table from the posts table 
$stmt30 = $pdo -> prepare ("SELECT * FROM posts WHERE post_author=:auth");
$stmt30->execute([':auth' => $auth_name]);
while ( $auth_post_data = $stmt30-> fetch(PDO::FETCH_ASSOC)) {
$post_title_name = $auth_post_data['post_title'];
$post_details = substr($auth_post_data['post_detail'], 0,150) ;
$post_author_name = $auth_post_data['post_author'];
$post_cat = $auth_post_data['post_category'];
$post_date = $auth_post_data['post_date'];
$post_views =$auth_post_data['post_views'];
$post_image =$auth_post_data['post_image']; 
$post_ids =$auth_post_data['post_id'];
?>
<div class="latest-main-article"> 
      <div class="post-title"> <a href="./single-post-page.php?post_id=<?php echo $post_ids ?>"><h2><?php echo $post_title_name; ?> </h2></a>   </div> <br>
    <img alt="Post Image is loading" src="./images/<?php echo $post_image ?>" style="height: 200px; width: 350px;margin-left: 23%; margin-top: 0px">
<div class="latest-post-other-details">
  <span class="post-author pv">Author: <a href="author_post.php?author_name=<?php echo $post_author_name; ?>"><?php echo $post_author_name; ?></a>:  :  </span> 
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