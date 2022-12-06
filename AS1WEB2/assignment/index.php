<?php
//starting The current session
// to start the webpage of assignment
session_start(); 

//setting the title of this page
$pagetitle = "Northampton News "; 

//connecting the file to the database
require 'database.php'; 

//providing the contents required for the page
$pagecontent = '<h2> Northampton News.. </h2>';

//providing the sTaTement  for running query from a teble from DaTabase
//querY for selection of attriButes from the ARTICLE table
$sadistmt = $db->prepare('SELECT * FROM article'); 
     
//executing the above sTaTement
		$sadistmt->execute();
     
	//using the foreach	LooP for looping  the vAlues of an aRray.
		foreach ($sadistmt as $sadirow)
		{
	 
	//content for showing the articles in all pages		
			$pagecontent = $pagecontent . '

		<!-- using a div with name ArTiCle-->
		  <div name="ArTiCle">

		 <!-- linking the page to article.php PaGE 
		 with title of article-->
	  <a href="article.php?article='. $sadirow['article_id'] . '" id="Heading" ><h5>' . $sadirow['title']. '<h5></a>

	  <!-- linking the page to article.php PaGE 
	  with image for the article and the date it was published-->
	  <a href="article.php?article='. $sadirow['article_id'] . '" id="NewsImage" ><p><img src="' . $sadirow['image']. '" id="NewsImage" height="170px" width="200px"></p></a>
	  <h5>' .$sadirow['published_date']. '</h5>

	  <!-- linking the page to article.php PaGE 
	  with category for the article and content of article-->
	  <p>Category: '.$sadirow['category']. '</p>
	  <p>' .$sadirow['content']. '</p>
	  
	  </div>
			';
		}

		//using setup.php file as the layout of page
require 'setup.php';
 //ending the index php page
?>
