<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./files/style.css">
		<link rel="stylesheet" href="./files/fonts.css">
        <script type="text/javascript" src="./files/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="./files/jquery-ui.js"></script>
        <script type="text/javascript" src="./files/scripts.js"></script>
		<link rel="icon" type="image/png" href="./favicon.ico"/>
		<?php
		$link = @mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus');
		if (!$link) {
			die('<div style="display: flex; flex-flow: column; justify-content: center; align-items: center;"> <p style="font-variant: small-caps; font-weight: 700; margin-top: 30px; text-align: center; font-size: 23px; font-family: ""Roboto"";">błąd połączenia z bazą danych:</p> <br><p style="font-variant: small-caps; font-weigth: 700; text-align: center; color: gray; font-size: 25px; text-transform: uppercase; font-variant: small-caps;">'. mysqli_connect_error().'</p><a style="margin-top: 40px; text-align: center; color: #c00; font-variant: small-caps; font-family: Roboto; font-size: 30px;" target="_blank" href="./files/base.txt">pobierz baze danych</a></div>');
		}
		?>
	</head>
	<body>
		<div class="header">
			<a draggable="false" href="./" class="logo">
				<p class="sup">Biblioteka</p>
				<p class="sub">On-line</p>
			</a>

			<div class="account-panel">
				<?php
					if(session_status() == PHP_SESSION_NONE) {
						session_start();
					}
					if(!isset($_SESSION['username'])){ 
						include('./pages/login.php');
					}
					else{
						echo'<a draggable="false" class="user-link" href="./?user='.$_SESSION['username'].'"><img draggable="false" src="./images/acc.png"></a><div class="account-info"><p>Witaj, <span style="color: #c00; font-weight: 700;">'.$_SESSION['who'].'</span>!</p><p>Zalogowano jako: <br><span style="color: #c00; font-weight: 700;">'.$_SESSION['rank'].'</span></p></div>';
						echo '<a draggable="false" class="logout" href="./?logout"><img draggable="false" src="./images/logout.png"></a>';
					}
					if(isset($_GET['logout'])){ 
						session_destroy();
						unset($_SESSION['username']);
						unset($_SESSION['who']);
						unset($_SESSION['rank']);
						header("location: ./");
					} 
				?> 

			</div>
		</div>

		<div class="content">
			<div class="nav-bar">
				<ul class="nav-list">
					<li><a draggable="false" href="./?users">użytkownicy</a></li>
					<li><a draggable="false" href="./?books">książki</a></li>
					<li><a draggable="false" href="./?authors">autorzy</a></li>
					
					<?php  
						if((isset($_SESSION['rank'])) && ($_SESSION['rank'] == "Administrator")){
							echo "<li><a draggable='false' href='./?new_borrow'>dodaj wypożyczenie</a></li><li><a draggable='false' href='./?borrowed'>historia wypożyczeń</a></li>";
						}
					?>
				</ul>
			</div>
			<?php
				if(isset($_GET['register'])){
					if(!isset($_SESSION['username'])){
						include('./pages/register.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['new_book'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/newbook.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['new_author'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/newauthor.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['edit_book'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/editbook.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['edit_author'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/editauthor.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['borrowed'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/borrowed.php');
					}
					else{
						header("location: ./");
					}
				}
				else if((isset($_GET['delete_borrow'])) || (isset($_GET['end_borrow']))){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/borrowhandle.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['details'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/detailed.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['rate'])){
					include('./pages/rate.php');
				}
				else if(isset($_GET['users'])){
					include('./pages/users.php');
				}
				else if(isset($_GET['authors'])){
					include('./pages/authors.php');
				}
				else if(isset($_GET['books'])){
					include('./pages/books.php');
				}

				else if(isset($_GET['user'])){
					if($_GET['user'] != ""){
						include('./pages/user.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['author'])){
					if($_GET['author'] != ""){
						include('./pages/author.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['book'])){
					if($_GET['book'] != ""){
						include('./pages/book.php');
					}
					else{
						header("location: ./");
					}
				}
				else if(isset($_GET['new_borrow'])){
					if(isset($_SESSION['username']) && ($_SESSION['username'] == "admin")){
						include('./pages/newborrow.php');
					}
					else{
						header("location: ./");
					}
				}
				else{
					include('./pages/main.php');
				}
			?>
		</div>
		
	</body>
</html>