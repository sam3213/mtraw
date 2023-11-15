<?php

    //enlazar las dependencia
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $identificacion = $_POST['identificacion'];
    $clave = md5($_POST['clave']);

    //validar los datos
    if(strlen($identificacion)>0 && strlen($clave)>0){

        //crear objeto 
        $objValidar = new Validarsesion();
        $result = $objValidar -> iniciarSesion($identificacion,$clave);

    }else{
        echo ' <script>alert("ingrese su identificacion y contraseña")</script> ';
        echo " <script>location.href='../views/Cliensite/login.html'</script>";
    }

?>
