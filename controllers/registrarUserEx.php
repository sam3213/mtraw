<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos

    $identificacion= $_POST ['identificacion'];
    $tipo_doc=$_POST['tipo_doc'];
    $nombres=$_POST['nombres'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    $clave=$_POST['clave'];
    $clave2=$_POST['clave2'];
    $rol=$_POST['rol'];
    $estado = ($rol === 'Vendedor') ? 'Pendiente' : 'Activo';
    // verificamos que las claves coincidan

    if($clave == $clave2){
        //validamos que los campos esten diligenciados completamente
        if (strlen($identificacion)>0 && strlen($tipo_doc) >0 && strlen($nombres)>0 && strlen($apellidos)>0 && strlen($email)>0 
        && strlen($telefono)>0 && strlen($clave)>0 && strlen($rol)>0) {
        
            //encritar contraseña
            $claveMd=md5($clave);

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarUserEx($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono , $claveMd, $rol, $estado);

        }
        else{
            echo '<script> alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Cliensite/signin.html'</script>";
        }

    }else{
        echo ' <script>alert("Las claves no coinciden.")</script> ';
        echo " <script>location.href='../views/Cliensite/signin.html'</script>";
    }

?>