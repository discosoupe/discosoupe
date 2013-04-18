<h1>Accueil</h1>

<?php echo 'ici : '.$user_info;?>

<br /><br />

<div class="container">
	<div class="row">
    	<div class="span9">
      		<div id="myCarousel" class="carousel slide">
        		<div class="carousel-inner thumbnail">
          			<div class="item active"> <img alt="" src="<?php echo img_url('discosoupe.jpg') ?>"/>
            			<div class="carousel-caption">
              				<p>Une présentation</p>
           		 		</div>
          			</div>
          			<div class="item"> <img alt="" src="<?php echo img_url('discosoupe2.jpg') ?>"/>
            			<div class="carousel-caption">
              				<p>Un autre présentation</p>
            			</div>
          			</div>
          			<div class="item"> <img alt="" src="<?php echo img_url('discosoupe3.jpg') ?>"/>
            		<div class="carousel-caption">
              			<p>Et encore une autre !</p>
            		</div>
          		</div>
        	</div>
        	<a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a> <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a> </div>
    	</div>
	</div>
</div>
  
<form method="post" action="">
    <label for="date">Date : </label>
    <input type="date" name="date" value="<?php echo set_value('date'); ?>" />
    <?php echo form_error('date'); ?>
 
    <label for="lieu">Lieu :</label>
    <input type="text" name="lieu" value="<?php echo set_value('lieu'); ?>" />
    <?php echo form_error('lieu'); ?>
 
    <input type="submit" value="Envoyer" />
</form>