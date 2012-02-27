<?php
$request = new HttpRequest('http://api.bitly.com/v3/shorten'
  . '?login=user&apiKey=secret'
  . '&longUrl=http%3A%2F%2Fsitepoint.com');
$request->send();

$result = $request->getResponseBody();
print_r(json_decode($result));

/* output:
stdClass Object
(
    [status_code] => 200
    [status_txt] => OK
    [data] => stdClass Object
        (
            [long_url] => http://sitepoint.com/
            [url] => http://bit.ly/qmcGU2
            [hash] => qmcGU2
            [global_hash] => 3mWynL
            [new_hash] => 0
        )

)
*/
?>