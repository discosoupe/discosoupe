<?php if(validation_errors()) echo "<script>alert('Les champs ne sont pas correctement remplis')</script>" ?>

	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li><a href="<?php echo site_url('accueil');?>">Annonces ta disco soupe</a></li>
	    <li class="active"><a href="#tab2">Annonces ton partenariat</a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab2">
	    	<div class="well">
				<form class="form-horizontal" method="post" action="<?php echo site_url('validepartenaire');?>" onsubmit='return verif_champs();'>
					<div class="input-append">
						<div class="control-group">
							<label class="control-label" for="entreprise">Entreprise :</label>
						    <div class="controls">
						        <input type="text" id="entreprise_partenaire" name="entreprise_partenaire" value="<?php echo set_value('entreprise_partenaire'); ?>" />
						        <h5><?php echo form_error('entreprise_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-prepend">
						<div class="control-group">
							<label class="control-label" for="adresse">Adresse :</label>
						    <div class="controls">
						    	<textarea id="adresse_partenaire" name="adresse_partenaire"><?php echo set_value('adresse_partenaire'); ?></textarea>
					    		<h5><?php echo form_error('adresse_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-append">
						<div class="control-group"> 
							<label class="control-label" for="localisation">Localisation</label>
						    <div class="controls">
						      <input type="text" id="localisation_partenaire" name="localisation_partenaire" value="<?php echo set_value('localisation_partenaire'); ?>" >
						       <h5><?php echo form_error('localisation_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-append">
						<div class="control-group">
							<label class="control-label" for="contact">Contact :</label>
						    <div class="controls">
						    	<input type="text" id="contact_partenaire" name="contact_partenaire" value="<?php echo set_value('contact_partenaire'); ?>" >
					    		<h5><?php echo form_error('contact_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-prepend">
						<div class="control-group"> 
							<label class="control-label" for="telephone">Téléphone :</label>
						    <div class="controls">
						      <input type="text" id="telephone_partenaire" name="telephone_partenaire" value="<?php echo set_value('telephone_partenaire'); ?>" >
						       <h5><?php echo form_error('telephone_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-append">
						<div class="control-group"> 
							<label class="control-label" for="email">Email :</label>
						    <div class="controls">
						      <input type="text" id="email_partenaire" name="email_partenaire" value="<?php echo set_value('email_partenaire'); ?>" >
						       <h5><?php echo form_error('email_partenaire'); ?></h5>
						    </div>
						</div>
					</div>
					<div class="input-prepend">
						<div class="control-group"> 
							<label class="control-label" for="choix">Choix partenariat :</label>
						    <div class="controls">
						    	<select id="choix_partenaire" name="choix_partenaire">
						    		<option value="1" <?php if(set_value('choix_partenaire') == 1) echo 'selected="selected"'; ?>>fournisseur</option>
						    		<option value="2" <?php if(set_value('choix_partenaire') == 2) echo 'selected="selected"'; ?>>transporteur</option>
						    		<option value="3" <?php if(set_value('choix_partenaire') == 3) echo 'selected="selected"'; ?>>financeur</option>
						    	</select>
						    </div>
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
	  </div>
	</div>
</div>

<script>
	function verif_champs(){
		if(document.getElementById('entreprise_partenaire').value == "" || document.getElementById('adresse_partenaire').value == "" || document.getElementById('localisation_partenaire').value == "" || document.getElementById('contact_partenaire').value == "" || document.getElementById('telephone_partenaire').value == "" || document.getElementById('email_partenaire').value == ""){
			alert('Tous les champs sont obligatoires !');
			return false
		}
		else{
			return true;
		}
	}
	
</script>