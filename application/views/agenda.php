<div class="container">
	<div class="row">
    	<div class="span12">
    		<h1>l'agenda et les évènements</h1>
    		<br />
    		<script>
				var geocoder;
				var map;
				
				function initialize() {
					geocoder = new google.maps.Geocoder();
					var latlng = new google.maps.LatLng(46.2276380, 2.2137490);
					var mapOptions = {
						zoom: 5,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					
					<?php 
						$cpt = 0;
		    			foreach ($discosoupe as $disco) {
		    				if($disco->latitude != "" || $disco->latitude != 0 || $disco->latitude != "0"){
		    					$aleatoire = rand(0, 4);
		    					echo "var image".$cpt." = '../../assets/images/fruits/fruit".$aleatoire.".png';";
								
			    				echo "var latlng".$cpt." = new google.maps.LatLng".$disco->latitude.";
			    				";
								echo "var detail".$cpt." = '".$disco->adresse."<br /><br />".$disco->evenement."'
								";
								
								echo "
									var marker".$cpt." = new google.maps.Marker({
										map: map,
										position: latlng".$cpt.",
										icon: image".$cpt."
									});
									var infowindow".$cpt." = new google.maps.InfoWindow({
										content: detail".$cpt."
									});
									google.maps.event.addListener(marker".$cpt.", 'click', function() {
									  infowindow".$cpt.".open(map,marker".$cpt.");
									});
								";
								$cpt = $cpt + 1;
							}
						}
		    		?>
				}
		
				function codeVoyager() {
				  var address = document.getElementById('address').value;
				  geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
					  map.setCenter(results[0].geometry.location);
					  var marker = new google.maps.Marker({
				          map: map,
				          position: results[0].geometry.location
				      });
					} else {
					  alert('Geocode was not successful for the following reason: ' + status);
					}
				  });
				}
				google.maps.event.addDomListener(window, 'load', initialize);
		    </script>
    	</div>
	</div>
	<div class="row">
		<div class="span12" align="center">
			<input id="address" type="textbox" value="Paris">
			<input type="button" class="btn btn-primary" value="Voyager" onclick="codeVoyager()">
		</span>
    </div>
	<div class="row">
		<div id="map-canvas" style="width: 600px; height: 500px; margin: 20px auto;"</div>
	</div>
</div>