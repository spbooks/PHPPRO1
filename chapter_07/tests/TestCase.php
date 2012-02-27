<?php
class My_TestCase extends PHPUnit_Framework_TestCase
{
  public function assertContainsXPath($html, $expr)
  {
    $doc = new DOMDocument;
    $doc->loadHTML($html);
    $xpath = new DOMXPath($doc);
    return ($xpath->query($expr)->length > 0);
  }
}
?>