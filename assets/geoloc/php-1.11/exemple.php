<?php
	include("geoipcity.inc");
	include("geoipregionvars.php");
	 
	$gi = geoip_open(realpath("GeoLiteCity.dat"),GEOIP_STANDARD);
	 
	//$record = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);
	$record = geoip_record_by_addr($gi, "78.236.201.31");
	
	 
	echo "pays : ".$record->country_name . "<br />";
	//echo $GEOIP_REGION_NAME[$record->country_code][$record->region] . "\n";
	echo "ville : ".$record->city . "<br />";
	echo "code postal : ".$record->postal_code . "<br />";
	echo "latitude : ".$record->latitude . "<br />";
	echo "longtitude : ".$record->longitude . "<br />";
	 
	geoip_close($gi);
	 
?>