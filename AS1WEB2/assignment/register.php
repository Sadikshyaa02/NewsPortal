<?php
   //non admin viewer can register them through this page
    
   //connecting the page to database
    require 'database.php';

    // providing the title of the page
    $pagetitle = 'Register';


    //using form so that non admin can fill their info for registering
    // providing the contents for the page
    $pagecontent = 
    //start of page content
    '
    <!--giving heading for the page-->
    <h2>REGISTER</h2>
    
    <!--using articlE for creating the form for this page-->
    <article>

    <!--starting the form detail-->
    	<form class="form" action="register.php" method="post">
    <p>Fill your details </p>
    		
        <!--giving label and input type for name holder-->
    		<label>Name:</label>
                <input type="text" name="vieWer_name" required />
                
        <!--giving label and input type for surname holder-->        
    		<label>Surname:</label>
    			<input type="text" name="vieWer_surname" required />

        <!--giving label and input type for email holder-->
    		<label>E-mail Id:</label>
    			<input type="text"  name="eMaIl" required />

        <!--giving label and input type for paSSword holder-->
    		<label>Password:</label>
    			<input type="password"  name="paSsWord" required />

         <!--giving label and input type for confirming password holder-->            
    		<label>Confirm Password:</label>
    			<input type="password"  name="paSsWord2nd" required />
    		<input type="submit" value="register" name="register" />
    	</form>
    	</article>
    </article>';

    //task to be done
    //when register btn is pressed
    if (isset($_POST['register'])) {
    	
        
    //info is taken when btn register is presseD
    if(isset($_POST['vieWer_name'], $_POST['vieWer_surname'], $_POST['eMaIl'], $_POST['paSsWord'], $_POST['paSsWord2nd']))
    {
        $email = $_POST['eMaIl'];

//checking whether both password and confirmed passWord is same or not
     $valueSSaMe = $_POST['paSsWord'] == $_POST['paSsWord2nd'];

    //        email sanitization tutorial: https://www.youtube.com/watch?v=fMJw90n8M60&index=4&list=PLOYHgt8dIdox81dbm1JWXQbm2geG1V2uh, 02.01.2017

    //sanitizing the email to get rid of unneccesary input of diff character or more
            $sanEmail = filter_var($_POST['eMaIl'], FILTER_SANITIZE_EMAIL);

            
            //use of if-else for finding any kind of error
            if (!filter_var($_POST['eMaIl'], FILTER_VALIDATE_EMAIL) || $_POST['eMaIl'] != $sanEmail) {
                
                //using javaScript for showing an alert to check 
                //if email provided by viewer is valid or not
                        echo '<script type="text/javascript">

                        <!--stmt for alert-->
                        alert("Sorry the email you provided is not valid");
                        </script>';
                return;

            } else if (!$valueSSaMe) {

               
                //using javaScript for showing an alert to check 
                // if both password match or not
                echo '<script type="text/javascript">

                <!--stmt for alert-->
                        alert("Please re-check the password donot match");
                        </script>';
           	
            }
            else{

            //use of insert statement 
            //for inserting required val in viewers table
            $sadistmt = $db->prepare('INSERT INTO viewers (viewer_name, surname, email, password) VALUES (:viewer_name, :surname, :email, :password)');

            //for storing the provided value
            $sadicriteria = [
                'viewer_name' => $_POST['vieWer_name'],
                
                'email' => $_POST['eMaIl'],
                //hashing the password for security
                'password' => password_hash($_POST['paSsWord'], PASSWORD_DEFAULT),

                'surname' => $_POST['vieWer_surname']

                
            ];
             
            //unsetting the btn
            unset($_POST['register']);

            try{
                //executing the above criteria
                    $sadistmt -> execute($sadicriteria);

                    
                //using javaScript for showing an alert to check 
                //the username has been added or not
                    echo '<script type="text/javascript">

                <!--stmt for alert-->
                    alert("Viewer \'' . $email . '\' is  added to the database");
                    </script>';

                } 
                //pdo exception for error
                catch (PDOException $e) {
                   if ($e->errorInfo[1] == 1062) {

                    //using javaScript for showing an alert to check 
                    // for duplicate entry case
                      echo '<script type="text/javascript">

                      <!--stmt for alert--> 
                        alert("This email \'' . $email . '\' already exists in database.");
                        </script>';
                   } 
                   
                   else {
                    //show an alert message for other error
                      echo '<script type="text/javascript">
                        alert("Error : ' . $e->getMessage() . '");
                        </script>';
                   }
                }

            }

    	}
    }

//using setup.php for layOut of this page
    require 'setup.php';

    ?>