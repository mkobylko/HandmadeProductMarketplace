<?php

namespace core;

use mysqli;

class Database
{
    private static $instance = null;
    public $conn;

    private $servername;
    private $username;
    private $password;
    private $dbname;

    private function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "handmade";

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function backup()
    {
        $backup_file = 'C:/OSPanel/domains/courswork2sem/backupHandmade/backup-' . date('Y-m-d_H-i-s') . '.sql';

        $command = "mysqldump --opt --host=$this->servername --user=$this->username --password=$this->password $this->dbname > $backup_file";

        system($command);
    }

    //архівація
    public static function archive($conn)
    {
        $sql = "call Archive(curdate());";
        if (!$conn->query($sql)) {
            echo "Error executing query: " . $conn->error;
        }
    }


    public function query($sql)
    {
        $value = $this->conn->query($sql);
        if (!$value) {
            die($this->conn->error);
        }
        return $value;
    }

    public function multi_query($sql)
    {
        $value = $this->conn->multi_query($sql);
        //для multi_query треба цикл
        while ($this->conn->next_result()) {;}
        if (!$value) {
            die($this->conn->error);
        }
        return $value;
    }


    public function select($sql, $converter)
    {
        $result = $this->conn->query($sql);
        if (!$result) {
            die($this->conn->error);
        }
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $converter($row);
        }
        return $results;
    }

    public function selectSingle($sql, $converter)
    {
        $values = $this->select($sql, $converter);
        if (count($values) > 1) {
            die("More than one result");
        }
        if (count($values) == 0) {
            return null;
        }
        return $values[0];
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}

?>

