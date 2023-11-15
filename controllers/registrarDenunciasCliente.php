<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    session_start();
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $usuario=$_SESSION['id'];
    $nombreUsuario=$_POST['nombreUsuario'];
    $asunto=$_POST['asunto'];
    $descripcion=$_POST['descripcion'];

   
    // $descripcion=$_POST['descripcion'];


        //validamos que los campos esten diligenciados completamente
        if (strlen($nombreUsuario)>0 && strlen($asunto)>0 && strlen($descripcion)>0 ) {
            

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarDenunciaCliente($usuario, $nombreUsuario,$asunto,$descripcion);

        }
        else{
            echo '<script> alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Cliente/contact.php'</script>";
        }

?>