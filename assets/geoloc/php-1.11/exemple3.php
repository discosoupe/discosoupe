<?php
	include("geoipcity.inc");
	include("geoipregionvars.php");
	 
	$gi = geoip_open(realpath("GeoLiteCity.dat"),GEOIP_STANDARD);
	 
	$record = geoip_record_by_addr($gi, "78.236.201.31");
	 
	$la = $record->latitude;
	$lo = $record->longitude;
	 
	$url = "http://maps.google.com/maps/geo?output=json&q=".$la.",".$lo;
	if($json = file_get_contents($url))
	{
	$informations = json_decode($json, true);
	   if($informations['Status']['code']!=200)
	   {
	      die("Erreur");
	   }
	   else
	   {
	      echo $informations["Placemark"][0]["AddressDetails"]["Country"]["AdministrativeArea"]["SubAdministrativeArea"]["Locality"]["DependentLocality"]["PostalCode"]["PostalCodeNumber"];
	   }
	}
	else
	{
	   echo "Erreur";
	}
	 
	 
	geoip_close($gi);
	 
?>