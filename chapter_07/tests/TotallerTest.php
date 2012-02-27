<?php

require_once '../../lib/My/Totaller.php';

class My_TotallerTest extends PHPUnit_Framework_TestCase
{
  private $calculator;
  private $totaller;

  protected function setUp()
  {
    $this->calculator = $this->getMock('My_Calculator');
    $this->totaller = new My_Totaller;
    $this->totaller->setCalculator($this->calculator);
  }

  public function testCalculateTotal()
  {
    $this->calculator
      ->expects($this->at(0))
      ->method('add')
      ->with(0, 1)
      ->will($this->returnValue(1));
    $this->calculator
      ->expects($this->at(1))
      ->method('add')
      ->with(1, 2)
      ->will($this->returnValue(3));
    $this->calculator
      ->expects($this->at(2))
      ->method('add')
      ->with(3, 3)
      ->will($this->returnValue(6));
    $this->totaller->addOperand(1);
    $this->totaller->addOperand(2);
    $this->totaller->addOperand(3);
    $this->assertEquals(6, $this->totaller->calculateTotal());
  }
}
