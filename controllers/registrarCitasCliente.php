<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $Nservicio=$_POST['IdServicio'];
    $Ncliente=$_POST['IdCliente'];
    $Ntaller=$_POST['IdTaller'];
    $estado="Pendiente";

   
    // $descripcion=$_POST['descripcion'];


        //validamos que los campos esten diligenciados completamente
        if (strlen($fecha)>0 && strlen($hora)>0) {
            

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarCitaCliente($fecha, $hora,$Nservicio,$Ncliente, $Ntaller, $estado);

        }
        else{
            echo '<script> window.alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Cliente/llanteras.php'</script>";
        }

?>