<?php
//this is contact page

//stsrting the session
session_start();

//title for the page
$pagetitle = 'Contact';

//content for the page
$pagecontent = '

<article>
<h2>Contact</h2>
				<p>Get in touch</p>

				<ul>
					<li>Phone number: *******</li>
					<li>Visit us : 303 street , Northampton,UK</li>
					<li>Email: news@northampton.com</li>
				</ul>


				<form>
					<p>How can we help?</p>

					<label>Name</label> <input type="text" />
					<label>Email</label> <input type="text" />
					<label>Queries</label> <textarea></textarea>

					<input type="submit" name="submit" value="Submit" />
				</form>
	</article>
  ';

  //using setup.php page for layout
require 'setup.php';

?>