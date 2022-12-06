<?php


//in this page articles are arranged according to the date
//when viewer clicks on latest articles

//providing title to the page
	$pagetitle = 'Latest Articles'; 

	//starting the session
	session_start();

	// connecting to the database
	require 'database.php';


	//providing content to the page
	$pagecontent = '
	<h2>Latest Articles</h2>
	';

	//giving the stmt
	//stmt for selecting values from article table
	
	//// querying article table using select statement
	$sadiresults = $db->prepare('SELECT * FROM article
	
	 ORDER BY published_date DESC'); 

	 //executing above stmt
  	$sadiresults -> execute();

  	//pageContent  for latest Article

	//using foreach loop
  	foreach($sadiresults as $sadirow){

  		// displaying the aricle
		//continuing the content
	  	$pagecontent = $pagecontent . '
<!--giving div name as ARtiCle-->
	  <div name="ARtiCle">
	  <! "-->
	  <a href="article.php?article='. $sadirow['article_id'] . '" id="Heading" ><h5>' . $sadirow['title']. '<h5></a>


	  <! "-->
	  <a href="article.php?article='. $sadirow['article_id'] . '" id="NewsImage" ><p><img src="' . $sadirow['image']. '" id="NewsImage" height="1&0px" width="200px"></p></a>
	  <h5>' .$sadirow['published_date']. '</h5>
	  <p>Category: '.$sadirow['category']. '</p>
	  <p>' .$sadirow['content']. '</p>
	  </div>';
	}

	//using setup.php  as layout file
  require 'setup.php';
?>