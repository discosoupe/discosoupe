<?php
include("geoipcity.inc");
include("geoipregionvars.php");
 
$gi = geoip_open(realpath("GeoLiteCity.dat"),GEOIP_STANDARD);
 
$record = geoip_record_by_addr($gi,"78.236.201.31");
 
$la = $record->latitude;
$lo = $record->longitude;
 
$url = "http://maps.google.com/maps/geo?output=csv&q=".$la.",".$lo;
 
if($csv = file_get_contents($url))
{
   if(substr($csv,0,3)!=200)
   {
      die("Erreur");
   }
   else
   {
      $adresse = substr($csv, 7, -1);
      echo $adresse;
   }
}
else
{
   echo "Erreur";
}
 
 
geoip_close($gi);
 
?>