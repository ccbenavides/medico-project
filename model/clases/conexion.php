<?php

class Conexion extends PDO {
    
    private $type = 'pgsql';
    private $host = 'localhost';
    private $db = 'sisbio';
    private $user = 'postgres';
    private $pass = 'acuario203972';

    public function __construct() {
       
        try {
            parent::__construct($this->type . ':host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
    }
}

date_default_timezone_set('America/Lima');


function d($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>"; 
    exit();
}

?>