<?php
include 'apiGeoLocation.php';
include 'xmlMeteo.php';
include 'apiBikes.php';
include 'apiAirQuality.php';

//Chargement du source XML
$xml = new DOMDocument();
$xml->load("./xml/meteo.xml");

$xslt = new XSLTProcessor();

$xsl = new DOMDocument();
$xsl->load('./xml/meteo.xsl');
$xslt->importStylesheet($xsl);

print $xslt->transformToXML( $xml );