<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Nowa Książka";
		require("./pages/header.php");
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	?> 
</head>
<div class="register-page">
	<h1>Nowa Książka</h1>
	<h2> <span class="star">*</span> <span style="color: gray;"> pole obowiązkowe</span></h2>
    <form method="post" action="./?new_book">
		<div class="row">
			<p>Tytuł <span class="star">*</span></p>
			<input maxlength="50" type="text" name="title">
		</div>
		<div class="row">
			<p>Autor <span class="star">*</span></p>
			<select name="author">
				<?php
					$query = mysqli_query($db, 'SELECT * FROM authors');
					$rows = mysqli_num_rows($query);
					for($i=1; $i<=$rows; $i++){
						$result = mysqli_fetch_array($query);
						echo "<option value='".$result['id']."'>".$result['name']." ".$result['surname']."</option>";
					}
				?>
			</select>
		</div>
		<div class="row">
			<p>Wydawnictwo <span class="star">*</span></p>
			<input maxlength="30" type="text" name="publisher">
		</div>
		<div class="row">
			<p>Rok Wydania <span class="star">*</span></p>
			<input type="number" maxlength="4" min="1000" max="2020" value="2020" name="publish_year">
		</div>
		<div class="row">
			<p>Ilość Książek <span class="star">*</span></p>
			<input type="number" min="0" name="quantity">
		</div>
		<div class="row">
			<p>Opis Książki <span class="star">*</span></p>
			<textarea name="description" maxlength="300" min="0" name="quantity">Brak opisu...</textarea>
		</div>

		<button type="submit" class="reg-button" name="add_book">dodaj książkę</button>  
    </form> 
</div> 