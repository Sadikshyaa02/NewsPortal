<?php

//starting the session
		session_start();

		//title for page
		$pagetitle = 'Edit Category';

		//connecting page to database
		require 'database.php';

		// admin is login 
		if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {


			//content for page
		$pagecontent = '<h2>Select a Category to Edit</h2>

		<!--using form-->
		<form class="form" action="categoryEdit.php" method="GET">

		<!--using label-->
				<label>Select Category:</label>
				<select name="editName">
					<option value="" disabled selected> Select</option>';

						//querying for selecting  articles 
						$sadistmt = $db->prepare('SELECT * FROM category');

						//executing the statemnet
						$sadistmt -> execute();

						foreach ($sadistmt as $sadirow)
						//more content
						{
							$pagecontent = $pagecontent. '
							<option value="' . $sadirow['name'] . '">' . $sadirow['name'] . '</option>';
						}

		//content for page continues
		$pagecontent =$pagecontent . '
					</select>

					<input type="submit" value="Edit" name="submit" />
				</form>
		';

		if(isset($_GET['editName']))
		//////////
		{
			$editName = $_GET['editName'];


			// moving to another page
			echo("<script>location.href = 'editCategory.php?editName=$editName';</script>");
		}

		//Ending the page
		}
		else {
			echo '<li><a href = "login.php">  login as admin first </a></li>';
		}

//using setup.php for layout
		require 'setup.php';
	?>