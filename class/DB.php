<?php
    class DB{
        public function connect(){
            $dsn = 'mysql:host=127.0.0.1;dbname=contacts;charset=utf8';
            try{
                $pdo = new PDO($dsn, 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
                return $pdo;
            }
            catch(PDOException $e){
                return "Connection error: ".$e->getMessage();
            }
        }
    
        public function select($SQL, $array = false){
            try {
                $PDO = DB::connect();
                $rs = $PDO->prepare($SQL);
                $rs->execute();
                $rowsCount = $rs->rowCount();
    
                if($rowsCount == 1 && $array == false)
                    $row = $rs->fetchAll(PDO::FETCH_OBJ);
                else if($rowsCount == 1 && $array == true)
                    $row = array($rs->fetchAll(PDO::FETCH_OBJ));
                else if($rowsCount > 1)
                    $row = $rs->fetchAll(PDO::FETCH_OBJ);
                else if($rowsCount == 0 && $array == true)
                    $row = array();
                else
                    return false;
    
                return $row;
            }
            catch(PDOException $e){
                return "Select error: ".$e->getMessage();
            }
        }
    
        public function insert($SQL, $key = false){
            try {
                $PDO = DB::connect();
                $rs = $PDO->prepare($SQL);
                if($rs->execute())
                    return true;
                else 
                    return false;
            }
            catch(PDOException $e){
                if($key) return false;
                else return "Insert error: ".$e->getMessage();
            }
        }    
        public function update($SQL, $key = false){
            try {
                $PDO = DB::connect();
                $rs = $PDO->prepare($SQL);
                if($rs->execute())
                    return true;
                else 
                    return false;
            }
            catch(PDOException $e){
                if($key) return false;
                else return "Update error: ".$e->getMessage();
            }
        }
        public function delete($SQL, $key = false){
            try {
                $PDO = DB::connect();
                $rs = $PDO->prepare($SQL);
                if($rs->execute())
                    return true;
                else 
                    return false;
            }
            catch(PDOException $e){
                if($key) return false;
                else return "Delete error: ".$e->getMessage();
            }
    }
}