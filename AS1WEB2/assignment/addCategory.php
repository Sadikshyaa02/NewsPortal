<?php

//starting the session
session_start();

	// title for the page
	$pagetitle = 'Add  Category';

//connecting to database
require 'database.php';

//Whether admin is login or not
if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

	// html for page
	//content for the page
	$pagecontent = '
	<h2>Add  Category</h2>
	<article>

	<!--using form-->
	<form class="form" action="addcategory.php" method="post">
			<label>CategoryName:</label>
					<input type="text"  name="name" required />
	    <label>CategoryDescription:</label>
	    		<textarea name="description" required ></textarea>
	    <input type="submit" value="Add" name="add" />
	</form>
	';

	//task to be done  when add btn is pressed
	if(isset($_POST['add'])){

		// using asset
		if (isset($_POST['name'], $_POST['description'])) {

			

				//query for adding a new category name & description 
				$sadistmt = $db->prepare('INSERT INTO category (name, description) VALUES (:name, :description)');

				$sadicriteria = [
					'name' => $_POST['name'],
					////////
					'description' => $_POST['description']
					////////
				];
                
				//using try catch
				try{
				$sadistmt -> execute($sadicriteria);

				// alert statement when category is added
				// using javascript
				echo '<script type="text/javascript">
				<!--alert stmt-->
					alert(" category \'' . $_POST['name'] . '\' is added");
				</script>';

			} 
			//for any error
			catch (PDOException $e) {
			   if ($e->errorInfo[1] == 1062) {

			   	// alert stmt if exception arises
			      echo '<script type="text/javascript">

				  <!--alert stmt-->
					alert("Category \'' . $_POST['name'] . '\' is already found in database.");
				</script>';
			   } else {


			   	// alert for other error
			      echo '<script type="text/javascript">
                <!--alertstmt-->
					alert("Error : ' . $e->getMessage() . '");
					</script>';
			   }
			}	          

		}
	}
}
	//When admin don't log in
	else {
		header("Location: login.php");
	}

// using setup.php for layout 
require 'setup.php';
?>