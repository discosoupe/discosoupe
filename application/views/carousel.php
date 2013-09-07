<div class="row-fluid">
	<div class="span12">
		<?php 
			if($this->session->userdata('is_logged_in') == 'ok'){
		?>
				<table class="table table-bordered">
					<tr>
						<td>
							<form method="post" enctype="multipart/form-data">
								<h3>Ajout de Photo</h3>
								<input id="filecarousel" name="filecarousel" type="file" />
								<button name="ajouterphoto" type="submit" class="btn btn-primary" value="ajouterphoto">Ajouter</button>
							</form>
						</td>
						<td>
							<h3>Suppression de Photo</h3>
							<table class="table table-bordered">
							<?php
								for($i=0; $i<count($allcarousel); $i++){
									echo '
										<tr>
											<td>'.$allcarousel[$i]->liencarousel.'</td>
											<td>
												<form method="post" enctype="multipart/form-data"> 
													<button name="supprimerphoto" type="submit" class="btn btn-danger" value="'.$allcarousel[$i]->idcarousel.'">Supprimer</button>
												</form>
											</td>
										</tr>
									';
								}
							?>
							</table>
						</td>
					</tr>
				</table>
				</form>
		<?php
			}	
		?>
  		<div id="myCarousel" class="carousel slide">
    		<div class="carousel-inner thumbnail">
      			<?php
      				for($i=0; $i<count($allcarousel); $i++){
      					if($i == 0){
      						echo '
      							<div class="item active"> <img alt="" src="'.img_url('carousel/'.$allcarousel[$i]->liencarousel).'"/>
      							</div>
      						';
      					}else{
	      					echo '
	      						<div class="item"><img alt="" src="'.('carousel/'.$allcarousel[$i]->liencarousel).'"/>
				      			</div>
	      					';
      					}
      				}
      			?>
    	</div>
    	<a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a> <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a> </div>
	</div>
</div>