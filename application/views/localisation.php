<h1>Localisation</h1>

<?php
	echo "pays : ".$record->country_name . "<br />";
	//echo $GEOIP_REGION_NAME[$record->country_code][$record->region] . "\n";
	echo "ville : ".$record->city . "<br />";
	echo "code postal : ".$record->postal_code . "<br />";
	echo "latitude : ".$record->latitude . "<br />";
	echo "longtitude : ".$record->longitude . "<br />";
?>

<br />
Le google map :<br />

<?php $map->printHeaderJS(); ?>
<?php $map->printMapJS(); ?>

<div onload="onLoad();">
   <?php $map->printMap(); ?>
</div>