<?php

//starting the session
session_start();


//giving title to page
$pagetitle = 'News Articles';

//connecting page to database 
require 'database.php';

//adding category
$category = $_GET['category'];

//content for the page
$pagecontent = '<h2>' . $category . ' Articles</h2>';
  
  //selecting articles from database 
  $sadistmt = $db->prepare('SELECT * FROM article WHERE category="' . $category . '" ORDER BY published_date DESC ');

  //executing the stmt
  $sadistmt -> execute();

  //Quering  comment from the database
  $sadistmt1 = $db->prepare('SELECT * FROM comment');

//executing  the statemnet
  $sadistmt1 -> execute();

  //Adding  articles to category.

  //using for each
  foreach ($sadistmt as $sadirow) {
    //continuing content
    $pagecontent = $pagecontent . '
    <div>
      <a href="article.php?article='. $sadirow['article_id'] . '" id="Heading" ><h5>' . $sadirow['title']. '<h5></a>
      <a href="article.php?article='. $sadirow['article_id'] . '" id="NewsImage" ><p><img src="' . $sadirow['image']. '" id="News-image" height="170px" width="200px"></p></a>
      <h5>' .$sadirow['published_date']. '</h5>
      <p>Category: '.$sadirow['category']. '</p>
      <p>' .$sadirow['content']. '</p>
    </div>';
    }
      

    //using setup.php for layout
require 'setup.php';
?>