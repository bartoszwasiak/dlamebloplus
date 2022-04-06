<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Nowe Wypożyczenie";
		require("./pages/header.php");
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	?> 
</head>
<div class="register-page">
	<h1>Rejestracja Wypożyczenia</h1>
	<h2> <span class="star">*</span> <span style="color: gray;"> pole obowiązkowe</span></h2>
    <form method="post" action="./?new_borrow">
		<div class="row">
			<p>Użytkownik <span class="star">*</span></p>
			<select name="b_user">
				<?php
					$query = mysqli_query($db, 'SELECT * FROM users');
					$rows = mysqli_num_rows($query);

					for($i=1; $i<=$rows; $i++){
						$result = mysqli_fetch_array($query);
						echo "<option value='".$result['id']."'>".$result['name']." ".$result['surname']." (".$result['username'].")</option>";
					}
				?>
			</select>
		</div>
		<div class="row">
			<p>Książka <span class="star">*</span></p>
			<select name="b_book">
				<?php
					$query2 = mysqli_query($db, 'SELECT *, books.id AS bookid FROM books INNER JOIN authors ON books.author = authors.id WHERE books.quantity > 0');
					$rows2 = mysqli_num_rows($query2);
					for($i=1; $i<=$rows2; $i++){
						$result2 = mysqli_fetch_array($query2);
						echo "<option value='".$result2['bookid']."'>".$result2['title']." | ".$result2['surname']." ".$result2['name']."</option>";
					}
				?>
			</select>
		</div>
		<div class="row">
			<p>Data Wypożyczenia <span class="star">*</span></p>
			<input value="<?php echo date('Y-m-d') ?>" type="date" name="b_start">
		</div>

		<button type="submit" class="reg-button" name="add_borrow">WYPOŻYCZ</button>  
    </form> 
</div> 