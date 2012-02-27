<?php
class My_FooSeleniumTestCase extends My_BaseSeleniumTestCase
{
  protected $databaseTester;

  protected $captureScreenshotOnFailure = TRUE;
  protected $screenshotPath = '/var/www/htdocs/screenshots';
  protected $screenshotUrl = 'http://localhost/screenshots';

  protected function setUp()
  {
    parent::setUp();
    $this->databaseTester = new My_DatabaseTester();
    $this->databaseTester->onSetUp();

    $this->open('/foo');
    // ...
  }

  protected function tearDown()
  {
    parent::tearDown();
    $this->databaseTester->onTearDown();
  }
}
