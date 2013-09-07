<header class="carte">
	<div class="row-fluid">
		<div class="span4">
			<?php echo img("floriane/logo-discosoupe.png", $alt = "logo", $classe = "logo");?>
		</div>
		<div class="offset5 span3">
			<p class="accroche">
				La Disco Soupe est un mouvement solidaire et festif qui s'approprie l'espace public et le rebus alimentaire pour sensibiliser au gaspillage alimentaire. 
			</p>
			<div class="accroche">
				<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
					<form action="" method="post">
				<?php } ?>
					<?php echo '<a href="https://www.facebook.com/DiscoSoupe">'.img("u70_normal.png", $alt = "co").'</a>';?>
					<?php echo img("u72_normal.png", $alt = "co");?>
					<?php echo '<a href="http://vimeo.com/39596405">'.img("u74_normal.png", $alt = "co").'</a>';?>
					<?php echo img("u76_normal.png", $alt = "co");?>
					<?php echo img("u78_normal.png", $alt = "co");?>
					<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
						<button name="deconnexion" type="submit" value="deconnexion"><i class="icon-off"></i></button>
					</form>	
				<?php }
				else{ ?>
				<!-- Button to trigger modal -->
				<a href="#myModal" role="button" data-toggle="modal"><button><i class="icon-user"></i></button></a>
					 
					<!-- Modal -->
					<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
					  <form action="" method="post" class="form-inline" style="margin-top: 20px; margin-bottom: 8px;" onsubmit="return verif_connexion();">
						  <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    <h3 id="myModalLabel">Connexion</h3>
						  </div>
						  <div class="modal-body">
								<input id="mail" name="mail" type="text" placeholder="adresse@mail.com" />
								<input id="password" name="password" type="password" placeholder="password" />
						  </div>
						  <div class="modal-footer">
						    <button name="connexion" value="connexion" class="btn btn-primary" type="submit"><i class="icon-user icon-white"></i> Connexion</button>
						  	<button name="inscription" class="btn btn-success" type="submit" value="inscription"><i class="icon-globe icon-white"></i> Inscription</button>
						  </div>
						  <script>
							function verif_connexion(){
								if(document.getElementById('mail').value == "" || document.getElementById('password').value == ""){
									alert('l\'email et le mot de passe sont obligatoires !');
									return false;
								}
								else{
									return true;
								}
							}
						  </script>
					  </form>
					</div>
				
				<?php } ?>
			</div>
		</div>
	</div>
	<br />
</header>