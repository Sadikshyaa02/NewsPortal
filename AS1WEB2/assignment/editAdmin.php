<?php
//starting the session
	session_start();

	//giving title to page
	$pagetitle = 'Edit Admin ';

	//connecting databese
	require 'database.php';

	//see admin is login or not
	if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

		//add email
	$sadicurrentEmail = $_GET['editEmail'];

	//html part
	//content of page
	$pagecontent = '
	<h2>Edit Admin  "' . $sadicurrentEmail . '"</h2>

	<!--using form-->
	<form class="form" action="editAdmin.php?editEmail=' . $sadicurrentEmail . '" method="post" enctype="multipart/form-data">
	<!--using label-->
			<label>Admin_Name:</label>
				<input type="text" placeholder="change if you want" name="newFname" />
			<label>Admin_Surname:</label>
				<input type="text" placeholder="change if you want" name="newLname" />
			<label>Password</label>
				<input type="password" placeholder=" change if you want " name="newPass"/>
			<input type="submit" value="Done" name="submit" />
		</form>
	';


//task to be done once btn is pressed
		if(isset($_POST['submit'])){
			if (isset($_POST['newFname'], $_POST['newLname'], $_POST['newPass'])) {
				

			  	$newFname = $_POST['newFname'];
				  $pAss = $_POST['newPass'];
				$newLname = $_POST['newLname'];
				
				$newPass = password_hash($pAss, PASSWORD_DEFAULT);

						
				//changing name when viewer provide a new name
				if($newFname != ""){ 

				    $sadistmt = $db->prepare('UPDATE admins SET admin_name = "' . $newFname . '" WHERE email = "' . $sadicurrentEmail . '"');

					//using try catch
				    try{

						//executing the stmt
					$sadistmt -> execute();

					
					
//alert when name is changed
				    echo '<script type="text/javascript">
					//alertstmt
				    alert("name for \'' . $sadicurrentEmail . '\' is changed to \'' . $newFname . '\'");
					</script>';

					}
					 catch
					 //for new error
					  (PDOException $e) {
					   
						echo '<script type="text/javascript">

						<!--alert stmt-->
						alert("Error : ' . $e->getMessage() . '");
						</script>';
					   
					}				

				}
				else{

				    //alert if name not chenged

				    echo '<script type="text/javascript">
					<!--alertstmt-->
					alert("name is not changed");
					</script>';

				}

					//changing last name to new lastnae
				if($newLname != ""){ //change lastname when user inputs a new lastname

					//query to update admin
					$sadistmt2=$db->prepare('UPDATE admins SET admin_surname = "' . $newLname . '" WHERE email = "' . $sadicurrentEmail . '"');

					//using try catch
					try{
					
						//executing stmt
					$sadistmt2 -> execute();

					
//alert when last name is changed
					echo '<script type="text/javascript">
					alert("Lastname for \'' . $sadicurrentEmail . '\' is changed to \'' . $newLname . '\'");
					</script>';

					}
					//for new error
					 catch 
					 /////
					 (PDOException $e) {
					   
						//alert stmt for new error
						echo '<script type="text/javascript">
						<!--alert stmt-->
						alert("Error : ' . $e->getMessage() . '");
						</script>';
					   
					}				

				}
				//alert if surname not  chenged
				else {
					echo '<script type="text/javascript">

					<!--alert stmt-->
					alert("Surname is not changed");
					</script>';

				}


				//for changing password
				if($pAss != ""){ 

					//query to update admin
					$sadistmt3=$db->prepare('UPDATE admins SET password = "' . $newPass . '" WHERE email = "' . $sadicurrentEmail . '"');

					//using try catch
					try{

						//executing stmt
					$sadistmt3 -> execute();

					//using js
					//alert when password is change

					echo '<script type="text/javascript">
					//alertstmt
					alert("Password for \'' . $sadicurrentEmail . '\' is changed");
					</script>';

					} 
					catch 
					//for any  error
					(PDOException $e) {
					   
						//alert for other error
						echo '<script type="text/javascript">
						<!--alert stmt-->
						alert("Error : ' . $e->getMessage() . '");
						</script>';
					   
					}
					
				}
				else {
					
//alertif password is not changed
					echo '<script type="text/javascript">

					<!--alertstmt-->
					alert("Password is not changed");
					</script>';
				}

			}

		}
	//endingpage
	}
	else {
		echo '<li><a href = "login.php"> login as admin first </a></li>';
	}

//using setup.php for layout
	require 'setup.php';
// 
?>