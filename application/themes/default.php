<!DOCTYPE html"> 
<html lang="fr" > 
    <head>
        <title><?php echo $titre; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php foreach($css as $url): ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
<?php endforeach; ?>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>
 
    <body>
        <div id="contenu">
            <?php echo $output; ?>
        </div>
         
<?php foreach($js as $url): ?>
        <script type="text/javascript" src="<?php echo $url; ?>"></script> 
<?php endforeach; ?>
 
    </body>
 	
</html>