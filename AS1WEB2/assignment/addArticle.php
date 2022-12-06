<?php
	//starting the session
	session_start();

	// title Fo the page
	$pagetitle = 'Add  Article';

	//connecting database to file
	require 'database.php';

	// stmt when the admin is log in
	if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true)
	{

		// html form for  adding  a  article
		//comtemt for the page
		$pagecontent = '
		<h2>Add  Article</h2>
		<article>

		<!--using form-->
		<form class="form" action="addArticle.php" method="post" 
		
		enctype="multipart/form-data">

		<!--label for title-->
			<label>Title:</label>
			<input type="text" name="title" required />

			<!--label for category-->	
			<label>Category:</label>
			<select name="category" required>

			<!--optional value-->
			<option value="" disabled selected> Select</option>';
		
		// selecting to choose a category
		//query stmt for selecting a category
		$sadiresults = $db->prepare('SELECT * FROM category');

		//executing the stmt
				$sadiresults->execute();


				//using foreach
		foreach
		
		($sadiresults as $sadirow) {
			$pagecontent = $pagecontent . '
				<option value="'. $sadirow['name'].'">'. $sadirow['name'].'</option>
			';
		}
//continuing with contents for page
		$pagecontent = $pagecontent . '
			</select>
			<label>Content:</label>
	    	<textarea name="content" required></textarea>
			<label>Image:</label>
			<input type ="file" name="image">
			<input type="submit" value="Add" name="add" />
		</form>
		</article>
  		';


  		if(isset($_POST['add'])){
	  		if (isset($_POST['title'], $_POST['category'], $_POST['content'])) {
	  			
	  			$title = $_POST['title'];

				//date for publishment
	  			$date = date('y-m-d');

	  			//giving the nAme, pAth and temporry dir of image
	  			$image = $_FILES['image']['name'];
	  			$image_path = 'artimage/' . $image . '';
	  			$tmp_dir = $_FILES['image']['tmp_name'];

	  			$publisher_id = $_SESSION['admin_id'];

	  			//giving the name of admin 
				//stmt for query for selecting from admin table
	  			$convert_id = $db->prepare('SELECT email FROM admins WHERE admin_id="' . $publisher_id . '"');

				//executing the stmt
			      $convert_id -> execute();

				  //using for each stmt

				  //usn=ing each stmt
			      foreach ($convert_id 
				  //////
				  as
				  //////
				   $convert_email) {

					///////////
			          $publisher 
					  = 
					  $convert_email['email'];
			      }

			    

	  			//querying  to add a article
	  			$sadistmt = $db->prepare('INSERT INTO article (title, category, content, published_date, image, publisher) VALUES ( :title, :category, :content, :published_date, :image, :publisher)');

				//providing the criteria
	  			$sadicriteria  = [
	  				'title' => $_POST['title'],
	  				'category' => $_POST['category'],
	  				'content' => $_POST['content'],
	  				'published_date' => $date,
	  				'image' => $image_path,
	  				'publisher' => $publisher
	  			];

				//using try catch
	  			try{

					//executing the stmt
				$sadistmt -> execute($sadicriteria);

				//copying the temp location of image file 
	  			if(copy($_FILES['image']['tmp_name'], $image_path))
	  			{

	  			}

				// alert statement 
				//for adding the article 
				echo '<script type="text/javascript">
				<!--alert stmt-->
				  alert(" Article is added ");
				</script>';

				} 
				
				//fpr any other error
				catch (PDOException $e) {
				   if ($e->errorInfo[1] == 1062) {


				   	//for showing other stmt
				      echo '<script type="text/javascript">
					  <!--alert stmt-->
						alert("This Article is  existes.");
						</script>';
				   } else {

				   	//alert stmt for more exCeption
				      echo '<script type="text/javascript">
						alert("Error : ' . $e->getMessage() . '");
						</script>';
				   }
				}				
				  
	  		}
  		}
	}

	//when admin has not log in
	else {
		header("Location: login.php");
	}

	// using setup.php for layout
	require 'setup.php';
?>