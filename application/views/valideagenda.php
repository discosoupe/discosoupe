<div class="container">
	<div class="row">
		<form method="post" action="">
			<?php
				echo $recaptcha;
			?>
			<div class="control-group">
			    <div class="controls">
			        <input id="lat" name="lat" type="hidden">
			        <h5><?php echo form_error('lat'); ?></h5>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
			        <input id="date" type="hidden" name="date" value="<?php echo $date; ?>" />
			        <h5><?php echo form_error('date'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			      <input type="hidden" id="lieu" name="lieu" value="<?php echo $lieu; ?>" >
			      <h5><?php echo form_error('lieu'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			    	<input type="hidden" id="adresse"  name="adresse" value="<?php echo $adresse; ?>" >
			       <h5><?php echo form_error('adresse'); ?></h5>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
			    	<input type="hidden" id="evenement"  name="evenement" value="<?php echo $evenement; ?>" >
		    		<h5><?php echo form_error('evenement'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			      <input type="hidden" id="telephone"  name="telephone" value="<?php echo $telephone; ?>" >
			       <h5><?php echo form_error('telephone'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			      <input type="hidden" id="contact"  name="contact" value="<?php echo $contact; ?>" >
			       <h5><?php echo form_error('contact'); ?></h5>
			    </div>
			</div>
			<div class="control-group"> 
			    <div class="controls">
			      <input type="hidden" id="email"  name="email" value="<?php echo $email; ?>" >
			       <h5><?php echo form_error('email'); ?></h5>
			    </div>
			</div>
		 	 <div class="control-group">
			    <div class="controls">
			      <button class="btn btn-success" type="submit" name="validation" value="creedisco">Valider</button>
			    </div>
			 </div>
		</form>
	  </div>
	
		<div id="map-canvas"></div>
	
		    <script>
				var geocoder;
				var map;
				function initialize() {
				  geocoder = new google.maps.Geocoder();
				  var mapOptions = {
					zoom: 8,
				    mapTypeId: google.maps.MapTypeId.ROADMAP
				  }
				  codeAddress();
				  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
				}
				
				function codeAddress() {
				  var address = "<?php echo $adresse;?>";
				  geocoder.geocode( { 'address': address}, function(results, status) {
				    if (status == google.maps.GeocoderStatus.OK) {
				      map.setCenter(results[0].geometry.location);
				      var marker = new google.maps.Marker({
				          map: map,
				          position: results[0].geometry.location
				      });
					  document.getElementById('lat').value = results[0].geometry.location;
				    } else {
				      alert('Votre adresse est invalide ! Veuillez contactez un administrateur');
				    }
				  });
				}
				
				google.maps.event.addDomListener(window, 'load', initialize);
		
		    </script>
    	</div>
	</div>
</div>

