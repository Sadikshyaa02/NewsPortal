<!DOCTYPE html>
<html>
	<head>
		<!-- link for css file -->
		<link rel="stylesheet" type="text/css" href="styles.css">

		<!-- using title variable for title  of the page -->
		<title><?php echo $pagetitle; ?></title> 
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<!-- nav bar on top of page -->
				<li><a href="index.php">Home</a></li>
				<li><a href="news.php">Latest Articles</a></li>
				<li><a href="#">Categories</a>
					<ul>
						<!-- a dropdown of categories -->
						<?php require 'database.php';
						$sadistmt = $db->prepare('SELECT * FROM category');
						$sadistmt->execute();

						foreach ($sadistmt as $sadirow)
							{
								// link to jump into their respective page for the category of article
							  echo '<li><a href="categoryPage.php?category='. $sadirow['name'] . '">'. $sadirow['name'] . '</a></li>';
							} ?>
						
					</ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>

			<!-- images for top of page -->
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>

			<!--  side bar -->
			<nav>
				<ul>
					<?php

					//when viewer log in
					// showing these contents in the sidebar
					if(isset($_SESSION['logged_as_user']) && $_SESSION['logged_as_user'] == true){

						echo '<li><a href="logout.php">Logout</a></li>';
					}
					//when admin log in
					// showing these contents in the sidebar
					else if(isset($_SESSION['logged_as_admin']) && $_SESSION['logged_as_admin'] == true){
						echo '<li><a href="logout.php">Logout</a></li>
						<li><a href="adminPage.php">Admin Page</a><li>';
					}
					//contents to show in the sidebar for guest user
					else{
						echo '<li><a href="register.php">Register</a></li>
							<li><a href="login.php">Login</a></li>';
					}

						?>
				</ul>
			</nav>

			<article>

				<!-- contents for main body -->
				<?php echo $pagecontent; ?>

			</article>
		</main>
		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>