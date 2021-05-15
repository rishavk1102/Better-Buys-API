<?php

define('HOST', 'locslhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'better_buys');

// class DB start
class Database {
    private $connection;

    // Constructor
    public __construc() {
        $this->open_db_connection();
    }

    // Creating connection with the DB
    public function open_db_connection() {
        $this->connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if (mysqli_connect_error()) {
            die('Connection Error : ', mysqli_connect_error());
        }
    }

    // Executing SQL Query
    public function query($sql) {
        $result = $this->connection->query($sql);

        if (!$result) {
            die('Query fails : ', $sql);
        }

        return $result;
    }

    // Fetching list of data from the SQL Query result
    public function fetch_array($result) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $result_array[] = $row;
            }

            return $result_array;
        }
    }

    // Fetching a single row of data from the SQL Query
    public function fetch_row($result) {
        if ($result->num_rows > 0)
            return $result->fetch_assoc();
    }

    // Check proper format of data
    public function escape_value($value) {
        return $this->connection->real_escape_string($value);
    }

    // Closes the connection with SQL
    public function close_connection() {
        $this->connection->close();
    }
} // Class ends

$database = new Database();