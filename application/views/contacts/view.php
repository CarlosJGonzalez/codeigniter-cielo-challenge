
	<div id="content">
		<?php
		echo '<p><label>DOB:</label><span>' .$contact['dob'].'</span></p>';
		echo '<p><label>Email:</label><span>' .$contact['email'].'</span></p>';
		echo '<p><label>Fav. Color:</label><span>'.$contact['favcolor'].'</span></p>';
		?>
	</div>
	<a href="<?=base_url();?>contacts">Back</a>
	<a href="<?=base_url();?>contacts/delete/<?=$contact['id'];?>">Delete</a>
