<?php
	if (count($errors) > 0) : ?> 
	<div class="error"> 
		<?php foreach ($errors as $error) : ?> 
		<p><?php echo "<p class='err'>$error</p>" ?></p> 
		<?php endforeach ?> 
    </div> 
<?php  endif ?> 