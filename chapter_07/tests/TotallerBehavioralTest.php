<?php

require_once '../../lib/My/Totaller.php';

class My_TotallerBehavioralTest extends PHPUnit_Extensions_Story_TestCase
{
  public function runGiven(&$world, $action, $arguments)
  {
    switch ($action)
    {
      case 'New totaller':
        $world['calculator'] = $this->getMock('My_Calculator');
        $world['calculator']
          ->expects($this->any())
          ->method('add')
          ->will($this->returnCallback(array($this, 'calculatorAdd')));
        $world['totaller'] = new My_Totaller();
        $world['totaller']->setCalculator($world['calculator']);
        break;
      default:
        return $this->notImplemented($action);
    }
  }

  public function calculatorAdd($a, $b)
  {
    static $sums = array(
      '0+2' => 2,
      '0+-1' => -1,
      '2+3' => 5,
      '2+0' => 2,
      '-1+1' => 0,
    );

    $eqn = “$a+$b”;
    if (isset($sums[$eqn]))
    {
      return $sums[$eqn];
    }

    $this->fail(“No known output for calculator inputs: $a, $b”);
  }

  public function runWhen(&$world, $action, $arguments)
  {
    switch ($action)
    {
      case 'Totaller receives operand':
        $world['totaller']->addOperand($arguments[0]);
        break;
      default:
        return $this->notImplemented($action);
    }
  }

  public function runThen(&$world, $action, $arguments)
  {
    switch ($action)
    {
      case 'Total should be':
        $this->assertEquals($arguments[0], $world['totaller']->calculateTotal());
        break;
      default:
        return $this->notImplemented($action);
    }
  }

  /**
   * @scenario
   */
  public function sumOfTwoPositiveNumbersIsPositive()
  {
    $this
      ->given('New totaller')
       ->when('Totaller receives operand', 2)
        ->and('Totaller receives operand', 3)
       ->then('Total should be', 5);
  }

  /**
   * @scenario
   */
  public function sumOfAPositiveNumberAndZeroIsPositive()
  {
    $this
      ->given('New totaller')
       ->when('Totaller receives operand', 2)
        ->and('Totaller receives operand', 0)
       ->then('Total should be', 2);
  }

  /**
   * @scenario
   */
  public function sumOfEqualPositiveAndNegativeNumbersIsZero()
  {
    $this
      ->given('New totaller')
       ->when('Totaller receives operand', -1)
        ->and('Totaller receives operand', 1)
       ->then('Total should be', 0);
  }
}
