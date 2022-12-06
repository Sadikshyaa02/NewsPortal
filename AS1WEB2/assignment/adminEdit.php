<?php

//starting the session
	session_start();

	//giving the title to page
	$pagetitle = 'Edit Admin ';

	//connecting page to database
	require 'database.php';

	//seeing whether admin is logged in  or not
	if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {


		//content for page
	$pagecontent = '<h2>Select an Admin  to Edit</h2>

	<!--using form-->
	<form class="form" action="adminEdit.php" method="GET">

	<!--using label-->
			<label>Select Admin :</label>
			<!--"-->
			<select name="editEmail">
				<option value="" disabled selected> Select</option>';

					//query for selecting articles 
					$sadistmt = $db->prepare('SELECT * FROM admins');

					//executing the stmt
					$sadistmt -> execute();

					//using for each
					foreach ($sadistmt as $sadirow)
					{
						$pagecontent = $pagecontent. '
						<option value="' . $sadirow['email'] . '">' . $sadirow['email'] . '</option>';
					}

	//content for page continues
	$pagecontent =$pagecontent . '
				</select>
				<input type="submit" value="Edit" name="submit" />
			</form>
	';

	//editing the form 
	if(isset($_GET['editEmail'])){
		$editEmail = $_GET['editEmail'];
		
		//moving to edit admin page
		echo("<script>location.href = 'editAdmin.php?editEmail=$editEmail';</script>");
	}

	//ending admin page
	}
	else {
		$pagecontent = ' log as an admin to view this page';
	}


	//using setup.php for layout
	require 'setup.php';
?>