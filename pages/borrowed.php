<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Wypożyczenia";
		require("./pages/header.php");
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	?> 
</head>
<div class="borrowed">
	<?php
		$words = '';
		$what = 'users.name';
		if((isset($_POST['keywords'])) && ($_POST['keywords'] != "")){
			$words = $_POST['keywords'];
			$what = $_POST['as'];

			if(isset($_POST['fullword'])){
				$where = "WHERE $what = '$words'";
			}
			else{
				$where = "WHERE $what LIKE '%$words%'";
			}
		}
		else{
			$where = '';
		}
		if(!isset($_POST['sortby'])){
			$sortby = 'borrowed.start';
			$from = 'DESC';
		}
		else{
			$sortby = $_POST['sortby'];
			$from = $_POST['by'];
		}
		
		$order = "ORDER BY $sortby $from";
		
		$customquery = "$where $order";

	?>
	<div class='borrow-sorter'>
		<form method='post' action='./?borrowed'>
			<div>
				<input value='<?php echo $words; ?>' placeholder='Wprowadz hasło wyszukiwania...' class='sorter-text' name='keywords' type='text'><br>
				<input <?php if($what == "users.name") echo "checked"; ?> name='as' value='users.name' type='radio'><span>Imię</span>
				<input <?php if($what == "users.surname") echo "checked"; ?> name='as' value='users.surname' type='radio'><span>Nazwisko</span>
				<input <?php if($what == "books.title") echo "checked"; ?> name='as' value='books.title' type='radio'><span>Tytuł</span><br>
				<input <?php if($what == "users.username") echo "checked"; ?> name='as' value='users.username' type='radio'><span>Nazwa Użytkownika</span>

				<br>
				<input <?php if(isset($_POST['fullword'])) echo "checked"; ?> name='fullword' class='sorter-full' type='checkbox'><br><span>wyszukiwanie po pełnym polu</span>

			</div>
			<div>
				<span>Sortuj przez</span>
				<select name='sortby'>
					<option <?php if($sortby == "users.name") echo "selected"; ?> value='users.name'>Imię</option>
					<option <?php if($sortby == "users.surname") echo "selected"; ?> value='users.surname'>Nazwisko</option>
					<option <?php if($sortby == "books.title") echo "selected"; ?> value='books.title'>Tytuł</option>
					<option <?php if($sortby == "authors.name") echo "selected"; ?> value='authors.name'>Autor</option>
					<option <?php if($sortby == "borrowed.start") echo "selected"; ?> value='borrowed.start'>Data Wypożyczenia</option>

				</select>
				<br>
				<input name='by' value='ASC' type='radio'><span>Rosnąco</span>
				<br>
				<input checked name='by' value='DESC' type='radio'><span>Malejąco</span>
				<br>
				<button name='submit' type='submit'>filtruj</button>
			</form>
		</div>
	</div>
	<h1>Wypożyczone Książki</h1>
	<table>
		<tr style="background: #aaa"><td>użytkownik</td><td>książka</td><td>autor</td><td>data wyp.</td><td>zwrot</td><td></td></tr>
		<?php
			
			$query = mysqli_query($db, "SELECT *, borrowed.id AS borrid, books.id AS bookid, authors.id AS authorid, users.name AS usersname, users.surname AS userssurname, authors.name, authors.surname FROM borrowed INNER JOIN users ON borrowed.client = users.id INNER JOIN books ON borrowed.book = books.id INNER JOIN authors ON books.author = authors.id $customquery");
			$rows = mysqli_num_rows($query);
			for ($i=1; $i<=$rows; $i++){
				$result = mysqli_fetch_array($query);
				if($i%2 == 0) echo "<tr style='background: #aaa'>";
				else echo "<tr style='background: #ddd'>";

				echo "<td><a class='borrw-link' href='?user=".$result['username']."'>".$result['usersname']." ".$result['userssurname']." (".$result['username'].")</a></td>";
				echo "<td><a class='borrw-link' href='?book=".$result['bookid']."'>".$result['title']."</a></td>";
				echo "<td><a class='borrw-link' href='?author=".$result['authorid']."'>".$result['name']." ".$result['surname']."</a></td>";
				echo "<td>".$result['start']."</td>";
				if($result['ended'] != "" ){
					echo "<td>".$result['ended']."</td>";
				}
				else{
					echo "<td><a class='borrw-end' href='?end_borrow=".$result['borrid']."'>ZWROT</a></td>";
				}
	
				echo "<td><a class='borrw-delete' href='?delete_borrow=".$result['borrid']."'>USUŃ</a></td>";
				echo "</tr>";
			}
		?>

	</table>
</div> 