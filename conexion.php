<?php
    //coneccion base de datos
    
    class conexion {
    private $host = "localhost";
    //private $bd = "album";
    private $usuario = "root";
    private $contrasenia = "";


    public function __construct(){
    try {
        //$conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);//pdo conecta con la base
        $this->conexion = new PDO("mysql:host=$this->host;dbname=albumm",$this->usuario,$this->contrasenia);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       // if($conexion){echo "Conectado.... a sistema ";}
    } 
    
    catch(PDOException $e){
        return "falla de conexion".$e;

    }
    }


    public function ejecutar($sql){ // Insertar / Delete / Acualizar
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();

    }




    
    public function consultar($sql){
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
    }
?>