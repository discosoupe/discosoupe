<div class="row-fluid">
	<div class="fondjaune soustitre span12">
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
						$discoevenement = NULL;
						$discodate = NULL;
						if($disco->valide == 1){
							$discoevenement = $disco->evenement;
							$discodate = date('d F à G:i' , strtotime($disco->date));
						}
						elseif($disco->valide == 2){
							foreach ($discosoupefb as $discofb) {
								if($disco->evenement == $discofb['eid']){
									$discoevenement = addslashes($discofb['name']);
									$discodate = date('d F à G:i' , strtotime($discofb['start_time']));
								}
							}
						}
						echo "var image".$cpt." = '../../assets/images/floriane/picto-home-lieu.jpg';";
						
						echo "var latlng".$cpt." = new google.maps.LatLng".$disco->latitude.";
						";
						echo "var detail".$cpt." = '<div id=\"content\"><div id=\"siteNotice\"><b>".$discoevenement."<br />".$disco->ville."<br />".$discodate."</b></div></div>'
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
<br />
<div class="row-fluid">
	<table class="carte span12">
		<caption id="critere">
			<form class="form-search">
				<span class="span4" style="margin-top: 8px;">
					<input id="mot" type="textbox" placeholder="Rechercher par mot" />
					<button style="cursor: pointer">
						<i class="icon-search"></i>
					</button>
				</span>
				
				<span class="span4">
					<input id="mois" type="textbox" placeholder="Rechercher par mois" />
					<a style="cursor: pointer">
						<?php echo img("floriane/picto-home-date.jpg", $alt = "lieu"); ?>
					</a>
				</span>
				
				<span class="span4">
					<input id="address" type="textbox" placeholder="Rechercher par ville" />
					<a onclick="codeVoyager()" style="cursor: pointer">
						<?php echo img("floriane/picto-home-lieu.jpg", $alt = "lieu"); ?>
					</a>
				</span>
			</form>
		</caption>
		<tr>
			<td valign="top">
				<div class="span12">
					<br />
			    	<div class="calendar_test"></div>
				</div>
				<script type="text/javascript">
					$(document).ready( function(){
						theMonths = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
						theDays = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
		
						$('.calendar_test').calendar({
							months: theMonths,
							days: theDays,
							req_ajax: {
								type: 'get',
								url: '<?php echo site_url('calendar');?>'
							}
						});
					});
				</script>
			</td>
			<td width="30"></td>
			<td valign="top">
				<div id="map-canvas" style="width: 400px; height: 225px; margin: 20px auto;"></div>
			</td>
		</tr>
	</table>
</div>
<br />
<div class="row-fluid">
	<div class="carte span12">
		<center><h4>Toutes les Disco Soupes</h4></center>
		<hr />
	</div>
</div>
<br />
<div class="row-fluid">
	<table class="span12">
		<tr>
			<?php
				$modal ='';
				$cpt = 0;
				foreach ($discosoupe as $disco) {
					if($disco->valide == 1){
						$evenement = $disco->evenement;
						$discodate = $disco->date;
						$discoville = $disco->ville;
					}
					elseif($disco->valide == 2){
						foreach ($discosoupefb as $discofb) {
							if($disco->evenement == $discofb['eid']){
								$evenement = $discofb['name'];
								$discodate = $discofb['start_time'];
								$discoville = $discofb['location'];
								
								$modal .= '
									<div id="event'.$discofb['eid'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
										<div class="modal-body form-horizontal">
									    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<table class="table table-striped">
													<caption>
														<h3>'.$discofb['name'].'</h3>
														<table class="table table-bordered">
															<tr>
															<td>Créateur</td><td>Emplacement</td>
															<td>date de début</td>';
															if($discofb['end_time']){
																$modal .= '<td>date de fin</td>';
															}
														$modal .= '<td>nombre de participants</td>
														</tr><tr>
														<td>'.$discofb['host'].'</td>
														<td>'.$discofb['location'].'</td>
														<td>'.date('j M Y - G:i' ,strtotime($discofb['start_time'])).'</td>';
														if($discofb['end_time']){
															$modal .= "<td>".date('j M Y - G:i' , strtotime($discofb['end_time']))."</td>";
														}
														$modal .=  "<td>".$discofb['attending_count']."</td>";
													$modal .=  "</tr></table>";
											$modal .=  "</caption>";
											$modal .=  "<tr>";
											$modal .=  "<td>".nl2br($discofb['description'])."</td>";
											$modal .=  "</tr>";
											$modal .=  "</table>";
										$modal .= '
										</div>
									</div>
								';
								
							}
						}
					}
					/* pour la présentation des events*/
					if($cpt != 0 && $cpt % 4 == 0){
						echo "</tr><tr>";
					}
					
					$timestamp = strtotime($discodate);
					echo '<td id="'.$disco->iddiscosoupe.'" class="event_space" valign="top">';
					if($disco->valide == 2){
						echo '<a href="#event'.$discofb['eid'].'" role="button" data-toggle="modal">';
					}
						echo "<div class='carteevent'><div class='titreevent'><b>".$evenement."</b></div>";
					if($disco->valide == 1){
						echo "<br />".img("temp/vide.png", $alt = "lieu", $classe = "pic_big")."<br />";
					}
					if($disco->valide == 2){
						echo "<br /><img src='".$discofb['pic_big']."' class='pic_big' /></a><br />";
					}
					echo "<br /><table class='well'><tr><td>".img("floriane/picto-home-date.jpg", $alt = "lieu")."</td><td class='coordonnee'>".$convertjour[date('w', $timestamp)]." ".date('d', $timestamp)." ".$convertmois[date('n', $timestamp)]."</td></tr></table>"."
					<a style='cursor:pointer' onclick=\"document.getElementById('address').value='".$disco->ville."'; codeVoyager(); document.location='#critere';\"><table class='well'><tr><td>".img("floriane/picto-home-lieu.jpg", $alt = "lieu")."</td><td class='coordonnee'>".$discoville."</td>
					</tr></table></a>";
					if($this->session->userdata('is_logged_in') == 'ok'){
						echo "<form method='post' action='".site_url('supprimerevenement')."'>
							<button class='btn' value='".$disco->iddiscosoupe."' name='tosuppr'>Supprimer</button>
						</form>";
					}
					echo "
					</div>";
					echo "</td>";
					$cpt++;
				}
			?>
		</tr>
	</table>
	<?php
		echo $modal;
	?>
</div>
<br />