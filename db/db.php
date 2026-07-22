<?php

    class myDB {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "ajax_oop";
        public $res;
        public $conn;

        public function __construct() {
            try {
                $this ->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            } catch (Exception $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        public function __destruct() {
            $this->conn->close();
        }

        public function insert($table, $data){
            try{
                $table_columns = implode(",", array_keys($data));
                $prep = $types="";

                foreach($data as $key => $value){
                    $prep .= "?,";
                    $types .= substr(gettype($value), 0, 1);
                }

                $prep = substr($prep, 0, -1);
                $stmt = $this->conn->prepare("INSERT INTO $table ($table_columns) VALUES ($prep)");
                $stmt->bind_param($types, ...array_values($data));
                $stmt->execute();
                $stmt->close();

            }catch(Exception $e){
                die("Insert failed: " . $e->getMessage());
            }
        }

        public function select($table, $row="*", $where=NULL){
            try{
                if(!is_null($where)){
                    $cond = $types = "";
                    foreach($where as $key => $value){
                        $cond .= $key . " = ? AND ";
                        $types .= substr(gettype($value), 0, 1);
                    }

                    $cond = substr($cond, 0, -4);
                    $stmt = $this->conn->prepare("SELECT $row FROM $table WHERE $cond");
                    $stmt->bind_param($types, ...array_values($where));
                } else {
                $stmt =$this->conn->prepare("SELECT $row FROM $table");
                }

                $stmt ->execute();
                $this->res = $stmt->get_result();
            } catch(Exception $e){
                die("Select failed: " . $e->getMessage());
            }
        }
    }

?>