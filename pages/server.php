<?php  
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$mysqli = new mysqli('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
	$mysqli->set_charset('utf8');

	$username = "";
	$errors = array();
	$_SESSION['success'] = "";
 
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');

	if(isset($_POST['reg_user'])) { 
		$username = mysqli_real_escape_string($db, $_POST['username']); 
		$name = mysqli_real_escape_string($db, $_POST['name']); 
		$surname = mysqli_real_escape_string($db, $_POST['surname']); 
		$birthday = mysqli_real_escape_string($db, $_POST['date']); 

		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']); 
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']); 
	   
		if(empty($username)){ array_push($errors, "Wprowadz nazwe uzytkownika.");} 
		if(empty($name)){ array_push($errors, "Wprowadz swoje imie.");} 
		if(empty($surname)){ array_push($errors, "Wprowadz swoje nazwisko.");} 
		if(empty($birthday)){ array_push($errors, "Wprowadz swoja date urodzenia.");} 

		if(empty($password_1)){ array_push($errors, "Wprowadz haslo.");}

		if($password_1 != $password_2) { 
			array_push($errors, "Hasla nie zgadzaja sie."); 
		}
		$query = "SELECT * FROM users WHERE username= '$username'";
		$results = mysqli_query($db, $query);
		if(mysqli_num_rows($results) >= 1){
			array_push($errors, "Wybrany login jest juz zajety."); 
		}
	
		if(count($errors) == 0){ 
			$password = md5($password_1); 
			$now = date('Y-m-d H:i:s');
			$query = "INSERT INTO users VALUES(NULL, '$username', '$password', '$name', '$surname', '$birthday', 'Czytelnik', '$now')";
			mysqli_query($db, $query);
			$_SESSION['username'] = $username; 
			
			$query = mysqli_query($db, 'SELECT name, rank FROM users WHERE username="'.$username.'"');
			$result = mysqli_fetch_array($query);

			$_SESSION['who'] = $result['name'];
			$_SESSION['rank'] = $result['rank'];
			$_SESSION['success'] = "Pomyslnie zalogowano!";
			header('location: ./');
		} 
	} 
	else if(isset($_POST['add_book'])){ 
		$title = mysqli_real_escape_string($db, $_POST['title']); 
		$author = mysqli_real_escape_string($db, $_POST['author']); 
		$publisher = mysqli_real_escape_string($db, $_POST['publisher']); 
		$year = mysqli_real_escape_string($db, $_POST['publish_year']); 
		$quant = mysqli_real_escape_string($db, $_POST['quantity']); 
		$descr = mysqli_real_escape_string($db, $_POST['description']); 

		if(empty($title)){ array_push($errors, "Wprowadz tytul ksiazki.");} 
		if(empty($author)){ array_push($errors, "Wprowadz autora ksiazki");} 
		if(empty($publisher)){ array_push($errors, "Wprowadz wydawnictwo ksiazki.");} 
		if(empty($year)){ array_push($errors, "Wprowadz date publikacji.");} 
		if(empty($quant)){ array_push($errors, "Wprowadz ilosc ksiazek.");} 
		if(empty($descr)){ $descr = 'Brak opisu...';} 

		if(count($errors) == 0){ 
			$query = "INSERT INTO books VALUES(NULL, '$title', '$author', '$publisher', '$year', '$quant', '$descr')";
			mysqli_query($db, $query);
			header('location: ./?books');
		}
	}
	else if(isset($_POST['add_author'])){ 
		$name = mysqli_real_escape_string($db, $_POST['a_name']); 
		$surname = mysqli_real_escape_string($db, $_POST['a_surname']); 
		$birthday = mysqli_real_escape_string($db, $_POST['a_birthday']); 
	   
		if(empty($name)){ array_push($errors, "Wprowadz imie autora.");} 
		if(empty($surname)){ array_push($errors, "Wprowadz nazwisko autora..");} 
		if(empty($birthday)){ array_push($errors, "Wprowadz urodziny autora.");} 

		if(count($errors) == 0){ 
			$query = "INSERT INTO authors VALUES(NULL, '$name', '$surname', '$birthday')";
			mysqli_query($db, $query);
			header('location: ./?authors');
		}
	}

	else if(isset($_POST['login_user'])){
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if(empty($username)){ 
			array_push($errors, "Podaj nazwe uzytkownika.");
		}
		if(empty($password)){ 
			array_push($errors, "Podaj haslo.");
		}

		if(count($errors) == 0){
			$password = md5($password); 
			$query = "SELECT * FROM users WHERE username= '$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			if(mysqli_num_rows($results) == 1){ 
				$_SESSION['username'] = $username;
				
				$query = mysqli_query($db, 'SELECT name, rank FROM users WHERE username="'.$username.'"');
				$result = mysqli_fetch_array($query);

				$_SESSION['who'] = $result['name'];
				$_SESSION['rank'] = $result['rank'];
	
				$_SESSION['success'] = "Pomyslnie zalogowano!";
				header('location: ./');
			}
			else{
				array_push($errors, "Nieprawidlowy login lub haslo.");
			}
		} 
	}
	else if(isset($_POST['edit_book'])){
		$title = mysqli_real_escape_string($db, $_POST['title']); 
		$author = mysqli_real_escape_string($db, $_POST['author']); 
		$publisher = mysqli_real_escape_string($db, $_POST['publisher']); 
		$year = mysqli_real_escape_string($db, $_POST['publish_year']); 
		$quant = mysqli_real_escape_string($db, $_POST['quantity']); 
		if(empty($_GET['book'])){ header('location: ./');} 
		if(empty($title)){ array_push($errors, "Wprowadz tytul ksiazki.");} 
		if(empty($author)){ array_push($errors, "Wprowadz autora ksiazki");} 
		if(empty($publisher)){ array_push($errors, "Wprowadz wydawnictwo ksiazki.");} 
		if(empty($year)){ array_push($errors, "Wprowadz date publikacji.");} 
		if(empty($quant)){ array_push($errors, "Wprowadz ilosc ksiazek.");} 
		if(empty($descr)){ $descr = 'Brak opisu...';} 
	
		if(count($errors) == 0){ 
			$query = "UPDATE books SET title = '$title', author = '$author', publisher = '$publisher', published = '$year', quantity = '$quant', descr = '$descr' WHERE id = '".$_GET['book']."'";
			mysqli_query($db, $query);
			echo '<p style="position: absolute; font-family: Roboto ; margin-top: 35px; font-weight: 700; color: #a00; font-size: 23px;">Książka została zaktualizowana!</p>';
		}
	}
	else if(isset($_POST['edit_author'])){
		$name = mysqli_real_escape_string($db, $_POST['a_name']); 
		$surname = mysqli_real_escape_string($db, $_POST['a_surname']); 
		$birthday = mysqli_real_escape_string($db, $_POST['a_birthday']); 
	   
		if(empty($_GET['author'])){ header('location: ./');} 
		if(empty($name)){ array_push($errors, "Wprowadz imie autora.");} 
		if(empty($surname)){ array_push($errors, "Wprowadz nazwisko autora.");} 
		if(empty($birthday)){ array_push($errors, "Wprowadz urodziny autora.");} 
	
		if(count($errors) == 0){ 
			$query = "UPDATE authors SET name = '$name', surname = '$surname', birthday = '$birthday' WHERE id = '".$_GET['author']."'";
			mysqli_query($db, $query);
			echo '<p style="position: absolute; font-family: Roboto ; margin-top: 35px; font-weight: 700; color: #a00; font-size: 23px;">Autor został zaktualizowany!</p>';
		}
	}
	else if(isset($_POST['remove_author'])){
		$query = "DELETE FROM authors WHERE id = '".$_GET['author']."'";
		mysqli_query($db, $query);
		header('location: ./?authors');
	}
	else if(isset($_POST['remove_book'])){
		$query = "DELETE FROM books WHERE id = '".$_GET['book']."'";
		mysqli_query($db, $query);
		header('location: ./?books');
	}
	else if(isset($_POST['add_borrow'])){ 
		$user = mysqli_real_escape_string($db, $_POST['b_user']); 
		$book = mysqli_real_escape_string($db, $_POST['b_book']); 
		$date = mysqli_real_escape_string($db, $_POST['b_start']); 
		
		if(empty($user)){ array_push($errors, "Wprowadz uzytkownika.");} 
		if(empty($book)){ array_push($errors, "Wprowadz ksiazke.");} 
		if(empty($date)){ array_push($errors, "Wprowadz date.");} 
		
		
		if(count($errors) == 0){ 
			$query = "INSERT INTO borrowed VALUES(NULL, '$user', '$book', '$date', NULL)";
			mysqli_query($db, $query);
			$query2 = mysqli_query($db, "SELECT username FROM users WHERE id='".$user."'");
			$query3 = mysqli_query($db, "SELECT * FROM books WHERE id = '$book'");
			$result2 = mysqli_fetch_array($query2);
			$result3 = mysqli_fetch_array($query3);
			$amount = $result3['quantity']-1;
			$query4 = mysqli_query($db, "UPDATE books SET quantity = '$amount' WHERE id = '$book'");

			header('location: ./?user='.$result2['username']);
		}
	}
	mysqli_close($db);
   
?> 