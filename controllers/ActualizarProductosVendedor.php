<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos

    $Idproducto=$_POST['IdProducto'];
    $nomProducto=$_POST['nomProducto'];
    $proveedor=$_POST['proveedor'];
    $categoria=$_POST['categoria'];
    $cantidad=$_POST['cantidad'];
    $precio=$_POST['precio'];
    
   
    

    // if(){
        //validamos que los campos esten diligenciados completamente
        
       if (strlen($Idproducto)>0 && strlen($nomProducto)>0 && strlen($proveedor)>0 && strlen($categoria)>0 && strlen($cantidad)>0 
        && strlen($precio)>0) {

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> ActualizarProductosVendedor($Idproducto, $nomProducto, $proveedor, $categoria, $cantidad, $precio);

            
        }
        else{
            echo '<script> 
            swal.fire({
                icon: "error",
                title: "No pueden haber campos vacios ",
                text: "Por favor completa todos los campos",
                confirmButtonText: "OK"
            }).then(function() {
                window.location = "../views/Vendedor/verProductos.php";
            });</script>';
            // echo "<script>location.href='../views/administrador/registrar-usuario.php'</script>";
        }


?>

