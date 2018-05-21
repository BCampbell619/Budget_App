<?php 

    require_once('db_config.php');

    class Database {
        
        public $connection;
        public $db_message;
        
        function __construct() {
            
            $this->db_connection();
            
        }
        
        public function db_connection() {
            
            if(!mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) {
                
                die("Connection to the database has failed. " . mysqli_connect_error());
                
            }
            
        }
        
        public function get_set_query($sql) {
            
            $return_msg = "";
            
            $resultSet = mysqli_query(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME),$sql);
            
            $return_msg = $this->validQuery($resultSet);
            
            if($return_msg == ""){
            
                return $resultSet;
                
            }else{
                
                return $return_msg;
                
            }
            
        }
        
        public function insert_id() {
            
            return mysqli_insert_id(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME));
            
        }
        
        private function validQuery($resultSet) {
            
            if(!$resultSet) {
                
                $this->db_message = "No result set was returned by query!";
                
            } else {
                
                $this->db_message = "";
                
            }
            
            return $this->db_message;
            
        }
        
        public function escape_string($string) {
            
            $escaped_string = mysqli_real_escape_string(mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME),$string);
            
            return $escaped_string;
            
        }
        
    }

    $db = new Database();

?>