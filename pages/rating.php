<div>Twoja Ocena</div>
	<form method="post" action="./?rate">
	<?php
		$query2 = mysqli_query($db, 'SELECT rates.rate from rates INNER JOIN users ON rates.client = users.id INNER JOIN books ON rates.book = books.id WHERE books.id ="'.$_GET['book'].'" AND users.username = "'.$_SESSION['username'].'"');
		$result2 = mysqli_fetch_array($query2);
		if(isset($result2['rate'])) $rate = $result2['rate'];
		else $rate = 0;
		for($i = 1 ; $i<6; $i++){
			if($i>$rate){ echo "<a class='book-star star-unchecked' href='?rate=".$i."&book=".$_GET['book']."' id='star_".$i."' name='rat".$i."'>★</a>";}
			else{ echo "<a class='book-star star-checked' href='?rate=".$i."&book=".$_GET['book']."' id='star_".$i."'name='rat".$i."'>★</a>"; }
		}
		echo '<div class="hidden-rate" id='.$rate.'style="display: none"></div>';
?>
</form>