<?php
//title for page
$pagetitle = 'Delete Category';

//session starting
session_start();

//Connecting the page to database
require 'database.php';

//Making sure admin is log in
if (isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true) {

  //content for page
$pagecontent = '
<h2>Delete Category</h2>
<!--using form-->
<form class="form" action="deleteCategory.php" method="post">
  <label>category:</label>
    <select name="category">
      <option value="" disabled selected>Select</option>';

    //query to select all category
    $sadiresults = $db->prepare('SELECT * FROM category');
    $sadiresults->execute();

    foreach ($sadiresults as $sadirow)
    {
      $pagecontent = $pagecontent. '<option value="'. $sadirow['category_id'].'">'. $sadirow['name'].'</option>';
    }

//content variable continues
$pagecontent = $pagecontent.'
    </select>
    <input type="submit" value="Delete" name="submit" />
</form>
';


//If delete button is pressed delete news category Username
if (isset($_POST['category']))
{

  //prepare statement to delete category from categories table
  $sadiresults = $db->prepare('DELETE FROM category WHERE category_id=:category');

  $deletecategory =[
    'category'=> $_POST['category']
  ];

  //unsetting the btn
  unset($_POST['submit']);

  // executing  the stmt
  $sadiresults->execute($deletecategory);

//alert statement
//when category is deleted
echo '<script type="text/javascript">
  alert("News category ' . $_POST['category'] . ' has been deleted");
</script>';
  
}

// when admin is not login
}
else {
	echo '<li><a href = "login.php"> Please login as admin first </a></li>';
}

//using setup.php for layout
require 'setup.php';
?>