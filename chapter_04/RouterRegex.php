<?php
require_once 'RouterAbstract.php';

class RouterRegex extends RouterAbstract {
	/**
	 * Add a new route
	 * 
	 * @param string $route The route pattern
	 */
	public function addRoute($route, array $options = array())
	{
		$this->routes[] = array('pattern' => $this->_parseRoute($route), 'options' => $options);
	}

	/**
	 * Retrieve the route data
	 * 
	 * @param string $request The request URI
	 * @return array 
	 */
	public function getRoute($request)
	{
		$matches = array();
		foreach ($this->routes as $route) {
			// Try to match the request against defined routes
			if (preg_match($route['pattern'], $request, $matches)) {
				// If it matches, remove unnecessary numeric indexes
				foreach ($matches as $key => $value) {
					if (is_int($key)) {
						unset($matches[$key]);
					}
				}

				// Merge the matches with the supplied options
				$result = $matches + $route['options'];
				return $result;
			}
		}

    throw new Exception("Route not found");
	}

	/**
	 * Parse the route pattern
	 * 
	 * @param string $route The pattern
	 * @return string 
	 */
	protected function _parseRoute($route)
	{
		$baseUrl = $this->baseUrl;
		// Short-cut for the / route
		if ($route == '/') {
			return "@^$baseUrl/$@";
		}

		// Explode on the / to get each part
		$parts = explode("/", $route);

		// Start our regex, we use @ instead of / to avoid issues with the URL path
		// Start with our base URL
		$regex = "@^$baseUrl";

		// Check to see if it starts with a / and discard the empty arg
		if ($route[0] == "/") {
			array_shift($parts);
		}

		// Foreach each part of the URL
		foreach ($parts as $part) {
			// Add a / to the regex
			$regex .= "/";

			// Start looking for type:name strings
			$args = explode(":", $part);

			if (sizeof($args) == 1) {
				// If there's only one value, it's a static string
				$regex .= sprintf(self::REGEX_STATIC, preg_quote(array_shift($args), '@'));
				continue;
			} elseif ($args[0] == '') {
				// If the first value is empty, there is no type specified, discard it
				array_shift($args);
				$type = false;
			} else {
				// We have a type, pull it out
				$type = array_shift($args);
			}

			// Retrieve the key
			$key = array_shift($args);

			// If it's a regex, just add it to the expression and move on
			if ($type == "regex") {
				$regex .= $key;
				continue;
			}

			// Remove any characters that are not allowed in sub-pattern names
			$this->normalize($key);

			// Start creating our named sub-pattern
			$regex .= '(?P<' . $key . '>';

			// Add the actual pattern
			switch (strtolower($type)) {
				case "int":
				case "integer":
					$regex .= self::REGEX_INT;
					break;
				case "alpha":
					$regex .= self::REGEX_ALPHA;
					break;
				case "alphanumeric":
				case "alphanum":
				case "alnum":
					$regex .= self::REGEX_ALPHANUMERIC;
					break;
				default:
					$regex .= self::REGEX_ANY;
					break;
			}

			// Close the named sub-pattern
			$regex .= ")";
		}

		// Make sure to match to the end of the URL and make it unicode aware
		$regex .= '$@u';

		return $regex;
	}
}

/*
$router = new RouterRegex;
$router->addRoute("/alpha:page/alpha:action/:id", array('controller' => 'default'));
$router->addRoute("/photos/alnum:user/int:photoId/in/regex:(?P<groupType>([a-z]+?))-(?P<groupId>([0-9]+?))");

var_dump($router);

var_dump($router->getRoute('/user-account/view/123'));
var_dump($router->getRoute('/user-account/edit/123'));
var_dump($router->getRoute('/profile/view/123'));
var_dump($router->getRoute('/photos/dshafik/5584010786/in/set-72157626290864145'));
*/
?>