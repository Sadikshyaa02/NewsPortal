<?php
//starting session
	session_start();

	//giving title to page
	$pagetitle = 'Edit Category';

	//connecting page to database
	require 'database.php';

	//seeing whether admin is logged or not
	if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

		//changing currentName  to newName
	$sadicurrentName = $_GET['editName'];

	//content for page
	$pagecontent = '
	<h2>Edit Category "' . $sadicurrentName . '"</h2>
	<form class="form" action="editCategory.php?editName=' . $sadicurrentName . '" method="post" enctype="multipart/form-data">
			<label>Category :</label>
				<input type="text" placeholder="do you like to change?" name="NewName" />
			<label>Description:</label>
				<textarea placeholder="do you like to change" name="NewDesc"></textarea>
			<input type="submit" value="Done" name="submit" />
		</form>
	';


	//using isset
	//task to be done after btn is pressed
	if(isset($_POST['submit'])){
		if (isset($_POST['NewName'], $_POST['NewDesc'],$_POST['NewName'])) {
			
			$NewDesc = $_POST['NewDesc'];
		  	$NewName = $_POST['NewName'];
			

					
			if($NewName != ""){

				//query to update
			    $sadistmt = $db->prepare('UPDATE category SET name = "' . $NewName . '" WHERE name = "' . $sadicurrentName . '"');

				//using try catch
			    try{
					//executing stmt
				$sadistmt -> execute();

				//using javascript
				//for echoing when work done
			    echo '<script type="text/javascript">
				<!--alert stmt-->
			    alert("Name for \'' . $sadicurrentName . '\' category is  changed to \'' . $NewName . '\'");
				</script>';

				} 
				//for any other exCeption
				catch (PDOException $e) {
				   if ($e->errorInfo[1] == 1062) {

				   	//alert for any duPLicate enTry exCeption
				      echo '<script type="text/javascript">
						alert("The category  \'' . $NewName . '\' already exists.");
						</script>';
				   } else {
                        

					//alert stmt
				      echo '<script type="text/javascript">
					  <!--alert for other error-->
						alert("Error : ' . $e->getMessage() . '");
						</script>';
				   }
				}				

			}
			else{

			    
//alert if name is not chenged
			    echo '<script type="text/javascript">
				<!--alert stmt-->
				alert("Category Name was not changed");
				</script>';

			}

				//whwn article is  changed
			if($NewDesc != ""){

				//querying category
				$sadistmt2=$db->prepare('UPDATE category SET description = "' . $NewDesc . '" WHERE name = "' . $sadicurrentName . '"');

				//executing the stmt
				$sadistmt2->execute();

				
//alert for description
				echo '<script type="text/javascript">\

				//alertstmt
				alert("Description for \'' . $sadicurrentName . '\' category is  changed to \'' . $NewDesc . '\'");
				</script>';

			}
			
			else {
				//alert if desc is not changed
				echo '<script type="text/javascript">

				//alert stmt
				alert("Description was not changed");
				</script>';

			}

		}

	}
	//Ending the page
}
//else stmt
else {
	$pagecontent = ' login as admin to view this page';
}

// using setup.php for layout
require 'setup.php';
 ?>