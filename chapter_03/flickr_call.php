<?php
$url = 'http://api.flickr.com/services/xmlrpc/';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
$responsexml = new SimpleXMLElement($response);

$photosxml = new SimpleXMLElement(
  (string)$responsexml->params->param->value->string);
print_r($photosxml);
?>