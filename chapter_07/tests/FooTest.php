<?php
class My_Controller_FooTest extends PHPUnit_Framework_TestCase
{
  private $controller;

  public function setUp()
  {
    $this->controller = new My_Controller_Foo();
  }

  public function testActionGet()
  {
    $fooId = '1';
    $fooData = array('bar' => 'baz');
    $response = 'bar = baz';

    $fooModel = $this->getMock('My_Model_Foo');
    $fooModel->expects($this->once())
      ->method('get')
      ->with($fooId)
      ->will($this->returnValue($fooData));
    $this->controller->setFooModel($fooModel);

    $view = $this->getMock('My_View');
    $view->expects($this->once())
      ->method('assign')
      ->with($fooData);
    $view->expects($this->once())
      ->method('render')
      ->with('path/to/template')
      ->will($this->returnValue($response));
    $this->controller->setView($view);

    $params = array('fooId' => $fooId);
    $this->assertEquals($response, $this->controller->action($params));
  }
}
?>