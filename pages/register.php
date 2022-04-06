<head>
	<?php include('./pages/server.php'); ?> 
</head>
<div class="register-page">
	<h1>Rejestracja</h1>
	<h2> <span class="star">*</span> pole obowiązkowe</h2>
    <form method="post" action="./?register">
		<div class="row">
			<p>Login <span class="star">*</span></p>
			<input maxlength="30" type="text" name="username">
		</div>
		<div class="row">
			<p>Imię <span class="star">*</span></p>
			<input maxlength="15" type="text" name="name">
		</div>
		<div class="row">
			<p>Nazwisko <span class="star">*</span></p>
			<input maxlength="30" type="text" name="surname">
		</div>
		<div class="row">
			<p>Data Urodzenia <span class="star">*</span></p>
			<input type="date" name="date">
		</div>
		<div class="row">
			<p>Hasło <span class="star">*</span></p>
			<input maxlength="50" type="password" name="password_1">
		</div>
		<div class="row">
			<p>Powtórz Hasło <span class="star">*</span></p>
			<input maxlength="50" type="password" name="password_2">
		</div>

		<button type="submit" class="reg-button" name="reg_user">stwórz konto</button>  
    </form> 
</div> 