<?php 
	include('server.php');

	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	
	$username = $_GET['user'];
	
	$title = "Biblioteka :: Profil - $username";
	require("./pages/header.php");

	$query = mysqli_query($db, "SELECT * FROM users WHERE username= '$username'");
	if ((mysqli_num_rows($query) == 0) || $username = ""){
		 header('location: ./');
	}
	$result = mysqli_fetch_array($query);
?>
<div class="user">
	<div class="user-panel">
		<h1><?php echo $result['name']." ".$result['surname']; ?></h1>
		<h3><?php echo $result['rank']; ?></h3>
		<img draggable="false" src="./images/unknown.png">
		<div class="user-info">
			<div><img draggable="false" src="./images/bday.png"><p><?php echo $result['birthday']; ?></p></div>
			<div><img draggable="false" src="./images/created.png"><p><?php echo $result['created']; ?></p></div>
		</div>
	</div>
	<div class="user-content">
		<div class="content-row">
			<h2>Najwyżej Ocenione</h2>
			<div class="content-list">
				<?php 
					$query2 = mysqli_query($db, "SELECT books.id AS bookid, rates.id, rates.rate, books.title, authors.name, authors.surname, books.publisher, books.published FROM rates INNER JOIN books ON rates.book = books.id INNER JOIN users ON rates.client = users.id INNER JOIN authors ON books.author = authors.id WHERE users.id = '".$result['id']."' ORDER BY rates.rate DESC LIMIT 5");
					for($i=1; $i<=mysqli_num_rows($query2); $i++){
						$result2 = mysqli_fetch_array($query2);
						echo "<a href='./?book=".$result2['bookid']."'class='content-object'><div>";
						echo "<h1>".$result2['title']."</h1>";
						echo "<h2>".$result2['name']." ".$result2['surname']."</h2>";
						echo "<h4>".$result2['published']."</h4>";
						echo "</div><p>".$result2['rate']."★</p>";
						echo "</a>";
					}
				?>

			</div>
		</div>
		<div class="content-row">
			<h2>Ostatnio Wypożyczone</h2>
			<div class="content-list">
				<?php 
					$query3 = mysqli_query($db, "SELECT books.id AS bookid, users.id, books.title, books.publisher, books.published, authors.name, authors.surname, borrowed.ended, borrowed.start FROM borrowed INNER JOIN users ON borrowed.client = users.id INNER JOIN books ON borrowed.book = books.id INNER JOIN authors ON books.author = authors.id WHERE users.id = '".$result['id']."'ORDER BY borrowed.start DESC LIMIT 5");
					for($i=1; $i<=mysqli_num_rows($query3); $i++){
						$result3 = mysqli_fetch_array($query3);
						echo "<a href='./?book=".$result3['bookid']."' class='content-object'><div>";
						echo "<h1>".$result3['title']."</h1>";
						echo "<h2>".$result3['name']." ".$result3['surname']."</h2>";
						echo "<h4>".$result3['published']."</h4>";
						$timestamp = strtotime($result3['start']);
						$date = date('d-m-Y', $timestamp);
						echo "</div><p class='date'>".$date."</p>";
						echo "</a>";

					}
				?>

			</div>
		</div>
	</div>
</div>