<?php

    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    $objsesion = new Validarsesion();
    $result = $objsesion -> cerrarSesion();

    

?>