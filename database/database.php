<?php 
    class Database{
        private $host = "localhost";
        private $db_name = "task2";
        private $username = "root";
        private $password = "";
        public $conn;


        public function getConnection(){
            $this -> conn = null;

            try{
                $this -> conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name,$this -> username,$this -> password);
                if($this -> conn){
                    // echo "Connected to the database Successfully.";
                }
            }catch(Exception $e){
                echo "Connection error: ".$e -> getMessage();
            }
            return $this -> conn;
        }
    }
?>