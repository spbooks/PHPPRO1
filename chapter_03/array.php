<?php
$concerts = array(
  array("title" => "The Magic Flute",
    "time" => 1329636600),
  array("title" => "Vivaldi Four Seasons",
    "time" => 1329291000),
  array("title" => "Mozart's Requiem",
    "time" =>  1330196400)
  );

echo json_encode($concerts);

/* output
[{"title":"The Magic Flute","time":1329636600},{"title": "Vivaldi Four Seasons","time":1329291000},{"title": "Mozart's Requiem","time":1330196400}]
*/
?>