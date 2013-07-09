<div class="container">
	<div class="row">
		<form method="post" action="">
			<?php
				echo $recaptcha;
			?>
			<div class="control-group">
			    <div class="controls">
			        <input type="hidden" name="entreprise_partenaire" value="<?php echo $entreprise_partenaire; ?>" >
			        <h5><?php echo form_error('entreprise_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
			    	<input type="hidden" name="adresse_partenaire" value="<?php echo $adresse_partenaire; ?>" >
		    		<h5><?php echo form_error('adresse_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			    	<input type="hidden" name="localisation_partenaire" value="<?php echo $localisation_partenaire; ?>" >
			        <h5><?php echo form_error('localisation_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
			    	<input type="hidden" name="contact_partenaire" value="<?php echo $contact_partenaire; ?>" >
		    		<h5><?php echo form_error('contact_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			    	<input type="hidden" name="telephone_partenaire" value="<?php echo $telephone_partenaire; ?>" >
			        <h5><?php echo form_error('telephone_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			    	<input type="hidden" name="email_partenaire" value="<?php echo $email_partenaire; ?>" >
			        <h5><?php echo form_error('email_partenaire'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			    	<input type="hidden" name="choix_partenaire" value="<?php echo $choix_partenaire; ?>" >
			    </div>
			</div>
			
		 	 <div class="control-group">
			    <div class="controls">
			      <button class="btn btn-success" type="submit" name="validation" value="creerpartenaire">Envoyer</button>
			    </div>
			 </div>
		</form>
	</div>
</div>