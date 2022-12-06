<?php

//title for the page
$pagetitle = 'Manage Admin';

//starting the session
session_start();

//checking whether the admin is log in before viewing the page  or  not
if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true)
{

  // links with work that the admin can to do
	$pagecontent = '
	<h2>Manage admin</h2>
<nav>
  <ul>
  
  
    <li><a href="addAdmin.php">Add Admin</a></li>
    <li><a href="adminEdit.php">Edit Admin </a></li>
    <li><a href="deleteAdmin.php">Delete Admin </a></li>
  
  </ul>
</nav>
	';

  //using setup.php for layout of page
	require 'setup.php';
}


else{ 
  //showing message
  //only if admin is not logged in
	echo '<li><a href = "login.php"> Please login as Admin</a></li>';
}


?>