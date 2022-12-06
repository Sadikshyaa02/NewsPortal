<?php
	//stsrting the session
	session_start();

	//giving title to the oage
	$pagetitle = 'Add Admin';

	//connecting to the database
	require 'database.php';

	//usinf if condition to check whether admin is logged in or not
	// only admin can use this page
	if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'])
	{

		//content for this page
		$pagecontent = '
			<h2>Create Admin</h2>
			<form class="form" action="addAdmin.php" method="post">

			<!--giving label and input type for name holder-->
					<label>Admin name:</label>
						<input type="text" name="admin_name" required />

			<!--giving label and input type for surname holder-->				
					<label>Admin surname:</label>
						<input type="text" name="admin_surname" required />


			<!--giving label and input type for email holder-->
					<label>E-mail ID:</label>
						<input type="text" name="email" required />

		<!--giving label and input type for passowrd holder-->
					<label>Password:</label>
						<input type="password" name="password" required />

						<!--giving label and input type for re password
						 holder-->		
					<label>Confirm Password:</label>
						<input type="password" name="password2nd" required />


						<input type="submit" value="Add" name="add" />
				</form>
			';

			//task to be done when add button is pressed
			if(isset($_POST['add']))
			{
				//saving the values
				if(isset($_POST['admin_name'], $_POST['admin_surname'], $_POST['password'], $_POST['password2nd']))
				{
					
					$email = $_POST['email'];
					
					//checking whether if the passwords is same or not
        			$valEqual = $_POST['password'] == $_POST['password2nd'];

					//sanitizing the email to get rid of unncessry characters
       				$sanEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        
       				//checking  all the condition is VaLid or not
        			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] != $sanEmail) {


        				//using java script
						// to showthe alert stmt
            			echo '<script type="text/javascript">

						<!--alertstmt-->
						alert("Given email is invalid");
						</script>';
			            

			        } else if (!$valEqual) { 
			        //alert statement 
					//when password don't match
			            echo '<script type="text/javascript">
					<!--alert stmt-->	
						alert("Sorry, the passwords did not match");
						</script>';
			           
			       	
			        }else{
			        
				        //querying For inserting
						//  new values into admins table
				        $sadistmt = $db->prepare('INSERT INTO admins(admin_name, admin_surname, email, password) VALUES (:admin_name, :admin_surname, :email, :password)');

						//providing the criteria
				        $sadicriteria = [
				            'admin_name' => $_POST['admin_name'],
				            
				            'email' => $_POST['email'],
							'admin_surname' => $_POST['admin_surname'],
				            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) //secured form of password
				        ];

						// using try catch
				        try{
                           // executing the given criteria
							$sadistmt -> execute($sadicriteria);

							// alert statement when new admin is added
							echo '<script type="text/javascript">
								alert("Admin  \'' . $email . '\' is added");
							</script>';

						} 
						// if any error 
						catch (PDOException $e) {
							///////
						   if ($e->errorInfo[1] = 1062) 
						   {
						   	//alert stmt when dubLiCate excepTion arises
						      echo '<script type="text/javascript">
								alert("Email \'' . $email . '\' already existed");
								</script>';
						   } else {
						   	 // alert stmt when other ExCeption arise
						      echo '<script type="text/javascript">

							  <!--alert stmt-->
								alert("Error: ' . $e->getMessage() . '");
								</script>';
						   }
						}
					}
				}
			}
	}
	//if admin is not logged in 
	else {
		header("Location: login.php");
	}

	//using setup.php for layotu 
			require 'setup.php';

?>