<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/24/15
 * Time: 5:15 PM
 */

class Database {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $db = 'tixDB';
    private $myconn;

    function connect() {
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$conn) {
            die('Could not connect to database!');
        } else {
            $this->myconn = $conn;
            }
        return $this->myconn;
    }

    function close() {
        mysqli_close($myconn);
        echo 'Connection closed!';
    }


}