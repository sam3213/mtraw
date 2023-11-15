<?php
    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    session_start();
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos
    $Idproducto=$_POST['IdProducto'];
    $nomProducto=$_POST['nomProducto'];
    $proveedor=$_POST['proveedor'];
    $categoria=$_POST['categoria'];
    $cantidad=$_POST['cantidad'];
    $precio=$_POST['precio'];
    $identificacion=$_SESSION['id'];
    // $descripcion=$_POST['descripcion'];


        //validamos que los campos esten diligenciados completamente
        if (strlen($Idproducto)>0 && strlen($nomProducto)>0 && strlen($proveedor) >0 && strlen($categoria)>0 && strlen($cantidad)>0 && strlen($precio)>0  ) {
            


            $foto1 = "../Uploads/Productos/".$_FILES['foto1']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta Productos
            $mover1 = move_uploaded_file($_FILES['foto1']['tmp_name'], $foto1);

            $foto2 = "../Uploads/Productos/".$_FILES['foto2']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta Productos
            $mover2 = move_uploaded_file($_FILES['foto2']['tmp_name'], $foto2);

            $foto3 = "../Uploads/Productos/".$_FILES['foto3']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta Productos
            $mover3 = move_uploaded_file($_FILES['foto3']['tmp_name'], $foto3);

            $foto4 = "../Uploads/Productos/".$_FILES['foto4']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta Productos
            $mover4 = move_uploaded_file($_FILES['foto4']['tmp_name'], $foto4);


            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarProducVendedor( $Idproducto, $nomProducto,$proveedor,$categoria,$cantidad,$precio, $foto1, $foto2, $foto3, $foto4, $identificacion);

        }
        else{
            echo '<script> alert("Por favor complete todos los campos") </script>';
            echo "<script>location.href='../views/Vendedor/registrarProducto.php'</script>";
        }



?>