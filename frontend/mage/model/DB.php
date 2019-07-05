<?php

class DB
{

    private $conn;

    /**
     * build
     * 
     * @return object
     */
    public function  __construct() {
        $this->conn = new mysqli(_DBHOST, _DBUSER, _DBPASS, _DBNAME);
        if ($this->conn->connect_errno) {
            die("Failed to connect to Database: (" .
                $this->conn->connect_errno . ") " .
                $this->conn->connect_error
            );
        }
        return $this->conn;
    }

    /**
     * DB query
     * 
     * @return boolean
     */
    protected function query($string) {
        return $this->conn->query($string);
    }

     /**
     * DB multi_query
     * 
     * @return boolean
     */
    protected function multiQuery($string) {
       
        return $this->conn->multi_query($string);
    }

    /**
     * DB real_escape_string
     * 
     * @return string
     */
	protected function escapeString($string) {
		return $this->conn->real_escape_string($string);
	}


    /**
     * DB insert_id
     * 
     * @return integer
     */
    protected function insertID() {
        return $this->conn->insert_id;
    }

    /**
     * DB affected_rows
     * 
     * @return integer
     */
    protected function affectedRows() {
        return $this->conn->affected_rows;
    }

}