
<article>
				<h2>Article</h2>
				<!-- <p>Post</p> -->
				

				<!-- <ul>
					<li>Add Article</li>
					
					<li>Log Out</li>
				</ul> -->


				<form action="admin.php" method="POST">	
					<p>Add Article</p>

					<label>Article Title</label> <input type="text" name="title"/>
					<label>Article Description</label> <textarea name="desc"></textarea>
					<label>Author</label> <input type="text" name="author">
					<label>Category</label>

						<select name="Category" id="category">
						<option value="Technology">Technology</option>
						<option value="Sports">Sports</option>
						<option value="Entertainment">Entertainment</option>
					
						</select>	
					

					<input type="submit" name="submit" value="submit" />
				</form>
			</article>
		
				
	<?php
    	 require_once '../dbconnect.php';
   				 if(ISSET($_POST['submit'])){
					
				 }

        $title = $_POST['title'];
        $desc = $_POST['desc'];
		$author = $_POST['author'];
	
		$sql = "INSERT INTO articles(title, desc, author)
           VALUES (:title, :desc, :author)');
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':desc' => $desc,
                ':author' => $author
            ]);

			}
			?>

			
		

