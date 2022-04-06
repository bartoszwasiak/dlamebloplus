<?php 
	include('server.php');
	$title = "Biblioteka :: Książki";
	require("./pages/header.php");
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	$query = mysqli_query($db, 'SELECT books.id, books.title, books.publisher, authors.name, authors.surname, books.published, books.quantity FROM books INNER JOIN authors ON books.author = authors.id ORDER BY books.quantity DESC');
?>
<div class="listing">
	<h1>Lista Książek</h1>
	<h2>książki dostępne w naszej bibliotece</h2>
	<?php
		if((isset($_SESSION['rank'])) && ($_SESSION['rank'] == "Administrator")){
			echo "<a draggable='false' href='./?new_book' class='add-button'><div class='add-plus'>+</div><p>DODAJ KSIĄŻKĘ</p></a>";
		}
	?>
	<div class="listing-list">
		<?php
			$rows = mysqli_num_rows($query);
			for($i=1; $i<=$rows; $i++){
				$result = mysqli_fetch_array($query);
				$query2 = mysqli_query($db, 'SELECT AVG(rate) AS avrg FROM rates INNER JOIN users ON rates.client = users.id WHERE rates.book = '.$result['id'].'');
				$result2 =  mysqli_fetch_array($query2);
				if($result['quantity'] > 0){
					echo "<a href='./?book=".$result['id']."' style='background: url('./covers/1.jpg')' class='book-record'><p class='book-count'>".$result['quantity']."</p><h1>".$result['title']."</h1><h2>".$result['name']." ".$result['surname']."</h2><h4>".$result['published']."</h4><p class='book-mark'>".round($result2['avrg'],2)." ★</p></a>";
				}
				else{
					echo "<a href='./?book=".$result['id']."' class='book-record out'><p class='book-count'>-</p><h1>".$result['title']."</h1><h2>".$result['name']." ".$result['surname']."</h2><h4>".$result['published']."</h4><p class='book-mark'>".round($result2['avrg'],2)." ★</p></a>";
				}
			}
		?>
	</div>

</div>