<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    session_start();
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $nomservicio=$_POST['nomServicio'];
    $proveedor=$_SESSION['id'];
    $numeroServicio=$_POST['IdServicio'];
    $descripcion=$_POST['descripcion'];

   
    // $descripcion=$_POST['descripcion'];


        //validamos que los campos esten diligenciados completamente
        if (strlen($nomservicio)>0 && strlen($numeroServicio)>0 && strlen($descripcion)>0 ) {
            


            $foto1 = "../Uploads/Productos/".$_FILES['foto1']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta Productos
            $mover1 = move_uploaded_file($_FILES['foto1']['tmp_name'], $foto1);

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarServicioVendedor($nomservicio,$proveedor,$numeroServicio,$descripcion,$foto1);

        }
        else{
            echo '<script> alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Vendedor/registrarServicio.php'</script>";
        }

?>