<?php
require_once 'Controller.php';
require_once 'RouterRegex.php';

$router = new RouterRegex;
$router->addRoute("/:controller/:action/alnum:user/int:photoId/in/regex:(?P<groupType>([a-z]+?))-(?P<groupId>([0-9]+?))");
$router->addRoute("/error", array('controller' => 'error', 'action' => 'showError'));

$controller = new Controller();
$controller->setRouter($router);

$controller->dispatch('/photos/getPhoto/dshafik/5584010786/in/set-72157626290864145');
$controller->dispatch('/users/dshafik');
?>