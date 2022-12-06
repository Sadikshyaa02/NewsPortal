<?php

//stsrting the seesion
session_start();

//providing the oage title
$pagetitle = 'Delete Admin';

//Connecting the page  to database
require 'database.php';

// making sure that an admin is logged 
if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

  //content for the page
    $pagecontent = '
    <h2>Delete Admin </h2>

    <!--using form-->
    <form class="form" action="deleteadmin.php" method="post">

    <label>delete Admin:</label>
      <select name="email">
      <option value="" disabled selected>
       Select
       </option>';

      //options for admin to be selected for deleting

      //query for admin table in database
        $sadiresults = $db->prepare('SELECT * FROM admins');

        //executing the stmt
        $sadiresults->execute();


        //using for each statemnt
        foreach ($sadiresults as $sadirow)
        {

          // contents for the page
          $pagecontent = $pagecontent. '
          <!-- ""-->
          <option value="'. $sadirow['email'].'">'. $sadirow['email'].'</option>';
        }

        // contents for the page
    $pagecontent =$pagecontent.'
      </select>
      <!--deleting btn-->
        <input type="submit" value="Delete" name="submit" />
    </form>
    ';
    
    //deleting the admin chosen
    if (isset($_POST['email']))
    {
      $email=$_POST['email'];

      //querying the sTaTement for deleting admin account 

      $sadistmt = $db->prepare('DELETE FROM admins WHERE email= :email');

      //binding the parameter
      $sadistmt->bindParam(":email", $email);

      //executing the stmt
      $sadistmt->execute();


      // alert statement 
      //when admin  is deleted
      echo '<script type="text/javascript">
      <!--alert stmt-->
          alert("The admin  ' . $email . ' is deleted");
        </script>';
    }


//Ending the page
}
//if admin is not logged in
else {
	echo '<li><a href = "login.php"> Please login as admin first </a></li>';
}

//using setup.php for layout
require 'setup.php';
?>