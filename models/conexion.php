<?php

// creamos una clase para posteriormente convertirla en objeto para reutilizarla
class Conexion{
// estas variables se cambian cuando se sube a un hosting
    public function get_conexion(){
        $user="root";
        $pass="";
        $host="localhost";
        $db="motorsweb";
        $conexion= new PDO("mysql: host=$host; dbname=$db;", $user, $pass);
        return $conexion;
    }

}

?>

<!-- c -->