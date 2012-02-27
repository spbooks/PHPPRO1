<?php
class My_DatabaseTester extends PHPUnit_Extensions_Database_AbstractTester
{
  /**
   * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
   */
  public function getConnection()
  {
    $pdo = new PDO('mysql:...');
    return $this->createDefaultDBConnection($pdo, 'database_name');
  }

  /**
   * @return PHPUnit_Extensions_Database_DataSet_IDataSet
   */
  public function getDataSet()
  {
    return $this->createFlatXMLDataSet(dirname(__FILE__) . '/_files/seed.xml');
  }
}
