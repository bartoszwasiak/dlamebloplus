<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Nowy Autor";
		require("./pages/header.php");
	?> 
</head>
<div class="register-page">
	<h1>Nowy Autor</h1>
	<h2> <span class="star">*</span> <span style="color: gray;"> pole obowiązkowe</span></h2>
    <form method="post" action="./?new_author">
		<div class="row">
			<p>Imie <span class="star">*</span></p>
			<input maxlength="30" type="text" name="a_name">
		</div>
		<div class="row">
			<p>Nazwisko <span class="star">*</span></p>
			<input maxlength="30" type="text" name="a_surname">
		</div>
		<div class="row">
			<p>Data Urodzenia <span class="star">*</span></p>
			<input type="date" name="a_birthday">
		</div>

		<button type="submit" class="reg-button" name="add_author">dodaj autora</button>  
    </form> 
</div> 