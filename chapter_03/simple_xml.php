<?php
$simplexml = new SimpleXMLElement(
  '<?xml version="1.0"?><concerts />');

$concert1 = $simplexml->addChild('concert');
$concert1->addChild("title", "The Magic Flute");
$concert1->addChild("time", 1329636600);

$concert2 = $simplexml->addChild('concert');
$concert2->addChild("title", "Vivaldi Four Seasons");
$concert2->addChild("time", 1329291000);

$concert3 = $simplexml->addChild('concert');
$concert3->addChild("title", "Mozart's Requiem");
$concert3->addChild("time", 1330196400);

echo $simplexml->asXML();

/* output:
<concerts><concert><title>The Magic Flute</title><time>1329636600</time></concert><concert>
<title>Vivaldi Four Seasons</title><time>1329291000</time></concert><concert><title>Mozart's Requiem</title>
<time>1330196400</time></concert></concerts>
*/
?>