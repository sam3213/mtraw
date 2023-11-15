<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos

    $IdServicio=$_POST['IdServicio'];
    $NomServicio=$_POST['NomServicio'];
    $Proveedor=$_POST['Proveedor'];
    $Descripcion=$_POST['Descripcion'];
    
    
   
    

    // if(){
        //validamos que los campos esten diligenciados completamente
        
       if (strlen($IdServicio)>0 && strlen($NomServicio)>0 && strlen($Proveedor)>0 && strlen($Descripcion)>0){

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> ActualizarServicioAdmin($IdServicio, $NomServicio, $Proveedor, $Descripcion);

            
        }
        else{
            echo '<script> 
            swal.fire({
                icon: "error",
                title: "No pueden haber campos vacios ",
                text: "Por favor completa todos los campos",
                confirmButtonText: "OK"
            }).then(function() {
                window.location = "../views/Vendedor/verServicios.php";
            });</script>';
            // echo "<script>location.href='../views/administrador/registrar-usuario.php'</script>";
        }


?>

