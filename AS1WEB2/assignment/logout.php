<?php
//providing the title for page
$pagetitle = 'Logged out';

//starting the session
session_start();

//unsetting the task

//for logout of viewer
unset($_SESSION['logged_as_user']);

//for log out of admin
unset($_SESSION['logged_as_admin']);

//using java script
//for alert stmt
echo '<script type="text/javascript">

<!--alert stmt-->
		alert("You are  logged out from page");
		</script>';

$pagecontent = 'You are  logged out from previous page';


//using setup.php for layout of page
require 'setup.php';
?>