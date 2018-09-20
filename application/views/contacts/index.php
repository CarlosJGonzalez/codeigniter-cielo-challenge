
	<div id="content">
		<?php 
			if(is_array($contacts) && count($contacts)>0)
			{
				foreach ($contacts as $contact): ?>
				<div class="contact_container">
			        <h3><?php echo ucwords($contact['name']); ?></h3>
			        <div class="main">
			                <?php echo $contact['dob']; ?>
			        </div>
			        <p><a href="<?=base_url();?>contacts/<?=$contact['id']; ?>">View contact</a></p>
				</div>
		<?php 
				endforeach;
			}else{
				echo '<p><h1>No contacts were found.</h1></p>';
				echo '<p><a href="'.base_url().'contacts/create">New Contact</a></p>';
			}?>
	</div>
