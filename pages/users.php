<?php 
	include('server.php');
	$title = "Biblioteka :: Użytkownicy";
	require("./pages/header.php");
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	$query = mysqli_query($db, 'SELECT * FROM users');
?>
<div class="listing">
	<h1>Lista Użytkowników</h1>
	<h2>nasi czytelnicy</h2>
	<div class="listing-list">
		<?php
			$rows = mysqli_num_rows($query);
			for($i=1; $i<=$rows; $i++){
				$result = mysqli_fetch_array($query);
				echo "<a href='./?user=".$result['username']."' class='listing-record'> <img src='./images/unknown.png'> <p>".$result['name']." ".$result['surname']."</p><p style='color: #c00'>".$result['rank']."</p></a>";
			}
		?>
	</div>

</div>