<?php
//admin and viewer can login them through this page
    
   

session_start();

//connecting the page to database
	require 'database.php';
	
	// providing the title of the page
	$pagetitle = 'Login';


	//using form so that  admin and viewer can fill their info for registering
    // providing the contents for the page

	$pagecontent = 
	//start of page content
	'
	<!--giving heading for the page-->
	<h2>Login </h2>
	<article>

	<!--starting the form detail-->
	<form class="form" action="login.php" method="post">

	<!--giving label and input type for email holder-->
		<label>Email:</label>
				<input type="text" name="email" required />

	<!--giving label and input type for paSSword holder-->			
		<label>Password:</label>
			<input type="password" name="password" required />

	<!—submit btn-->
		<input type="submit" value="Login" name="submit" />

		<!—end of form -- >
	</form>
	</article>
	';

	//task to be done
    //when login btn is pressed

if (isset($_POST['submit'])) {
	

	//info is taken when btn login is presseD
	if (isset($_POST['email'], $_POST['password'])) {

		$email = $_POST['email'];
		$pass = $_POST['password'];

		
		//stmt to check the values from admin page is same or not
		$sadistmt = $db-> prepare('SELECT *FROM admins WHERE email="' . $email . '";');

		//executing the above statement
		$sadiresult = $sadistmt->execute();


		//stmt for checking that  email  inputted exists in viewers table or not
		$sadistmt2 = $db-> prepare('SELECT *FROM viewers WHERE email="' . $email . '";');

		//executing the above stmt
		$sadiresult2 = $sadistmt2->execute();

		//task to be done if email Is FoUnD in admin table
		if($sadistmt->rowCount() == 1){
			
//using while for fetching the stmt
			while($admin = $sadistmt->fetch(PDO::FETCH_ASSOC)){

				//checking wheTher the password is coRRect or not
				if($_POST['password'] == $admin['password']){

					//global variable seesion is used for logged viewer
					$_SESSION['logged_as_user'] = false;

					//global variable seesion is used for email
					$_SESSION['admin'] = $admin['email'];

					//global variable seesion is used for admin id
					$_SESSION['admin_id'] = $admin['admin_id'];

					//global variable seesion is used for logged admin
					$_SESSION['logged_as_admin'] = true;
					
					
                    // using java script
					//stmt for moving admin to adminindex page
					echo("<script>location.href = 'index.php';</script>");
					
					
				}
				else{
                    //using java script
					//stmt for alert
					echo '<script type="text/javascript">
					alert(" Incorrect password.");
					</script>';
				}					
			
			}
		}

		//task to be done when  email is found in admins table 
		//stmt for counting row
		else if($sadistmt2->rowCount() == 1){

			//using while for stmt
			while($viewer = $sadistmt2->fetch(PDO::FETCH_ASSOC))
			{
				
				//verifying the password
				if(password_verify($_POST['password'], $viewer['password'])){

					//global variable seesion is used for  viewer
					$_SESSION['user'] = $viewer['email'];

					//global variable seesion is used for viewer_id
					$_SESSION['user_id'] = $viewer['user_id'];

					//global variable seesion is used for logged viewer
					$_SESSION['logged_as_user']  = true;

					//global variable seesion is used for logged admin
					$_SESSION['logged_as_admin'] = false;
						
					//using javascript
					//for moving to index page
					echo("<script>location.href = 'index.php';</script>");

					
				}
				else{
					//stmt for  any error,
					//using java script
					echo '<script type="text/javascript">

					<!--stmt for alert-->
					alert("You have provided incorrect password");
					</script>';
				}
					
			}
		}
		else{
             
			//using java script
			echo '<script type="text/javascript">
			<!--stmt for alert-->
					alert("You have provided an incorrect email or password");
					</script>';
		}
	}
}

//using setup.php for layout of page
	require 'setup.php';
?>