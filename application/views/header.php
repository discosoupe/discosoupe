<header class="carte">
	<br />
	<div class="row-fluid">
		<div class="offset8 span4" align="right">
			<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
			<form action="" method="post" class="form-inline" style="margin-top: 20px; margin-bottom: 8px">
				<button name="deconnexion" class="btn" type="submit" value="deconnexion">deconnexion</button>
			</form>
			<?php }else{ ?>
				
				
			<!-- Button to trigger modal -->
			<a href="#myModal" role="button" class="btn" data-toggle="modal"><?php echo img("u78_normal.png", $alt = "co");?></a>
				 
				<!-- Modal -->
				<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
				  <form action="" method="post" class="form-inline" style="margin-top: 20px; margin-bottom: 8px;">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h3 id="myModalLabel">Connexion</h3>
					  </div>
					  <div class="modal-body">
							<input name="login" type="text" class="input-small" placeholder="log in" />
							<input name="password" type="password" class="input-small" placeholder="password" />
					  </div>
					  <div class="modal-footer">
					    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
					    <button class="btn btn-primary" type="submit"><i class="icon-user icon-white"></i> Connexion</button>
					  </div>
				  </form>
				</div>
				
			<?php } ?>
		</div>
	</div>
	<br />
</header>