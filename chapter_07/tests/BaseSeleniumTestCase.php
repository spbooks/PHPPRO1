<?php
abstract class My_BaseSeleniumTestCase extends PHPUnit_Extensions_SeleniumTestCase
{
  protected $htmlSourcePath = '/var/www/htdocs/source';
  protected $coverageScriptUrl = 'http://localhost/phpunit_coverage.php';

  protected function setUp()
  {
    $this->setHost('localhost');
    $this->setPort(4444);
    $this->setBrowser('*firefox');
    $this->setBrowserUrl('http://example.com');
    $this->setTimeout(5000);
  }

  protected function onNotSuccessfulTest(Exception $e)
  {
    parent::onNotSuccessfulTest($e);
    $path = $this->htmlSourcePath . DIRECTORY_SEPARATOR .
      $this->testId . '.html';
    file_put_contents($path, $this->getHtmlSource());
    echo 'Source: ', $path, PHP_EOL;
  }
}
