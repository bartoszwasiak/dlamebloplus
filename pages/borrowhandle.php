<?php 
	include('server.php');
	$db = mysqli_connect('sql4.5v.pl', 'whoami_dlamebloplus', 'Zima2022!', 'whoami_dlamebloplus'); 
	
	if(isset($_GET['end_borrow'])){
		$id = $_GET['end_borrow'];
		$now = date('Y-m-d');
		$query2 = mysqli_query($db, "SELECT *, books.id AS bookid FROM borrowed INNER JOIN books ON borrowed.book = books.id WHERE borrowed.id = '$id'");
		$result = mysqli_fetch_array($query2);
		$am = ((int) $result['quantity']) + 1;
		$book = $result['bookid'];
		$query3 = mysqli_query($db, "UPDATE books SET quantity = '$am' WHERE id = '$book'");
		$query = mysqli_query($db, "UPDATE borrowed SET ended = '$now' WHERE id = '$id'");
	}
	else if(isset($_GET['delete_borrow'])){
		$id = $_GET['delete_borrow'];
		$query2 = mysqli_query($db, "SELECT *, books.id AS bookid FROM borrowed INNER JOIN books ON borrowed.book = books.id WHERE borrowed.id = '$id'");
		$result = mysqli_fetch_array($query2);
		$am = ((int) $result['quantity']) + 1;
		$book = $result['bookid'];
		$query3 = mysqli_query($db, "UPDATE books SET quantity = '$am' WHERE id = '$book'");
		$query = mysqli_query($db, "DELETE FROM borrowed WHERE id = '$id'");
	}
	header('location: ./?borrowed');
?>