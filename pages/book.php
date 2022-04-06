<?php 
	include('server.php');
	$title = "Biblioteka :: Książka - ".$_GET['book'];
	require("./pages/header.php");
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	$query = mysqli_query($db, 'SELECT *, books.id AS bookid from books INNER JOIN authors ON books.author = authors.id WHERE books.id ='.$_GET['book'].'');
?>
<div class="book">
	<div class="book-details">
		<?php
			$result = mysqli_fetch_array($query);
			echo "<h1>".$result['title']."</h1>";
			echo "<h2>".$result['name']." ".$result['surname']."</h2>"
		?>
		
		<div class="book-rating">
			<?php
				if(isset($_SESSION['username'])){
					include('./pages/rating.php');
				}
			?>
			<div class="book-more-details">
				<div class="details-row">
					<img src="./images/star.png">
					<p>
						<?php
							$query3 = mysqli_query($db, 'SELECT AVG(rate) AS avrg FROM rates INNER JOIN users ON rates.client = users.id WHERE rates.book = '.$_GET['book'].'');
							$result3 =  mysqli_fetch_array($query3);
							echo round($result3['avrg'], 2);
						?>
					</p>
				</div>
				<div class="details-row">
					<img src="./images/quantity.png">
					<p><?php echo $result['quantity']; ?></p>
				</div>
				<div class="details-row">
					<img src="./images/date.png">
					<p><?php echo $result['published']; ?></p>
				</div>
				<div class="details-row">
					<img src="./images/publisher.png">
					<p><?php echo $result['publisher']; ?></p>
				</div>


			</div>
		</div>
	</div>
	<div class="book-desc">
		<h1>Opis Książki</h1>
		<p><?php echo $result['descr']; 
		if((isset($_SESSION['rank'])) && ($_SESSION['rank'] == "Administrator")){
			echo "<div>";
			echo "<a draggable='false' href='./?edit_book&book=".$result['bookid']."' class='add-button'><div class='add-plus'>?</div><p class='add-text'>EDYTUJ KSIĄŻKĘ</p></a>";
			echo "</div>";
		}	
		?></p>

	</div>
	
</div>