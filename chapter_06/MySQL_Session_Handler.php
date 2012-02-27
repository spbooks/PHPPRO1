<?php

/**
 * CREATE TABLE `sessions` (
 *  `id` varchar(255) NOT NULL,
 *  `data` text,
 *  `accesstime` int(10) unsigned default '0',
 *  PRIMARY KEY  (`id`)
 * ) ENGINE=MyISAM;
 *
 */
class MySQL_Session_Handler {
  const DB_SERVER = 'localhost';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';
  const DB_NAME = 'sessions';

  /**
   * @var PDO
   */
  protected $db;

  function __construct() {
    session_set_save_handler(array($this, "open"), array($this, "close"), array($this, "read"), array($this, "write"), array($this, "destroy"), array($this, "gc"));
  }

  function open($savePath, $sessName) {

    //connect to the database
    try {
      $this->db = new PDO('mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
    } catch (PDOException $e) {
      return false;
    }

    return true;
  }

  function close() {
    $this->gc();
    unset($this->db);
  }

  function read($id) {
    //fetch the session record
    $sql = "SELECT data FROM sessions WHERE id = :sid";
    
    $query = $this->db->prepare($sql);
    
    $result = $query->execute(array(':sid' => $id));
    
    if ($result && $query->rowCount() > 0) {
      return $query->fetch(PDO::FETCH_ASSOC);;
    }
    
    // PHP requires you send an empty string if no session data
    return "";
  }

  function write($id, $data) {
    $sql = "REPLACE INTO sessions SET
                 id = :sid, 
                 accesstime = " .time() . ",
                 data = :data";
    
    $query = $this->db->prepare($sql);
    
    $result = $query->execute(
      array(
          ':sid' => $id,
          ':data' => $data
      )      
    );
    
    if ($result && $query->rowCount() > 0) {
      return true;
    }
    return false;
  }

  function destroy($id) {
    $sql = "DELETE FROM sessions WHERE id = :sid";
    
    $query = $this->db->prepare($sql);
    
    $result = $query->execute(array(':sid' => $id));
    
    if ($result) {
      return true;
    }
    
    return false;
  }

  function gc() {
    //garbage collection
    
    $timeout = time() - get_cfg_var("session.gc_maxlifetime");
    
    $sql = "DELETE FROM sessions WHERE accesstime < :timeout";
    
    $query = $this->db->prepare($sql);
    
    $result = $query->execute(array(':timeout' => $timeout));
    
    if ($result) {
      return true;
    }
    
    return false;
  }

}

new MySQL_Session_Handler();