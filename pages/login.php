<?php include('server.php') ?> 
<div class="account-panel">
	<form method="post" action="./">
		<div class="row"> <img src="./images/acc.png"> <input name="username" placeholder="Login" type="text"></div>
		<div class="row"><img src="./images/lock.png"> <input name="password" placeholder="•••••" type="password"></div>
        <a draggable="false" class="login" name="reg" href="?register">rejestracja</a> 
        <button class="register" type="submit" name="login_user">zaloguj</button> 
	</form>
	<?php include('./pages/error.php');?>
</div>