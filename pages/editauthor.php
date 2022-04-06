<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Edycja";
		require("./pages/header.php");

		if(!isset($_GET['author'])){
			header('location: ./');
		}
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
		
		$query = mysqli_query($db, 'SELECT * FROM books INNER JOIN authors ON books.author = authors.id WHERE authors.id = '.$_GET['author'].'');
		$result = mysqli_fetch_array($query);
	?> 
</head>
<div class="register-page">
	<h1>Edycja Autora</h1>
	<h2> <span class="star">*</span> <span style="color: gray;"> pole obowiązkowe</span></h2>
    <form method="post" action="./?edit_author&author=<?php echo $_GET['author']; ?>">
		<div class="row">
			<p>Imie <span class="star">*</span></p>
			<input value="<?php echo $result['name']; ?>" maxlength="30" type="text" name="a_name">
		</div>
		<div class="row">
			<p>Nazwisko <span class="star">*</span></p>
			<input value="<?php echo $result['surname']; ?>" maxlength="30" type="text" name="a_surname">
		</div>
		<div class="row">
			<p>Data Urodzenia <span class="star">*</span></p>
			<input value="2000-01-01" type="date" name="a_birthday">
		</div>

		<button type="submit" class="reg-button" name="edit_author">edytuj autora</button>
		<button type="submit" class="reg-button" name="remove_author">usuń autora</button>

    </form> 
</div> 