<?php if(validation_errors()) echo "<script>alert('Les champs ne sont pas correctement remplis')</script>" ?>
	<div class="row-fluid">
		<div class="carte span6">
			<form name="formannonce" class="form-horizontal" method="post" action="<?php echo site_url('valideagenda');?>" onsubmit='return verif_champs();'>
				<center><h3>Annonces ta Disco Soupe</h3></center>
				<hr />
				<table width="100%">
					<tr>
						<td><?php echo img("floriane/picto-home-ds.jpg", $alt = "marmitte");?></td>
						<td><input id="evenement" name="evenement" type="text" placeholder="nom de l'évènement"></input></td>
						<td rowspan=4 onclick="
							if(verif_champs()){
								formannonce.submit();
							}
						" style="cursor: pointer" valign="bottom"><?php echo img("floriane/picto-home-cesttressimple.jpg", $alt = "marmitte");?><h4 style="margin: 10px;">GO GO GO</h4></td>
					</tr>
					<tr>
						<td><?php echo img("floriane/picto-home-date.jpg", $alt = "date");?></td>
						<td><input id="date" type="text" name="date" value="<?php echo set_value('date'); ?>" placeholder="date"/>
							<script>
							  $(function() {
							    $( "#date" ).datetimepicker();
							  });
							</script>
							<?php echo form_error('date'); ?>
						</td>
					</tr>
					<tr>
						<td><?php echo img("floriane/picto-home-lieu.jpg", $alt = "lieu");?></td>
						<td><input type="text" id="lieu"  name="lieu" value="<?php echo set_value('lieu'); ?>" placeholder="lieu"></td>
					</tr>
					<tr>
						<td><?php echo img("floriane/picto-home-tel.jpg", $alt = "tel");?></td>
						<td><input type="text" id="contact" name="contact" value="<?php echo set_value('contact'); ?>" placeholder="email de contact">
					    </input></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="carte span6">	<center><h3>Organises ta disco soupe</h3></center>
			<hr />
			<table width="100%">
				<tr>
					<td><?php echo img("floriane/image-home-letoolkitatelecharger.jpg", $alt = "organise");?></td>
					<td><a href="<?php echo img_url('temp/ToolkitV2contenus.pdf');?>">
						<?php echo img("floriane/picto-home-letoolkitatelecharger.jpg", $alt = "télécharger le toolkit");?><h4 style="margin: 10px;">CLIQUES ICI !</h4></a></td>
				</tr>
			</table>
		</div>
	</div>
<script>
	function verif_champs(){
		if(document.getElementById('date').value == "" || document.getElementById('lieu').value == "" || document.getElementById('evenement').value == "" || document.getElementById('contact').value == ""){
			alert('Tous les champs sont obligatoires !');
			return false
		}
		else{
			return true;
		}
	}
	
</script>
<br /><br /><br /><br />