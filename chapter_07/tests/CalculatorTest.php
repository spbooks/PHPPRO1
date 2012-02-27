<?php
// tests/My/CalculatorTest.php

class My_CalculatorTest extends PHPUnit_Framework_TestCase
{
  private $calculator;

  protected function setUp()
  {
    $this->calculator = new My_Calculator();
  }

  protected function tearDown()
  {
    unset($this->calculator);
  }

  public function testAddBothPositive()
  {
    $result = $this->calculator->add(3, 2);
    $this->assertEquals(5, $result);
  }

  public function testAddPositiveAndZero()
  {
    $result = $this->calculator->add(2, 0);
    $this->assertEquals(2, $result);
  }

  public function testAddPositiveAndNegative()
  {
    $result = $this->calculator->add(-1, 1);
    $this->assertEquals(0, $result);
  }
}
