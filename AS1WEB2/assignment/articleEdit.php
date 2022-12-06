<?php

//starting the session
	session_start();

	//giving title to page
	$pagetitle = 'Edit Article';

	//connecting title to database
	require 'database.php';

	//seeing admin is logged in or not
	if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {


		//content for the page
	$pagecontent = '<h2>Select a Article to Edit</h2>

	<!--using form-->
	<form class="form" action="articleEdit.php" method="GET">

	<!--using label-->
			<label>Select Title:</label>
			<select name="editTitle">
				<option value="" disabled selected> Select</option>';

					//quering for  selecting all articles
					$sadistmt = $db->prepare('SELECT * FROM article');

					//executing the stmt
					$sadistmt -> execute();


					//using forEach
					foreach ($sadistmt as $sadirow)

					//more content
					{
						$pagecontent = $pagecontent. '
						<option value="' . $sadirow['title'] . '">' . $sadirow['title'] . '</option>';
					}

	//content for page  continues
	$pagecontent =$pagecontent . '
				</select>
				<input type="submit" value="Edit" name="submit" />
			</form>
	';

	// article to  edit 
	if (isset($_GET['editTitle'])) {

		$sadicurrentTitle = $_GET['editTitle'];
		
		//moving to other page
		echo("<script>location.href = 'editArticle.php?editTitle=$sadicurrentTitle';</script>");
	}

	//Ending of page
	}
	else {
		echo '<li><a href = "login.php">  login as admin first </a></li>';
	}

//using setup.php for layout
	require 'setup.php';
?>