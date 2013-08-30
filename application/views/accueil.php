<?php if(validation_errors()) echo "<script>alert('Les champs ne sont pas correctement remplis')</script>" ?>
	<div class="row-fluid">
		<div class="carte span12">
			<form class="form-horizontal" method="post" action="<?php echo site_url('valideagenda');?>" onsubmit='return verif_champs();'>
				<center><h3>Annonces ta Disco Soupe</h3></center>
				<hr />
				<div class="input-append">
					<div class="control-group">
						<script>
						  $(function() {
						    $( "#date" ).datetimepicker();
						  });
						</script>
						<label class="control-label" for="Date">Date :</label>
					    <div class="controls">
					        <input id="date" type="text" name="date" value="<?php echo set_value('date'); ?>" />
					        <h5><?php echo form_error('date'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-prepend">
					<div class="control-group"> 
						<label class="control-label" for="lieu">Lieu :</label>
					    <div class="controls">
					      <input type="text" id="lieu"  name="lieu" value="<?php echo set_value('lieu'); ?>" >
					      <h5><?php echo form_error('lieu'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-append">
					<div class="control-group"> 
						<label class="control-label" for="adresse">Adresse de contact :</label>
					    <div class="controls">
					      <textarea id="adresse" name="adresse"><?php echo set_value('adresse'); ?></textarea>
					       <h5><?php echo form_error('adresse'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-prepend">
					<div class="control-group">
						<label class="control-label" for="evenement">Evènement :</label>
					    <div class="controls">
					    	<textarea id="evenement" name="evenement"><?php echo set_value('evenement'); ?></textarea>
				    		<h5><?php echo form_error('evenement'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-append">
					<div class="control-group"> 
						<label class="control-label" for="telephone">Téléphone :</label>
					    <div class="controls">
					      <input type="text" id="telephone"  name="telephone" value="<?php echo set_value('telephone'); ?>" >
					       <h5><?php echo form_error('telephone'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-prepend">
					<div class="control-group"> 
						<label class="control-label" for="contact">Contact :</label>
					    <div class="controls">
					      <input type="text" id="contact" name="contact" value="<?php echo set_value('contact'); ?>" >
					       <h5><?php echo form_error('contact'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-append">
					<div class="control-group"> 
						<label class="control-label" for="email">Email :</label>
					    <div class="controls">
					      <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" >
					       <h5><?php echo form_error('email'); ?></h5>
					    </div>
					</div>
				</div>
				<div class="input-prepend">
					<div class="control-group">
					    <div class="controls">
							<button class="btn btn-success" type="submit" name="validation" value="creerdisco">Envoyer</button>
					    </div>
					</div>
				</div>
			</form>
		</div>
	</div>
<script>
	function verif_champs(){
		if(document.getElementById('date').value == "" || document.getElementById('lieu').value == "" || document.getElementById('adresse').value == "" || document.getElementById('evenement').value == "" || document.getElementById('telephone').value == "" || document.getElementById('contact').value == "" || document.getElementById('email').value == ""){
			alert('Tous les champs sont obligatoires !');
			return false
		}
		else{
			return true;
		}
	}
	
</script>