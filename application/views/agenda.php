<div class="row-fluid">
	<div class="fondjaune span12">
		<center><h1>l'agenda et les évènements</h1></center>
	</div>
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
						echo "var detail".$cpt." = '<div id=\"content\"><div id=\"siteNotice\"><b>".$disco->adresse." - ".$disco->ville."<br />".date('d F à G:i' , strtotime($disco->date))."</b><br />disco</div></div>'
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
			  map.setZoom(16);
			  /*
			  var marker = new google.maps.Marker({
				  map: map,
				  position: results[0].geometry.location
			  });
			  */
			} else {
			  alert('Geocode was not successful for the following reason: ' + status);
			}
		  });
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</div>
<div class="row-fluid">
	<table class="carte span12">
		<tr>
			<td valign="top">
				<div id="map-canvas" style="width: 600px; height: 500px; margin: 20px auto;"></div>
			</td>
			<td width="30"></td>
			<td valign="top">
				<div>
					<br />
					<input id="address" type="textbox" placeholder="Entrez un lieu" />
					<input type="button" class="btn btn-primary" value="Rechercher" onclick="codeVoyager()" />
					<br /><br />
				</div>
				<?php
					foreach ($discosoupe as $disco) {
						$timestamp = strtotime($disco->date);
						echo "<b>".$disco->adresse." - ".$disco->ville."<br />".
						$convertjour[date('w', $timestamp)]." ".date('d', $timestamp)." ".$convertmois[date('n', $timestamp)]." ".date('Y', $timestamp)."</b><br />".
						$disco->evenement."<br />
						<div align='right'><a onclick=\"document.getElementById('address').value='".$disco->adresse.", ".$disco->ville."';codeVoyager();\">> Localiser sur la carte</a></div>
						<hr />";
					}
				?>
			</td>
		</tr>
	</table>
</div>