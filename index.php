<?php
// include 'apiGeoLocation.php';
// include 'xmlMeteo.php';

// CHargement du source XML
$xml = new DOMDocument();
$xml->load("meteo.xml");

$xslt = new XSLTProcessor();

$XSL = new DOMDocument();
$XSL->load( 'meteo.xsl' );
$xslt->importStylesheet( $XSL );

// print $xslt->transformToXML( $XML );
