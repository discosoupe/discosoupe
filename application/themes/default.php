<!DOCTYPE html> 
<html lang="fr" > 
    <head>
        <title><?php echo $titre; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
        <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-43853461-1', 'discosoupe.org');
		  ga('send', 'pageview');
		
		</script>
		<meta name="Keywords" content="Disco, Soupe, gaspillage, convivialité, fun, sensibilisation, partage, musique" />  
		<meta name="Description" content="Chaleureux moments avec des inconnus pour découper et cuir des légumes qui devraient être jetés, pour en faire un chouette repas !" /> 
		
		<?php 
			/*
				Disco, Soupe, légume, communauté, Paris, voiture, marché, gâchis, partage, couteau, économe, vêtements salis
			  	Chaleureux moments avec des inconnus pour découper et cuir des légumes qui devraient être jetés, pour en faire un chouette repas !
			*/
		?>
		
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="<?php echo img_url('favicon.png') ?>" />
        
<?php foreach($css as $url): ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
<?php endforeach; ?>
  	<?php foreach($ext as $url_ext): ?>
        <script src="<?php echo $url_ext; ?>"></script> 
	<?php endforeach; ?>
    </head>
 
    <body>
    	
		<div id="loading">
		</div>
        <div id="contenu" class="container-fluid">
            <?php echo $output; ?>
        </div>
         
<?php foreach($js as $url): ?>
        <script type="text/javascript" src="<?php echo $url; ?>"></script> 
<?php endforeach; ?>

    </body>
 	
</html>