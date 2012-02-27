<?php
$jsonData = '[{"title":"The Magic Flute","time":1329636600}, {"title":"Vivaldi Four Seasons","time":1329291000},{"title":"Mozart\'s Requiem","time":1330196400}]';

$concerts = json_decode($jsonData, true);
print_r($concerts);

/*
Output:
Array                                                                                                                                                                                        
(
    [0] => Array
        (
            [title] => The Magic Flute
            [time] => 1329636600
        )

    [1] => Array
        (
            [title] => Vivaldi Four Seasons
            [time] => 1329291000
        )

    [2] => Array
        (
            [title] => Mozart's Requiem
            [time] => 1330196400
        )

)
*/
?>