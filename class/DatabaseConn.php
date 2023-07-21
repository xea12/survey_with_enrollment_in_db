<?php


class DatabaseConn {
    private $mysqli;
    private $dbServer;
    private $dbUsername;
    private $dbPassword;
    private $dbDatabase;

    public function __construct() {

        // Domyślne wartości (można zmienić na inne, jeśli jest to odpowiednie)
        $this->dbServer = DB_SERVER;
        $this->dbUsername = DB_SERVER_USERNAME;
        $this->dbPassword = DB_SERVER_PASSWORD;
        $this->dbDatabase = DB_DATABASE;

        $this->connect();
    }

    public function setConfig($dbServer, $dbUsername, $dbPassword, $dbDatabase) {
        // Ustawienie nowych wartości konfiguracji
        $this->dbServer = $dbServer;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbDatabase = $dbDatabase;

        // Ponowne połączenie z bazą danych z nowymi parametrami
        $this->connect();
    }

    private function connect() {
        $this->mysqli = new mysqli($this->dbServer, $this->dbUsername, $this->dbPassword, $this->dbDatabase);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset("utf8");
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function closeConnection() {
        $this->mysqli->close();
    }
}


?>