<?php 
	include('server.php');
	$title = "Biblioteka :: Autorzy";
	require("./pages/header.php");
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	$query = mysqli_query($db, 'SELECT * FROM authors');
?>
<div class="listing">
	<h1>Lista Autorów</h1>
	<h2>autorzy naszych książek</h2>
	<?php
		if((isset($_SESSION['rank'])) && ($_SESSION['rank'] == "Administrator")){
			echo "<a draggable='false' href='./?new_author' class='add-button'><div class='add-plus'>+</div><p>DODAJ AUTORA</p></a>";
		}
	?>
	<div class="listing-list">
		<?php
			$rows = mysqli_num_rows($query);
			for($i=1; $i<=$rows; $i++){
				$result = mysqli_fetch_array($query);
				echo "<a draggable='false' href='./?author=".$result['id']."' class='listing-record'> <img src='./images/unknown-author.png'> <p>".$result['name']." ".$result['surname']."</p></a>";
			}
		?>
	</div>

</div>