<?php
include 'apiGeoLocation.php';
include 'xmlMeteo.php';

//Chargement du source XML
$xml = new DOMDocument();
$xml->load("meteo.xml");

$xslt = new XSLTProcessor();

$xsl = new DOMDocument();
$xsl->load( 'meteo.xsl' );
$xslt->importStylesheet( $xsl );

print $xslt->transformToXML( $xml );
