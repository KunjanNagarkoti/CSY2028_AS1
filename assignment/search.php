?php session_start(); ?>
<?php require_once './includes/header.php';  ?>
<?php require_once './includes/navigation.php'; ?>


<!-- <img src="./images/banners/randombanner.php"   style="height:140px;width: 100%"  /> -->



<?php 

if (isset($_POST['search'])) {//if the search button is clicked
    
	$search_text= $_POST['search'];//the searched details will store in $search_text variable
	if ($search_text == "") {//if search is empty redirect to the home page i.e index.html
		header("Location:index.php");
	}
//the query for search field wher the search text is Like title
    $search_query = "SELECT * FROM posts WHERE post_title LIKE :title";
    $stmt8 = $pdo->prepare($search_query);// prepaing for executing
    $stmt8 ->execute([//executing the query
        ':title'=>'%'.trim($search_text).'%'
    ]);
    $total_post_found =0;//initilizing the total_post_found
    $found_post_count =$stmt8->rowCount();//counting total post found
    if ($found_post_count ==0) {//if the post is 0 total_post_found is set to 0
    	     $total_post_found =0;

    }else{// else set to counted result
    	$total_post_found =$found_post_count ;
    }


}else{//if the search is empty redirect ot index /home page

	header("Location:./index.php");
}
 ?>


<div class="searched_result">
	<H2>Search Reasult for : <?php echo $search_text; ?></H2>
	 <h3>Total found post: <?php  echo $total_post_found; ?></h3>  
</div>



  <div class="article_part">
  
<div class="article_part_body"> 
 

<?php 

//getting the post related to the searched text
   $search_query = "SELECT * FROM posts WHERE post_title LIKE :title ORDER BY post_id DESC";
    $stmt8 = $pdo->prepare($search_query);
    $stmt8 ->execute([
        ':title'=>'%'.trim($search_text).'%'
    ]);
    $found_post_count =$stmt8->rowCount();
    if ($found_post_count ==0) {
           // $no_post="no_post";
    	    echo "<div><h1>No Post Found...</h1></div>";

    }
    //running the while loop, for the repeating the query
while ( $post_data = $stmt8-> fetch(PDO::FETCH_ASSOC)) {
$post_title_name = $post_data['post_title'];
$post_details = substr($post_data['post_detail'], 0,300) ;
$post_author_name = $post_data['post_author'];
$post_cat = $post_data['post_category'];
$post_date = $post_data['post_date'];
$post_views =$post_data['post_views'];
$post_image =$post_data['post_image']; 
$post_ids =$post_data['post_id'];


?>

   <div class="latest-main-article"> 
      <div class="post-title"> <a href="./single-post-page.php?post_id=<?php echo $post_ids ?>"><h2><?php echo $post_title_name; ?> </h2></a>   </div> <br>
    <img  alt="Post Image is loading" src="./images/<?php echo $post_image ?>" style="height: 200px; width: 350px;margin-left: 23%; margin-top: 0px" >
<div class="latest-post-other-details">
  <span class="post-author pv">Author: <a href="./author_post.php?author_name=<?php echo $post_author_name; ?>"><?php echo $post_author_name; ?></a>:  :  </span> 
    <span class="post-views pv"> post views: <?php echo $post_views; ?>  :</span>
    <span class="post-date pv">   Post Date: <?php echo $post_date; ?></span><br>
    <span class="post-category pv">Category: <a href="./categories_page.php?cat_name=<?php echo $post_cat; ?>"><?php echo $post_cat; ?></a></span>

</div>
       <p class="post-details"> <?php echo $post_details; ?></p>
  </div><hr>
<img src="#" alt="">


<?php
}
 ?> 
</div>


<?php require_once './includes/footer.php';  ?>