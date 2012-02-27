<?php
class My_DaoTest extends PHPUnit_Extensions_Database_TestCase
{
  private $dao;

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
    /*
	For a composite data set:

    $table1 = $this->createMySQLXMLDataSet('/path/to/table1.xml');
    $table3 = $this->createMySQLXMLDataSet('/path/to/table3.xml');

    $composite = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet();
    $composite->addDataSet($table1);
    $composite->addDataSet($table3);

    return $composite;
    */

    return $this->createFlatXMLDataSet(dirname(__FILE__) . '/_files/seed.xml');
  }

  protected function setUp()
  {
    $this->dao = new My_Dao;
    // any other required setup – connecting to the database, etc.
  }

  public function testDoStuff()
  {
    $this->dao->doStuff();

    // asserting table row count
    $expected_row_count = 2;
    $actual_row_count = $this->getConnection()->getRowCount('table_name');
    $this->assertEquals($expected_row_count, $actual_row_count);

    // asserting table / query result set equality
    $expected_table = $this->createMySQLXMLDataSet('/path/to/expected_table.xml')
      ->getTable('table_name');
    $actual_table = $this->getConnection()->createQueryTable('table_name',
      'SELECT * FROM table_name WHERE ...');
    $this->assertTablesEqual($expected_table, $actual_table);
  }
}
