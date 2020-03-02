<?php
class DB{
    // Declare the essential parameters in private statics
    private static $host = "localhost:3306";
    private static $username = "root";
    private static $password = "";
    private static $database = "chiupimusic";

    // Create connection
    public $conn = null;
    function __construct(){
        $conn = new mysqli(self::$host, self::$username, self::$password, self::$database);
        $this->conn = $conn;
        if ($conn->connect_error) {
            die("Connect error: " . $conn->connect_error);
        }
        mysqli_query($this->conn, "set names utf8");
    }

    // close connect databases
    function __destruct(){
        $this->conn->close();
    }



    /**
     * @param $sql [string] mysql statment
     * @return arr [array] Result set
     */
    public function query($sql){
        $result = $this->conn->query($sql);
        $arr = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                array_push($arr, $row);
            }
        }
        return $arr;
    }



    /**
     * @param table [string] table name
     * @param id [int] Primary key
     */
    public function delete($table, $id){
        $sql = "DELETE FROM $table WHERE albumID=$id";
        if(!$this->conn->query($sql)){
            throw new Exception("Delete error", 1);
        }
    }


    /**
     * @param sql [string] mysql statment
     */
    public function update($sql){
        if(!$this->conn->query($sql)){
            throw new Exception("Update error", 1);
        }
    }



   /**
     * @param sql [string] mysql statment
     */
    public function insert($sql){
        if($this->conn->query($sql) === FALSE){
            throw new Exception("Update error".$this->conn->error, 1);
        }
    }



    public function count($table){
        $res = $this->conn->query("select count(*) from $table")->fetch_assoc();
        return $res['count(*)'];
    }



}
