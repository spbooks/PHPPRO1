<?php

require_once dirname(__FILE__) . '/Calculator.php';

class My_Totaller
{
  private $calculator = null;
  private $operands = array();

  public function getCalculator()
  {
    if (empty($this->calculator)) {
      $this->calculator = new My_Calculator;
    }
    return $this->calculator;
  }

  public function setCalculator(My_Calculator $calculator)
  {
    $this->calculator = $calculator;
  }

  public function addOperand($operand)
  {
    $this->operands[] = $operand;
  }

  public function calculateTotal()
  {
    $calculator = $this->getCalculator();
    $total = 0;
    foreach ($this->operands as $operand) {
      $total = $calculator->add($total, $operand);
    }
    return $total;
  }
}
