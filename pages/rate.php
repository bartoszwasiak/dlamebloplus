<?php 
	include('server.php');
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	else{
		header("location: ./");
	}
	$bookid = $_GET['book'];
	$rated = $_GET['rate'];

	$query = mysqli_query($db, 'SELECT * FROM rates INNER JOIN users ON rates.client = users.id WHERE rates.book = '.$bookid.' AND users.username="'.$username.'"');
	$result = mysqli_fetch_array($query);
	
	$query2 = mysqli_query($db, 'SELECT id FROM users WHERE username = "'.$username.'"');
	$result2 = mysqli_fetch_array($query2);
	if(isset($result2['id'])) $userid = $result2['id'];
	else exit();

	
	if(mysqli_num_rows($query) < 1){
		$query3 = "INSERT INTO rates VALUES(NULL, '$userid', '$bookid', '$rated')";
		mysqli_query($db, $query3);
	}
	else{
		$query3 = "UPDATE rates SET rate = '$rated' WHERE client = '$userid' AND book = ".$_GET['book']."";
		mysqli_query($db, $query3);
	}
	header("location: ./?book=".$bookid);

?>