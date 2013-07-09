<div class="container-fluid">
	<h1>Actualité</h1>
	<div class="row-fluid">
        <div class="span8">
        	<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
        	<form method="post" enctype="multipart/form-data">
				<table>
	        		<tr>
	        			<td class="span9">
							Titre : <input name="titre" type="text" /><br />
	        				<script>
							  $(function() {
							    $( "#date" ).datetimepicker();
							  });
							</script>
	        				Date : <input id="date" name="date" type="text" />
	        				<br />
							Description : <br /><textarea name="description" class="input-xxlarge" rows="8"></textarea><br />
							<button class="btn" name="creerarticle" value="ajouter">Ajouter</button>
	        			</td>
	        			<td width="30"></td>
	        			<td class="span3" valign="top">

							<div class="fileupload fileupload-new" data-provides="fileupload">
							  <div class="fileupload-new thumbnail" style="width: 320; height: 220px;"><br /><br /><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
							  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
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
    			foreach ($article as $art) {
			?>
				<h4><?php echo $art->titre; ?></h4>
	        	<table>
	        		<tr>
	        			<td class="span9">
	        				<?php echo $art->date; ?>
	        				<br /><br />	
							<?php echo $art->description; ?>
	        			</td>
	        			<td width="30"></td>
	        			<td class="span3" valign="top"><img alt="" src="<?php echo img_url('discosoupeevent.jpg') ?>" width="320"/></td>
	        		</tr>
	        	</table>
	        	<br />
	        	<a href="">savoir plus :</a>
	        	<br /><br />
	        	<a href="">lien externe 1</a>
	        	<br />
	        	<a href="">lien externe 2</a>
	        	<br />
	        	<a href="">lien externe 3</a>
	        	<br />        	
	        	<?php echo img("u178_normal.png", $alt = "co");?><a href="">doc.pdf</a>
	        	<br /><br />
		        <table class="well" width="100%">
		        	<tr>
		        		<td>
		        			<?php echo '<a href="https://www.facebook.com/DiscoSoupe">'.img("u70_normal.png", $alt = "co").'</a>';?>
							<?php echo img("u72_normal.png", $alt = "co");?>
							<?php echo '<a href="http://vimeo.com/39596405">'.img("u74_normal.png", $alt = "co").'</a>';?>
							<?php echo img("u76_normal.png", $alt = "co");?>
							<?php echo img("u78_normal.png", $alt = "co");?>
		        		</td>
		        		<td align="right">Thèmes : <a href="">bio</a>, <a href="">organique</a>, <a href="">gaspillage</a></td>
		        	</tr>
				</table>
			<?php
				}
			?>
		</div>
        <div class="span4" style="margin-top: -60">
        	<h3>Rechercher dans les actualités</h3>
        	<div class="bordure">
        		<form class="form-search">
        			<input type="text" placeholder="Saisir une ou plusieurs clefs"  class="input-large search-query"/> <button class="btn">Recherche</button>
        		</form>
        		<h4>Archives</h4>
        		
        		<div class="accordion" id="accordion2">
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				        2013
				      </a>
				    </div>
				    <div id="collapseOne" class="accordion-body collapse in">
				      <div class="accordion-inner">
				        > Janvier
				      </div>
				      <div class="accordion-inner">
				        > Février
				      </div>
				    </div>
				  </div>
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
				        2012
				      </a>
				    </div>
				    <div id="collapseTwo" class="accordion-body collapse">
				      <div class="accordion-inner">
				        > Juin
				      </div>
				      <div class="accordion-inner">
				        > Juillet
				      </div>
				      <div class="accordion-inner">
				        > Octobre
				      </div>
				    </div>
				  </div>
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
				        2011
				      </a>
				    </div>
				    <div id="collapseThree" class="accordion-body collapse">
				      <div class="accordion-inner">
				        > Juin
				      </div>
				      <div class="accordion-inner">
				        > Juillet
				      </div>
				      <div class="accordion-inner">
				        > Octobre
				      </div>
				    </div>
				  </div>
				</div>
				<h4>Thèmes des actualités</h4>
				Gaspillage(35) Organique(10) Discosoupe(30) économe(15) recette(4) écologie(8)
        	</div>
        	<br /><br />
        	<h3>Liens utiles</h3>
        	<div class="bordure">
        		
				<b>Titre lorem ipsum</b>
				<br />
				Description brève de l'actualité / news sur deux lignes lorem ipsum
				<br /><br />
				<b>Titre lorem ipsum</b>
				<br />
				Description brève de l'actualité / news sur deux lignes lorem ipsum
				<br /><br />
				<b>Titre lorem ipsum</b>
				<br />
				Description brève de l'actualité / news sur deux lignes lorem ipsum

        	</div>
        	
        </div>
     </div>
</div>