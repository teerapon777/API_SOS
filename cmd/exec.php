<?php
class ExecSQL{
    private $conn;
    public function __construct($str_conn){

        $this->conn =$str_conn;
     }

    public function readAll($table_name){
		$stmt = $this->conn->prepare(" SELECT * FROM ".$table_name);
        $stmt->execute();
        return $stmt;	
    }
    public function rowCount($table_name){
        $stmt = $this->conn->prepare( " SELECT
                                            COUNT(*) as total_rows
                                        FROM ".$table_name );
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows['total_rows'];
    }
    public function insert($table_name, $fields, $value){
        $stmt = $this->conn->prepare(" INSERT INTO $table_name ($fields) VALUES ($value) ");
        return $this->exeCMD($stmt);
    }
    public function dataTransection($sql) {
        $stmt = $this->conn->prepare($sql);
        return $this->exeCMD($stmt);
    }
    public function populateData($sql) {
        $stmt = $this->conn->prepare($sql);
		$stmt->execute();
        return $stmt;
    }
    public function exeCMD($stmt){
        if($stmt->execute()){
            return 1;
        } else { return 0; }
    }
    public function numRow($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows['num_rows'];
    }


}


?>