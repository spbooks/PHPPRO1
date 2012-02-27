<?php
abstract class RouterAbstract {
  /**
	 * Supported Regular Expression Groups
	 */
	const REGEX_ANY = "([^/]+?)";
	const REGEX_INT = "([0-9]+?)";
	const REGEX_ALPHA = "([a-zA-Z_-]+?)";
	const REGEX_ALPHANUMERIC = "([0-9a-zA-Z_-]+?)";
	const REGEX_STATIC = "%s";
  
  /**
	 * @var array The compiled routes
	 */
	protected $routes = array();
  
	/**
	 * @var string The base URL 
	 */
	protected $baseUrl = '';
  
  /**
	 * Add a new route
	 * 
	 * @param string $route The route pattern
	 */
  abstract public function addRoute($route, array $options = array());
  
  /**
	 * Retrieve the route data
	 * 
	 * @param string $request The request URI
	 * @return array 
	 */
  abstract public function getRoute($request);
  
  /**
	 * Set a base URL from which all routes will be matched
   * 
	 * @param string $baseUrl 
	 */
	public function setBaseUrl($baseUrl)
	{
		// Escape the base URL, with @ as our delimeter
		$this->baseUrl = preg_quote($baseUrl, '@');
	}
  
  /**
	 * Normalize a string for sub-pattern naming
	 * 
	 * @param string &$param 
	 */
	public function normalize(&$param)
	{
		$param = preg_replace("/[^a-zA-Z0-9]/", "", $param);
	}
}