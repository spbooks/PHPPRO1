<?php
class Photos_Controller {
  /**
   * @var RouterAbstract
   */
  protected $router = false;
  
  /**
   * Run our request
   * 
   * @param string $url 
   */
  public function dispatch($url, $default_data = array())
  {
    try {
      if (!$this->router) {
        throw new Exception("Router not set");
      }

      $route = $this->router->getRoute($url);

      $controller = ucfirst($route['controller']);
      $action = ucfirst($route['action']);

      unset($route['controller']);
      unset($route['action']);

      // Get our model
      $model = $this->getModel($controller);

      $data = $model->{$action}($route);
      $data = $data + $default_data;

      // Get our view
      $view = $this->getView($controller, $action);

      echo $view->render($data);
    } catch (Exception $e) {
      try {
        if ($url != '/error') {
          $data = array('message' => $e->getMessage());
          $this->dispatch("/error", $data);
        } else {
          throw new Exception("Error Route undefined");
        }
      } catch (Exception $e) {
        echo "<h1>An unknown error occurred.</h1>";
      }
    }
  }
  
  /**
   * Set the router
   * 
   * @param RouterAbstract $router 
   */
  public function setRouter(RouterAbstract $router)
  {
    $this->router = $router;
  }
  
  /**
   * Get an instantiated model class
   * 
   * @param string $name
   * @return mixed
   */
  protected function getModel($name)
  {
    $name .= '_Model';
    

    $this->includeClass($name);
    
    return new $name;
  }
  
  /**
   * Get an instantiated view class
   * 
   * @param string $name
   * @param string $action
   * @return mixed
   */
  protected function getView($name, $action)
  {
    $name .= '_' .$action. 'View';
    
    $this->includeClass($name);
    
    return new $name;
  }
  
  /**
   * Include a class using PEAR naming scheme
   * 
   * @param string $name 
   * @return void
   * @throws Exception
   */
  protected function includeClass($name)
  {
    $file = str_replace('_', DIRECTORY_SEPARATOR, $name) . '.php';
    
    if (!file_exists($file)) {
      throw new Exception("Class not found!");
    }
    
    require_once $file;
  }
}
?>