<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Northampton News - Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles.css'>
    <script src='main.js' defer></script>
</head>
	<?php require_once './include/header.php';?>

		<?php require_once './include/nav.php';?>
		<img src="images/banners/randombanner.php" />
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					<li><a href="#">Sidebar</a></li>
					<li><a href="#">Add Category</a></li>
					<li><a href="#">Be removed</a></li>
					<li><a href="#">When not needed</a></li>
				</ul>
			</nav>
		
	
		


				            
			  <div class="news">                    
				 <h2><a href="read-news.php?newsid=1">First news title here</a></h2>  
					   <p> This news short description will be displayed at this particular place. This news short description will be displayed at this particular place.</p>      
		 			<span>published on Jan, 12th 2015 by zooboole</span>  
       		 </div>                    
		 	<div class="news">  
	     	<h2><a href="read-news.php?newsid=2">Second news title here</a></h2>                  
		 	 <p>This news short description will be displayed at this particular place. This news short description will be displayed at this particular place.</p>    

		 		 <span>published on Jan, 12th 2015 by zooboole</span>  
			</div>    
			<div class="news"> 
			<h2><a href="read-news.php?newsid=3">Thirst news title here</a></h2>  
			<p>This news short description will be displayed at this particular place. This news short description will be displayed at this particular place.</p>  
			<span>published on Jan, 12th 2015 by zooboole</span> 
			</div>            
				<div class="news">
				<h2><a href="read-news.php?newsid=4">Fourth news title here</a></h2> 
						<p>This news short description will be displayed at this particular place. This news short description will be displayed at this particular place.</p>    
						<span>published on Jan, 12th 2015 by zooboole</span>    
							</div>     
						</div>        
						




		 </main>
		<?php require_once './include/footer.php';?>

		</body>

			<?php 
		require_once 'dbconnect.php';

		function fetchNews( $conn )
		{

			$request = $conn->prepare(" SELECT news_id, news_title, news_short_description, news_author, news_published_on FROM info_news ORDER BY news_published_on DESC ");
			return $request->execute() ? $request->fetchAll() : false; 
		}

		function getAnArticle( $id_article, $conn )
		{

			$request =  $conn->prepare(" SELECT news_id,  news_title, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id = ? ");
			return $request->execute(array($id_article)) ? $request->fetchAll() : false; 
		}

		function getOtherArticles( $differ_id, $conn )
		{
			$request =  $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id != ? ");
			return $request->execute(array($differ_id)) ? $request->fetchAll() : false; 
		}


	?>

	
</html>