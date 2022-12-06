<?php

//starting the session
	session_start();

	//title of the page
	$pagetitle = 'Edit Article';

	//connecting to database
	require 'database.php';

	//see whether admin is log or not
	if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){


		//adding title
	$sadicurrenttitle = $_GET["editTitle"];


//content for page
	$pagecontent = '
	<h2>Edit Article "' . $sadicurrenttitle . '"</h2>
	<!--using form-->
	<form class="form" action="editArticle.php?editTitle=' . $sadicurrenttitle . '" method="POST" enctype="multipart/form-data">

	<!--using label-->
			<label>New Title:</label>
				<input type="text" placeholder=" change if you want t" name="newtitle" />
			<label>Category:</label>
			<select name="newcategory" required>
				<option value="" disabled selected>Choose category</option>';

					//quering article table
					$sadistmt = $db->prepare('SELECT * FROM category');
					$sadistmt->execute();

					foreach ($sadistmt as $sadirow)
					{
						$pagecontent = $pagecontent. '<option value="' . $sadirow['name'] . '">' . $sadirow['name'] . '</option>';
					}

					//more page content
	$pagecontent = $pagecontent . '</select>
			<label>Content:</label>
			<textarea name="newcontent" placeholder="change if you want "></textarea>
	<input type="submit" value="Done" name="submit" />
		</form>
	';


	//task to be done when btn is pressed
	if(isset($_POST['submit'])){
		if(isset($_POST['newcategory'],$_POST['newtitle'],  $_POST['newcontent'])) {
			
			$newcategory = $_POST['newcategory'];
		  	$newtitle = $_POST['newtitle'];
			
			$newcontent = $_POST['newcontent'];



					//query to Update category name
			$sadistmt2=$db->query('UPDATE article SET category = "' . $newcategory . '" WHERE title = "' . $sadicurrenttitle . '"');
			$sadistmt2->execute();

					
					
			if($newtitle != ""){

				//querying article table
			    $sadistmt3=$db->prepare('UPDATE article SET title = "' . $newtitle . '" WHERE title = "' . $sadicurrenttitle . '"');

				//using try catch
			    try{
					//executing the stmt
				$sadistmt -> execute();

				

				//alert when the title is edit
				echo '<script type="text/javascript">

				<!--alertstmt-->
				alert("Title  \'' . $sadicurrenttitle . '\' is changed to \'' . $newtitle . '\'");
				</script>';

			} catch 
			//if any error
			(PDOException $e) {
			   if ($e->errorInfo[1] == 1062) 
			   {
				//alert when title already found
			      echo '<script type="text/javascript">
					alert("The Article Title is found in database.");
					</script>';

			   } 
			   ////
			   else 
			   {
				//alert for other error
			      echo '<script type="text/javascript">
				  //alertstmt
					alert("Error : ' . $e->getMessage() . '");
					</script>';
			   }
			}
///////
			}
			else {

			
//alert if there is no change 
				echo '<script type="text/javascript">
				<!--alert stmt-->
				alert("Title is not changed");
				</script>';
			}

			if($newcontent != ""){

				//query stmt for updating
				$sadistmt4=$db->prepare('UPDATE article SET content = "' . $newcontent . '" WHERE title = "' . $sadicurrenttitle . '"');

				//executing stmt
			    $sadistmt4->execute();

			   
//using js
//alert when content is change
			    echo '<script type="text/javascript">
				alert("Contents of \'' . $sadicurrenttitle . '\' has been sucessfully changed to \'' . $newtitle . '\'");
				</script>';
				
			}
			else {

			  //alert when there is no change

			    echo '<script type="text/javascript">
				//alert stmt
				alert("Content is not changed");
				</script>';
			}
				
		}
	}

	//page ends here
	}
	else {
		echo '<li><a href = "login.php">  login as admin first </a></li>';
	}


	//using setup.phpfor layout
	require 'setup.php';
// ?>