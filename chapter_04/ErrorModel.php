<?php
class Error_Model {
  public function showError($data)
  {
    $config = Registry::get('site-config');
    
    $factory = new Log_Factory();
    $log = $factory->getLog($config['log']['type'], $config['log']);
    $log->add($data['message']);
    
    return array();
  }
}