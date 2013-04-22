
<div class="container">
	<div class="row">
		<div class="span12">
			Recueil d'infographie : Disco soupe sensibilise au gaspillage alimentaire au cours d'un évènement festif !
			<br />Rejoignez nous !!!
			<br /><br />
		</div>
	</div>
	<div class="row">
    	<div class="span12">
      		<div id="myCarousel" class="carousel slide">
        		<div class="carousel-inner thumbnail">
          			<div class="item active"> <img alt="" src="<?php echo img_url('discosoupe.jpg') ?>"/>
            			<div class="carousel-caption">
              				<p>Disco soupe !!!</p>
           		 		</div>
          			</div>
          			<div class="item"> <img alt="" src="<?php echo img_url('discosoupe2.jpg') ?>"/>
            			<div class="carousel-caption">
              				<p>Fête ouverte à tous</p>
            			</div>
          			</div>
          			<div class="item"> <img alt="" src="<?php echo img_url('discosoupe3.jpg') ?>"/>
            		<div class="carousel-caption">
              			<p>Venez comme vous êtes !</p>
            		</div>
          		</div>
        	</div>
        	<a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a> <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a> </div>
    	</div>
	</div>
</div>
  
<form class="form-horizontal" method="post" action="">
	<div class="input-append">
		<div class="control-group">
			<label class="control-label" for="Date">Date :</label>
		    <div class="controls">
		        <input type="date" name="date" value="<?php echo set_value('date'); ?>" />
	    		<?php echo form_error('date'); ?>
		    </div>
		</div>
	</div>
	<div class="input-prepend">
		<div class="control-group"> 
			<label class="control-label" for="lieu">Lieu :</label>
		    <div class="controls">
		      <input type="text" id="lieu"  name="lieu" value="<?php echo set_value('lieu'); ?>" >
		       <?php echo form_error('lieu'); ?>
		    </div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
	    <div class="controls">
	      <input type="text" id="inputEmail" placeholder="Email">
	    </div>
	</div>
 	 <div class="control-group">
	    <div class="controls">
	      <button class="btn" type="submit">Envoyer</button>
	    </div>
	 </div>
</form>