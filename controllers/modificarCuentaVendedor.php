<?php

    // enlazar las dependencias
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");
    // aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del method=post y los name de los campos

    $identificacion= $_POST['identificacion'];
    $tipo_doc=$_POST['tipo_doc'];
    $nombres=$_POST['nombres'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    

    // if(){
        //validamos que los campos esten diligenciados completamente
        
       if (strlen($identificacion)>0 && strlen($tipo_doc) >0 && strlen($nombres)>0 && strlen($apellidos)>0 && strlen($email)>0 
        && strlen($telefono)>0) {

            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> modificarCuentaVendedor($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono);

            
        }
        else{
            echo "<script> 
            swal.fire({
                icon: 'error',
                title: 'No pueden haber campos vacios ',
                text: 'Por favor completa todos los campos',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = '../views/Vendedor/perfil.php?id=$identificacion';
            });</script>";
            // echo "<script>location.href='../views/administrador/registrar-usuario.php'</script>";
        }


?>

