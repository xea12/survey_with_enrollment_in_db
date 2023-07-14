<?php

class DatabaseConn {
    private $mysqli;

    public function __construct($dbServer, $dbUsername, $dbPassword, $dbDatabase) {
        $this->mysqli = new mysqli($dbServer, $dbUsername, $dbPassword, $dbDatabase);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset('utf8');
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function closeConnection() {
        $this->mysqli->close();
    }
}

?>