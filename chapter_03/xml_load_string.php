<?php
$xml = '<concerts><concert><title>The Magic Flute</title><time>1329636600</time></concert><concert><title>Vivaldi Four Seasons</title><time>1329291000</time></concert><concert><title>Mozart\'s Requiem</title><time>1330196400</time></concert></concerts>';

$concert_list = simplexml_load_string($xml);
print_r($concert_list);

/* output:
SimpleXMLElement Object
(
    [concert] => Array
        (
            [0] => SimpleXMLElement Object
                (
                    [title] => The Magic Flute
                    [time] => 1329636600
                )

            [1] => SimpleXMLElement Object
                (
                    [title] => Vivaldi Four Seasons
                    [time] => 1329291000
                )

            [2] => SimpleXMLElement Object
                (
                    [title] => Mozart's Requiem
                    [time] => 1330196400
                )

        )

)
*/

// show a table of the concerts
echo "<table>\n";
foreach($concert_list as $concert) {
  echo "<tr>\n";
  echo "<td>" . $concert->title . "</td>\n";
  echo "<td>" . date('g:i, jS M',(string)$concert->time) . "</td>\n";

  echo "</tr>\n";
}
echo "</table>\n";

// output the second concert title
echo "Featured Concert: " . $concert_list->concert[1]->title;
?>