<?php

$kml = file_get_contents('data.kml');

$origins = new \SimpleXMLElement($kml); 
$origins = $origins->Document->Placemark;

$export = array();
foreach($origins as $theodoer) {
  $coords = $theodoer->Point->coordinates;
  $coords = explode(",", $coords[0]);
  $coords = array($coords[1], $coords[0]);
  $user = $theodoer->name->__toString();
  $export[$user] = $coords;
}


echo json_encode($export);