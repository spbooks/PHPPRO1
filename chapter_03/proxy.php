<?php
// An array of allowed hosts with their HTTP protocol (i.e. http or https) and returned mimetype
$allowed_hosts = array(
                  'api.bit.ly' => array(
                      "protocol" => "http",
                      "mimetype" => "application/json",
                      "args" => array(
                          "login" => "user",
                          "apiKey" => "secret",
                      )
                   )
                );

// Check if the requested host is allowed, PATH_INFO starts with a /
$requested_host = parse_url("http:/" .$_SERVER['PATH_INFO'],PHP_URL_HOST);
if (!isset($allowed_hosts[$requested_host])) {
  // Send a 403 Forbidden HTTP status code and exit
  header("Status: 403 Forbidden");
  exit;
}

// Create the final URL
$url = $allowed_hosts[$requested_host]['protocol'] . ':/' . $_SERVER['PATH_INFO'];
if (!empty($_SERVER['QUERY_STRING'])) {
  // Construct the GET args from those passed in and the default
  $url .= '?' .http_build_query($_GET + ($allowed_hosts[$requested_host]['args']) ?: array());
}

// Instantiate curl
$curl = curl_init($url);

// Check if request is a POST, and attach the POST data
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $data = http_build_query($_POST);
	curl_setopt ($curl, CURLOPT_POST, true);
	curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
}

// Don't return HTTP headers. Do return the contents of the call
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Make the call
$response = curl_exec($curl);

// Relay unsuccessful responses
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($status >= "400") {
  header("Status: 500 Internal Server Error");
}

// Set the Content-Type appropriately
header("Content-Type: " .$allowed_hosts[$requested_host]['mimetype']);

// Output the response
echo $response;

// Shutdown curl
curl_close($curl);
?>
<script type="text/javascript">
function shortenWebsiteURL(url) {
  $.AJAX(
    url: "/proxy.php/api.bit.ly/v3/shorten",
    data: {longUrl: url},
    success: function(data) {
      $('input#website').attr('value', data.url);
    }
  );
}
</script>