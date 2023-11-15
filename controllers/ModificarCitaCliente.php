<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $idCita=$_POST['idcita'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
       


        //validamos que los campos esten diligenciados completamente
        if (strlen($fecha)>0 && strlen($hora)>0) {
            

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> ModificarCitaCliente($fecha, $hora, $idCita);

        }
        else{
            echo '<script> alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Cliente/Citas.php'</script>";
        }

?>