<?php 
	include('server.php');

	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	
	$id = $_GET['author'];
	$title = "Biblioteka :: Autor - $id";
	require("./pages/header.php");
	if($id == "unknown") $id = 1;
	$query = mysqli_query($db, "SELECT * FROM authors WHERE id = '$id'");
	if ((mysqli_num_rows($query) == 0) || $username = ""){
		exit();
	}
	$result = mysqli_fetch_array($query);
?>
<div class="author">
	<div class="author-panel">
		<h1><?php echo $result['name']." ".$result['surname']; ?></h1>
		<img draggable="false" src="./images/unknown-author.png">
		<div class="author-info">
			<div>
				<img draggable="false" src="./images/bday.png">
				<p>
					<?php
						if($id == 1) echo "-";
						else echo $result['birthday'];
					?>
				</p>
			</div>
		</div>
	</div>
	<div class="author-content">
		<div class="author-row">
			<h2>Ostatnio Dodane Książki Tego Autora</h2>
			<div class="author-list">
				<?php
					$query2 = mysqli_query($db, "SELECT books.id as bookid, books.title, books.publisher, books.published, authors.id, authors.name, authors.surname FROM books INNER JOIN authors ON books.author = authors.id WHERE authors.id = '$id' ORDER BY books.id DESC");
					for($i=1; $i<=mysqli_num_rows($query2); $i++){
						$result2 = mysqli_fetch_array($query2);
						echo "<a href='./?book=".$result2['bookid']."'>";
						echo "<h1>".$result2['title']."</h1>";
						echo "<h2>".$result2['name']." ".$result2['surname']."</h2>";
						echo "<h3>".$result2['publisher']."</h3>";
						echo "<h4>".$result2['published']."</h4>";
						echo "</a>";
					}
				?>
				
			</div>
			<div class="book-desc">
			<?php
				if((isset($_SESSION['rank'])) && ($_SESSION['rank'] == "Administrator")){
					echo "<div>";
					echo "<a draggable='false' href='./?edit_author&author=".$result['id']."' class='add-button'><div class='add-plus'>?</div><p class='add-text'>EDYTUJ AUTORA</p></a>";
					echo "</div>";
				}	
			?>
			</div>
		</div>
	</div>
</div>