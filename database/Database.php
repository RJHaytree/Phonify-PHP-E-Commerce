<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath. "/../config/config.php");

?>

<?php

/**
 * Database class for all database operations
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        
        // Check if connection was established.
        if (!($this->connection)) {
            echo "Database connection failed: " . $this->connection->connect_error;
            return false;
        }
    }

    /**
     * Submit a query to tbe database for insertion.
     * 
     * @param $sql The query to be inserted into the database.
     */
    public function insert($sql) {
        $result = $this->connection->query($sql) or die($this->connection->error . __LINE__);
        
        if ($result) {
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * Submit a query to the database for selection.
     * 
     * @param $sql The select query to be submitted to the database.
     */
    public function select($sql) {
        $result = $this->connection->query($sql) or die($this->connection->error . __LINE__);

        if ($result->num_rows > 0) {
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * Submit a query to the database for deletion.
     * 
     * @param $sql The delete query to be sent to the database.
     */
    public function delete($sql) {
        $result = $this->connection->query($sql) or die($this->connection->error . __LINE__);

        if ($result) {
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * Submit a query to the database for updating.
     * 
     * @param $sql The update query to be sent to the database.
     */
    public function update($sql) {
        $result = $this->connection->query($sql) or die($this->connection->error . __LINE__);

        if ($result) {
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * Retrieve the connection object.
     * 
     * @return $connection the connection object.
     */
    public function getConnection() {
        return $this->connection;
    }
}

?>