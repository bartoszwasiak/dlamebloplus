<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Detale";
		require("./pages/header.php");
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	?> 
</head>
<div class="borrowed">
	<div class='borrow-sorter'>
		<a href='./?details&by=1' class='details-link'>książki + autor</a>
		<a href='./?details&by=2' class='details-link'>wypożyczenia + czytelnik + książki</a>
		<a href='./?details&by=3' class='details-link'>wypożyczenia + czytelnik + książki + autor</a>
	</div>
	<?php
		
		if(isset($_GET['by'])){
		switch($_GET['by']){
			case 1:
				echo "<h1>Książki + Autor</h1>";
				echo '<table><tr style="background: #aaa"><td>id_ksiazki</td><td>tytul</td><td>id_autora</td><td>nazwisko_autor</td><td>wydawnictwo</td><td>Rok_Publikacji</td></tr>';
				$query = mysqli_query($db, "SELECT *, books.id AS bookid, authors.id AS authid FROM books INNER JOIN authors ON books.author = authors.id");
				$rows = mysqli_num_rows($query);
				for ($i=1; $i<=$rows; $i++){
					$result = mysqli_fetch_array($query);
					if($i%2 == 0) echo "<tr style='background: #aaa'>";
					else echo "<tr style='background: #ddd'>";
					echo '<td>'.$result['bookid'].'</td>';
					echo '<td>'.$result['title'].'</td>';
					echo '<td>'.$result['authid'].'</td>';
					echo '<td>'.$result['surname'].'</td>';
					echo '<td>'.$result['publisher'].'</td>';
					echo '<td>'.$result['published'].'</td>';
					echo "</tr>";
				}
				break;
			case 2:
				echo "<h1>Wypożyczenia + Czytelnik + Książki</h1>";
				echo '<table><tr style="background: #aaa"><td>id</td><td>data_wyp</td><td>data_odd</td><td>id_ksiazki</td><td>id_autora</td><td>tytul</td><td>id_czytelnik</td><td>nazwisko</td></tr>';
				$query = mysqli_query($db, "SELECT *, borrowed.id AS borrid, books.id AS bookid, authors.id AS authid, users.id AS usid, users.surname AS ussurname FROM borrowed INNER JOIN books ON borrowed.book = books.id INNER JOIN users ON borrowed.client = users.id INNER JOIN authors ON books.author = authors.id ORDER BY borrowed.id");
				$rows = mysqli_num_rows($query);
				for ($i=1; $i<=$rows; $i++){
					$result = mysqli_fetch_array($query);
					if($i%2 == 0) echo "<tr style='background: #aaa'>";
					else echo "<tr style='background: #ddd'>";
					echo '<td>'.$result['borrid'].'</td>';
					echo '<td>'.$result['start'].'</td>';
					echo '<td>'.$result['ended'].'</td>';
					echo '<td>'.$result['bookid'].'</td>';
					echo '<td>'.$result['authid'].'</td>';
					echo '<td>'.$result['title'].'</td>';
					echo '<td>'.$result['usid'].'</td>';
					echo '<td>'.$result['ussurname'].'</td>';

					echo "</tr>";
				}
				break;
			case 3:
				echo "<h1>Wypożyczenia + Czytelnik + Książki + Autor</h1>";
				echo '<table><tr style="background: #aaa"><td>id</td><td>data_wyp</td><td>data_odd</td><td>id_ksiazki</td><td>id_autora</td><td>Nazwisko</td><td>tytul</td><td>id_czytelnik</td><td>nazwisko</td></tr>';
				$query = mysqli_query($db, "SELECT *, borrowed.id AS borrid, books.id AS bookid, authors.id AS authid, users.id AS usid, users.surname AS ussurname, authors.surname AS autsur FROM borrowed INNER JOIN books ON borrowed.book = books.id INNER JOIN users ON borrowed.client = users.id INNER JOIN authors ON books.author = authors.id ORDER BY borrowed.id");
				$rows = mysqli_num_rows($query);
				for ($i=1; $i<=$rows; $i++){
					$result = mysqli_fetch_array($query);
					if($i%2 == 0) echo "<tr style='background: #aaa'>";
					else echo "<tr style='background: #ddd'>";
					echo '<td>'.$result['borrid'].'</td>';
					echo '<td>'.$result['start'].'</td>';
					echo '<td>'.$result['ended'].'</td>';
					echo '<td>'.$result['bookid'].'</td>';
					echo '<td>'.$result['authid'].'</td>';
					echo '<td>'.$result['autsur'].'</td>';
					echo '<td>'.$result['title'].'</td>';
					echo '<td>'.$result['usid'].'</td>';
					echo '<td>'.$result['ussurname'].'</td>';

					echo "</tr>";
				}
				break;
			default: 
				echo "<h1>Wybierz typ z listy powyżej</h1>";
				break;	
		}
		}
	?>

	</table>
</div> 