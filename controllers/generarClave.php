<?php
    
    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/generarClaveModel.php");


    $identificacion=$_POST['identificacion'];
    $email=$_POST['email'];

    $objClave = new GenerarClave();
    $result = $objClave->enviarnuevaclave($identificacion, $email );







?>