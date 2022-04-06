<head>
	<?php 
		include('./pages/server.php');
		$title = "Biblioteka :: Edycja";
		require("./pages/header.php");

		if(!isset($_GET['book'])){
			header('location: ./');
		}
		$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
		
		$query = mysqli_query($db, 'SELECT * FROM books INNER JOIN authors ON books.author = authors.id WHERE books.id = '.$_GET['book'].'');
		$result = mysqli_fetch_array($query);
	?> 
</head>
<div class="register-page">
	<h1>Edycja Książki</h1>
	<h2> <span class="star">*</span> <span style="color: gray;"> pole obowiązkowe</span></h2>
    <form method="post" action="./?edit_book&book=<?php echo $_GET['book']; ?>">
		<div class="row">
			<p>Tytuł <span class="star">*</span></p>
			<input value="<?php echo $result['title']; ?>" maxlength="50" type="text" name="title">
		</div>
		<div class="row">
			<p>Autor <span class="star">*</span></p>
			<select name="author">
				<?php
					$query2 = mysqli_query($db, 'SELECT * FROM authors');
					$rows2 = mysqli_num_rows($query2);
					for($i=1; $i<=$rows2; $i++){
						$result2 = mysqli_fetch_array($query2);
						if($result['id'] == $result2['id']){
							echo "<option selected value='".$result2['id']."'>".$result2['name']." ".$result2['surname']."</option>";
						}
						else{
							echo "<option value='".$result2['id']."'>".$result2['name']." ".$result2['surname']."</option>";
						}
					}
				?>
			</select>
		</div>
		<div class="row">
			<p>Wydawnictwo <span class="star">*</span></p>
			<input value="<?php echo $result['publisher']; ?>"maxlength="30" type="text" name="publisher">
		</div>
		<div class="row">
			<p>Rok Wydania <span class="star">*</span></p>
			<input value="<?php echo $result['published']; ?>" type="number" maxlength="4" min="1000" max="2020" value="2020" name="publish_year">
		</div>
		<div class="row">
			<p>Ilość Książek <span class="star">*</span></p>
			<input value="<?php echo $result['quantity']; ?>"type="number" min="0" name="quantity">
		</div>

		<button type="submit" class="reg-button" name="edit_book">edytuj książkę</button>
		<button type="submit" class="reg-button" name="remove_book">usuń książkę</button>

    </form> 
</div> 