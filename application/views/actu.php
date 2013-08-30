<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=150299105165119";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
	<div class="row-fluid">
		<div class="fondjaune span12">
			<center><h1>Actualités</h1></center>
		</div>
	</div>
	<div class="row-fluid">
        <div class="carte span8">
        	<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
        	<form method="post" enctype="multipart/form-data">
				<table>
	        		<tr>
	        			<td class="span8">
							Titre : <input name="titre" type="text" /><br />
	        				<script>
							  $(function() {
							    $( "#date" ).datetimepicker();
							  });
							</script>
	        				Date : <input id="date" name="date" type="text" />
	        				<br />
							Description : <br /><textarea name="description" class="input-xlarge" rows="8"></textarea><br />
							
							Lien externe : <input id="externe" style="margin-top: 10px" class="input-medium" name="externe" placeholder="http://www.google.fr" type="text"/><button id="addexterne" class="btn"><i class="icon-plus"></i></button>
							<button id="removeexterne" class="btn">Réinitialiser</button>
							<input id="dataexterne" name="dataexterne" type="hidden"/>
							<span id="allexterne">
								
							</span>
							<br />
							pièce jointe : <input id="pj" name="pj" type="file" />
							<br />
							Thèmes : <input id="theme" style="margin-top: 10px" class="input-medium" name="theme" type="text" data-provide="typeahead"><button id="addtheme" class="btn" onclick="return false;"><i class="icon-plus"></i></button>
							
							<?php
								$rechercheahead = '';
								for($i=0;$i<count($allthemes);$i++){
									if($i == count($allthemes) - 1)
									{
										$rechercheahead.= "'".$allthemes[$i]->nom."'";
									}
									else
									{
										$rechercheahead.= "'".$allthemes[$i]->nom."', ";
									}
								}
							?>
							<script>
							var suggestiontheme = [<?php echo $rechercheahead; ?>];
							$(function (){
							   $('#theme').typeahead({source: suggestiontheme});
							});  
							</script>
							
							<input id="datatheme" name="datatheme" type="hidden"/>
							<span id="alltheme">
								
							</span>
							<br />
							<button type="submit" class="btn" name="creerarticle" value="ajouter">Ajouter</button>
	        				<script>
								var changedValues = [];
								var changedThemeValues = [];
								$("#addexterne").click(
									function(){
										var element = $('#externe').val().replace(/ /g,"");
										//vérifie si l'élément est déjà dans la liste
										if (element!="" && $.inArray(element, changedValues) == -1) {
											changedValues.push(element);
											$('#allexterne').append('<div id="'+element+'"><a href="'+element+'">'+element+'</a></div> ');
											$('#dataexterne').val(changedValues.toString());
										}
										else{
											alert('veuillez saisir une information');
										}
										return false;
									}
								);
								
								$("#removeexterne").click(
									function(){
										$('#dataexterne').empty();
										changedValues = [];
										$('#allexterne').empty();
										return false;
									}
								);
								
								$("#addpj").click(
									function(){
										return false;
									}
								);
								
								$("#addtheme").click(
									function(){
										var element = $('#theme').val().replace(/ /g,"");
										if (element.indexOf("/") == -1){
											//vérifie si l'élément est déjà dans la liste
											if (element!="" && $.inArray(element, changedThemeValues) == -1) {
												changedThemeValues.push(element);
												$('#alltheme').append('<span id="'+element+'" class="label label-warning">'+element+'<i id="button'+element+'" name="'+element+'" class="icon-remove icon-white"></i></span> ');
												$('#datatheme').val(changedThemeValues.toString());
												$('#button'+element).click(
													function(){
														changedThemeValues.splice($.inArray($(this).attr('name'), changedThemeValues),1);
														$('#'+$(this).attr('name')).remove();
														$('#datatheme').val(changedThemeValues.toString());
													}
												)
											}
											else{
												alert('veuillez saisir une information');
											}
										}
										else{
											alert('les slashs / sont interdits');
										}
										return false;
									}
								);
							</script>
	        			</td>
	        			<td width="30"></td>
	        			<td valign="top">

							<div class="fileupload fileupload-new" data-provides="fileupload">
							  <div class="fileupload-new thumbnail" style="width: 230px; height: 220px;"><br /><br /><?php echo img("noimage.gif", $alt = "no image");?></div>
							  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 230px; height: 220px;"></div>
							  <div>
							    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="userfile" type="file" /></span>
							    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
							  </div>
							</div>
						
						</td>
	        		</tr>
	        	</table>
			</form>	
			<?php } ?>
		
			<?php 
				$alltitrearticle = array();
				if($article){
					$aremplacer = array(",",".",";",":","!","?","(",")","[","]","{","}","\"","'"," ", "\n", "\t", "\r", "\0", "\x0B");
					$enremplacement = " "; 
    				foreach ($article as $art) {
    					$titresansponctuation = trim(str_replace($aremplacer, $enremplacement, $art->titre));
						$descriptionsansponctuation = trim(str_replace($aremplacer, $enremplacement, $art->description));
    					$alltitrearticle = array_unique(array_merge($alltitrearticle, array_unique(explode(" ", $titresansponctuation))));
    					$alltitrearticle = array_unique(array_merge($alltitrearticle, array_unique(explode(" ", $descriptionsansponctuation))));
    					?>
						<div id="div<?php echo $art->idarticle; ?>">
							<center>
							<h2><a href="<?php echo site_url('actu?id='.$art->idarticle) ?>"><?php echo $art->titre; ?></a>
							<?php if ($this->session->userdata('is_logged_in') == 'ok'){
								echo '<i id="button'.$art->idarticle.'" class="icon-edit"></i>';
							}?>
							</h2>
							</center>
							<hr />
							<center><img alt="" src="<?php echo img_url('uploads/'.$art->image) ?>" width="580"/></center>
				        	<br />
				        	<?php echo $art->description; ?>
				        	<br /><br />
				        	<div class="row-fluid">
				        		<div class="span4 basarticle">
				        			<table>
				        				<tr>
				        					<td>
				        						<h4>
								        			<?php 
								        				$timestamp = strtotime($art->date);
														//$convertjour[date('w', $timestamp)].
														echo "<div class='numero'><br />".date('d', $timestamp)."</div></td><td><h4> ".$convertmois[date('n', $timestamp)]." ".date('Y', $timestamp)."</h4>";
													?>
												</h4>
											</td>
										</tr>
									</table>
				        		</div>
				        		<div class="span4 basarticle">
				        			<h4>Publié dans :</h4>
					        		<p class="newlabel">
					        			<?php
					        				$nbtheme = count($art->theme);
											$cpttheme = 0;
						        			if($art->theme){
							        			foreach ($art->theme as $theme) {
							        				$cpttheme = $cpttheme + 1;
													if($cpttheme == $nbtheme)
														echo $theme;
													else
														echo $theme.', ';
												}
											}
						        		?>
						        	</p>
				        		</div>
				        		<div class="span4 basarticle fondjaune">
				        			<h4 style="color: #FFFFFF">Partager en ligne</h4>
				        			<div class="fb-like" data-href="http://discosoupe.org" data-width="350" data-show-faces="false" data-send="false"></div>
				        		</div>
				        	</div>
				        	
		        			<?php 
		        				if($art->piecejointe){
		        			?>
		        				<a href="<?php echo base_url()."assets/pj/".$art->piecejointe ?>"><?php echo img("u178_normal.png", $alt = "co");?>pièce jointe</a>
		        			
		        			<?php
								}
					        	if ($this->session->userdata('is_logged_in') == 'ok'){
					        		echo '
					        			<script>
										$("#button'.$art->idarticle.'").click(
											function(){
												$("#div'.$art->idarticle.'").hide();
												$("#form'.$art->idarticle.'").fadeIn();
											}
										);
										</script>
					        			';
								}
							?>
				        	<br />
					        <table class="well" width="100%">
					        	<tr>
					        		<td>
					        			<?php echo '<a href="https://www.facebook.com/DiscoSoupe">'.img("u70_normal.png", $alt = "co").'</a>';?>
										<?php echo img("u72_normal.png", $alt = "co");?>
										<?php echo '<a href="http://vimeo.com/39596405">'.img("u74_normal.png", $alt = "co").'</a>';?>
										<?php echo img("u76_normal.png", $alt = "co");?>
										<?php echo img("u78_normal.png", $alt = "co");?>
					        		</td>
					        		<td align="right">
					        			Liens : 
					        			<?php
							        		if($art->url){
							        			foreach ($art->url as $url) {
													echo '<a href="http://'.$url.'">'.$url.'</a> ';
												}
											}
							        	?>
					        		</td>
					        	</tr>
							</table>
						</div>
						<?php
							if ($this->session->userdata('is_logged_in') == 'ok'){
						?>
							<form id="form<?php echo $art->idarticle; ?>" action="<?php echo site_url('majarticle?id='.$art->idarticle);?>" method="post" class="well" style="display:none" enctype="multipart/form-data">
								<table>
					        		<tr>
					        			<td class="span8">
											Titre : <input name="titre<?php echo $art->idarticle; ?>" type="text" value="<?php echo $art->titre; ?>" /><br />
					        				<script>
											  $(function() {
											    $( "#date<?php echo $art->idarticle; ?>").datetimepicker();
											  });
											</script>
					        				Date : <input id="date<?php echo $art->idarticle; ?>" name="date<?php echo $art->idarticle; ?>" type="text" value="<?php echo $art->date; ?>" />
					        				<br />
											Description : <br /><textarea name="description<?php echo $art->idarticle; ?>" class="input-xlarge" rows="8"><?php echo $art->description; ?></textarea><br />
											
											Lien externe : <input id="externe<?php echo $art->idarticle; ?>" style="margin-top: 10px" class="input-medium" name="externe<?php echo $art->idarticle; ?>" placeholder="http://www.google.fr" type="text"/><button id="addexterne<?php echo $art->idarticle; ?>" class="btn"><i class="icon-plus"></i></button>
											<button id="removeexterne<?php echo $art->idarticle; ?>" class="btn">Réinitialiser</button>
											<input id="dataexterne<?php echo $art->idarticle; ?>" name="dataexterne<?php echo $art->idarticle; ?>" type="hidden"/>
											<span id="allexterne<?php echo $art->idarticle; ?>">
												<?php 
													if($art->url){
														foreach ($art->url as $url) {
															echo '<div id="'.$url.'"><a href="'.$url.'">'.$url.'</a></div>';
														}
													}
												?>
											</span>
											<br />
											pièce jointe : <input id="pj<?php echo $art->idarticle; ?>" name="pj<?php echo $art->idarticle; ?>" type="file" /> 
											<?php  if($art->piecejointe){?>
												(<a href="<?php echo base_url()."assets/pj/".$art->piecejointe ?>">ancienne pj</a>)
											<?php } ?>
											<br />
											Thèmes : <input id="theme<?php echo $art->idarticle; ?>" style="margin-top: 10px" class="input-medium" name="theme<?php echo $art->idarticle; ?>" type="text" data-provide="typeahead"><button id="addtheme<?php echo $art->idarticle; ?>" class="btn" onclick="return false;"><i class="icon-plus"></i></button>
											
											<script>
											$(function (){
											   $('#theme<?php echo $art->idarticle; ?>').typeahead({source: suggestiontheme});
											});  
											</script>
											
											<input id="datatheme<?php echo $art->idarticle; ?>" name="datatheme<?php echo $art->idarticle; ?>" type="hidden"/>
											<span id="alltheme<?php echo $art->idarticle; ?>">
											<?php
												if($art->theme){
								        			foreach ($art->theme as $theme) {
														echo '<span id="'.$theme.$art->idarticle.'" class="label label-warning">'.$theme.'<i id="button'.$theme.$art->idarticle.'" name="'.$theme.$art->idarticle.'" class="icon-remove icon-white"></i></span> ';
													}
												}
											?>
											</span>
											<br />
					        				<script>
												var changedValues<?php echo $art->idarticle; ?> = [];
												var changedThemeValues<?php echo $art->idarticle; ?> = [];
												<?php	
													if($art->url){
														foreach ($art->url as $url) {
															echo '
																changedValues'.$art->idarticle.'.push("'.$url.'");
															';
														}
														echo "$('#dataexterne".$art->idarticle."').val(changedValues".$art->idarticle.".toString());";
													}
													if($art->theme){
								        				foreach ($art->theme as $theme) {
								        					echo '
																changedThemeValues'.$art->idarticle.'.push("'.$theme.'");
																$("#button'.$theme.$art->idarticle.'").click(
																	function(){
																		changedThemeValues'.$art->idarticle.'.splice($.inArray($(this).attr("name"), changedThemeValues'.$art->idarticle.'),1);
																		$("#"+$(this).attr("name")).remove();
																		$("#datatheme'.$art->idarticle.'").val(changedThemeValues'.$art->idarticle.'.toString());
																	}
																)
															';
														}
														echo "$('#datatheme".$art->idarticle."').val(changedThemeValues".$art->idarticle.".toString());";
													}
												?>			
												$("#addexterne<?php echo $art->idarticle; ?>").click(
													function(){
														var element = $('#externe<?php echo $art->idarticle; ?>').val().replace(/ /g,"");
														//vérifie si l'élément est déjà dans la liste
														if (element!="" && $.inArray(element, changedValues<?php echo $art->idarticle; ?>) == -1) {
															changedValues<?php echo $art->idarticle; ?>.push(element);
															$('#allexterne<?php echo $art->idarticle; ?>').append('<div id="'+element+'<?php echo $art->idarticle; ?>"><a href="'+element+'">'+element+'</a></div> ');
															$('#dataexterne<?php echo $art->idarticle; ?>').val(changedValues<?php echo $art->idarticle; ?>.toString());
														}
														else{
															alert('veuillez saisir une information');
														}
														return false;
													}
												);
												
												$("#removeexterne<?php echo $art->idarticle; ?>").click(
													function(){
														$('#dataexterne<?php echo $art->idarticle; ?>').empty();
														changedValues<?php echo $art->idarticle; ?> = [];
														$('#allexterne<?php echo $art->idarticle; ?>').empty();
														return false;
													}
												);
												
												$("#addpj<?php echo $art->idarticle; ?>").click(
													function(){
														return false;
													}
												);
												
												$("#addtheme<?php echo $art->idarticle; ?>").click(
													function(){
														var element = $('#theme<?php echo $art->idarticle; ?>').val().replace(/ /g,"");;
														if (element.indexOf("/") == -1){
															//vérifie si l'élément est déjà dans la liste
															if (element!="" && $.inArray(element, changedThemeValues<?php echo $art->idarticle; ?>) == -1) {
																changedThemeValues<?php echo $art->idarticle; ?>.push(element);
																$('#alltheme<?php echo $art->idarticle; ?>').append('<span id="'+element+'<?php echo $art->idarticle; ?>" class="label label-warning">'+element+'<i id="button'+element+'<?php echo $art->idarticle; ?>" name="'+element+'<?php echo $art->idarticle; ?>" class="icon-remove icon-white"></i></span> ');
																$('#datatheme<?php echo $art->idarticle; ?>').val(changedThemeValues<?php echo $art->idarticle; ?>.toString());
																$('#button'+element+'<?php echo $art->idarticle; ?>').click(
																	function(){
																		changedThemeValues<?php echo $art->idarticle; ?>.splice($.inArray($(this).attr('name'), changedThemeValues<?php echo $art->idarticle; ?>),1);
																		$('#'+$(this).attr('name')).remove();
																		$('#datatheme<?php echo $art->idarticle; ?>').val(changedThemeValues<?php echo $art->idarticle; ?>.toString());
																	}
																)
															}
															else{
																alert('veuillez saisir une information');
															}
														}
														else{
															alert('les slashs / sont interdits');
														}
														return false;
													}
												);
											</script>
										</td>
					        			<td width="30"></td>
					        			<td valign="top">
				
											<div class="fileupload fileupload-new" data-provides="fileupload">
											  <div class="fileupload-new thumbnail" style="width: 230px; height: 220px;"><br /><br /><img src="<?php echo img_url('uploads/'.$art->image) ?>" /></div>
											  <div class="fileupload-preview fileupload-exists thumbnail" style="width: 230px; height: 220px;"></div>
											  <div>
											    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="userfile" type="file" /></span>
											    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
											  </div>
											</div>
										
										</td>
				        			</tr>
				        		</table>
									
								<button type="submit" name="modifier<?php echo $art->idarticle; ?>" value="modifier" class="btn btn-info">modifier</button>
								<button type="submit" name="supprimer<?php echo $art->idarticle; ?>" value="supprimer" class="btn btn-danger">supprimer</button>
							</form>
						<?php
						}
					}
				}
		    	if($page){
		    		echo '
		    			<div class="pagination pagination-right">
		  					<ul>';
							if(!$this->input->get('page') || ($this->input->get('page') && $this->input->get('page') == 1)){
								echo '<li class="disabled"><a><<</a></li>';
							}
							else{
								echo '<li><a href="'.site_url('actu?page='.($this->input->get('page')-1)).'"><<</a></li>';
							}
		        			for ($i = 1; $i <= $page; $i++) {
		        				echo '<li><a href="'.site_url('actu?page='.$i).'">'.$i.'</a></li>';
							}
							if(($this->input->get('page') && $this->input->get('page') == $page) || $page == 1){
								echo '<li class="disabled"><a>>></a></li>';
							}
							else{
								echo '<li><a href="'.site_url('actu?page='.($this->input->get('page')+1)).'">>></a></li>';
							}
							echo '
						  	</ul>
						</div>
					';
				}
		   	?>
		</div>
        <div class="carte span4" style="margin-top: -60">
        	<h3>Rechercher des articles</h3>
        	<hr />
        	<div>
        		<form class="form-search" method="get">
        			<input id="recherchetout" name="search" type="text" placeholder="Saisir une ou plusieurs clefs"  class="input-medium search-query" data-provide="typeahead"/> <button class="btn"><i class="icon-search"></i></button>
        		</form>
        		<?php
					$recherchedata = '';
					for($i=0;$i<count($alltitrearticle);$i++){
						if(strlen($alltitrearticle[$i]) > 6){
							if($i == count($alltitrearticle) - 1)
							{
								$recherchedata.= "'".$alltitrearticle[$i]."'";
							}
							else
							{
								$recherchedata.= "'".$alltitrearticle[$i]."', ";
							}
						}
					}
        		?>
        		<script>
					var recherchedata = [<?php echo $recherchedata; ?>];
					$(function (){
					   $('#recherchetout').typeahead({source: recherchedata});
					});  
				</script>
	
        		<h4>Archives</h4>
				
        		<?php
        			$tabannee = array();
					$tabmois = array();
					
					// le calcul du nombre d'élément dans les archives par année et par mois
					$cpt = 0;
        			$annee = NULL;
        			foreach ($archive as $elementarchive) {
						$datearchive = explode("-", $elementarchive->date, -1);	
						if($datearchive[0] != $annee){
							$annee = $datearchive[0];
							$mois = NULL;
							array_push($tabannee, $cpt);
						}
						if($datearchive[1] != $mois){
							$mois = $datearchive[1];
							array_push($tabmois, $cpt);
						}
						$cpt = $cpt + 1;
					}
					array_push($tabannee, $cpt);
					array_push($tabmois, $cpt);
					$indiceannee = 1;
					$indicemois = 1;
					$annee = NULL;
					
					// L'affichage
        			foreach ($archive as $elementarchive) {
						$datearchive = explode("-", $elementarchive->date, -1);	
						if($datearchive[0] != $annee){
							if($annee != NULL){
								echo "</div>\n</div>\n";
							}
							echo "<a id='annee".$elementarchive->idarticle."' style='cursor: pointer'>".$datearchive[0]." (".(($tabannee[$indiceannee]) - ($tabannee[$indiceannee - 1])).")</a><br />";
							echo "
							<script>
							$('#annee".$elementarchive->idarticle."').click(
									function(){
										$('#a".$elementarchive->idarticle."').slideToggle();
									}
								);
							</script>
							";
							echo "<div id='a".$elementarchive->idarticle."' style='display: none'>\n";
							$annee = $datearchive[0];
							$mois = NULL;
							$indiceannee = $indiceannee + 1;
						}
						if($datearchive[1] != $mois){
							if($mois != NULL){
								echo "</div>";
							}
							echo "\t <div class='archivemois'><a id='mois".$elementarchive->idarticle."' style='cursor: pointer'> > ".$convertmois[date('n', strtotime($elementarchive->date))]." (".(($tabmois[$indicemois]) - ($tabmois[$indicemois - 1])).")</a></div>";
							echo "
							<script>
							$('#mois".$elementarchive->idarticle."').click(
									function(){
										$('#m".$elementarchive->idarticle."').slideToggle();
									}
								);
							</script>
							";
							echo "<div id='m".$elementarchive->idarticle."' style='display: none'>\n";
							$mois = $datearchive[1];
							$indicemois = $indicemois + 1;
						}
						echo "\t\t<div id='".$elementarchive->idarticle."' class='archiveelement'><a href='".site_url('actu?id='.$elementarchive->idarticle)."'>".$elementarchive->titre."</a></div>\n";
					}
        		?>
        			</div>
				</div>
				<h4>Thèmes des actualités</h4>
				<?php
					foreach ($allthemes as $tag) {
						echo "<a href='".site_url('actu?theme='.$tag->nom)."'>".$tag->nom."(".$tag->count.")</a> ";
					}
				?>
        	</div>
        	<br /><br />
        	<h3>Liens utiles</h3>
        	<hr />
        	<div>
        		<?php
        			if($lienutile)
						foreach ($lienutile as $lienutile) {
							echo "<a href='".$lienutile->url."'>".$lienutile->titre."</a>";
							if ($this->session->userdata('is_logged_in') == 'ok'){
								echo ' <a href="'.site_url('ajoutlienutile?id='.$lienutile->idlienutile).'"><i class="icon-trash"></i></a>';
							}
							echo "
							<br />
							".$lienutile->descriptionlienutile."
							<br /><br />";
					}
					if ($this->session->userdata('is_logged_in') == 'ok'){
					?>
					<form class="well" action="<?php echo site_url('ajoutlienutile');?>" method="post">
						<h4>Ajouter lien utile</h4>
						<input name="urllienutile" type="text" placeholder="Url" />
						<input name="titrelienutile" type="text" placeholder="Titre du lien" />
						<textarea name="descriptionlienutile">description du lien</textarea>
						<br />
						<button name="ajoutlienutile" type="submit" class="btn" value="ajoutlienutile">Ajouter</button>
					</form>
					<?php
					}
				?>
        	</div>
        	
   	 </div>
</div>