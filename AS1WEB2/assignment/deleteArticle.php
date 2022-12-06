<?php

//stsrting the session
session_start();


//setting the page title
$pagetitle = 'Delete Article';

//Connecting the page to database
require 'database.php';

//making sure  admin has log in 
if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

  //content for the page
$pagecontent = '
<h2>Delete Article</h2>

<!--using the form-->
<form class="form" action="deletearticle.php" method="post">

  <label>Article:</label>
    <select name="article">
    <!--selecting the value-->
      <option value="" disabled selected>
      Select
      </option>';

//stmt for querying the article table
    $sadiresults = $db->prepare('SELECT * FROM article');

//executing the stmt
    $sadiresults->execute();

    //using for each stmt
    foreach 
    ($sadiresults as $sadirow)


    {
      //content for the page
      $pagecontent = $pagecontent. '<option value="'. $sadirow['article_id'].'">'. $sadirow['title'].'</option>';
    }

//content for the page continuing
$pagecontent = $pagecontent.'
    </select>
    <input type="submit" value="Delete" name="submit" />
</form>
';


//deleting category when btn is pressed
if (isset($_POST['article']))
{
  $aRticle = $_POST['article'];

  // stmt for  deleting article from article table
  $sadistmt = $db->prepare('DELETE FROM article WHERE article_id = :article');
  // binding stmt
  $sadistmt->bindParam(":article", $aRticle);

  // executing above stmt
  $sadistmt->execute();

  //show an alert statement once the article is deleted
  echo '<script type="text/javascript">
          alert("The article ' . $aRticle . ' has successfully been deleted");
        </script>';
}

//when admin is not log in
}
else {
  // echo stmt
	echo '<li><a href = "login.php">  Log in as Admin </a></li>';
}

//using setup.php as layout
require 'setup.php';
?>