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
    $rol=$_POST['rol']; 
    $estado=$_POST['estado'];
    $clave = $_POST['identificacion'];

    // if(){
        //validamos que los campos esten diligenciados completamente
        
       if (strlen($identificacion)>0 && strlen($tipo_doc) >0 && strlen($nombres)>0 && strlen($apellidos)>0 && strlen($email)>0 
        && strlen($telefono)>0 && strlen($clave)>0 && strlen($rol)>0 && strlen($estado)>0) {
        
            //encritar contraseña

            $claveMd=md5($clave);

            // Creamos una variable para definir la ruta donde quedara alojada la imagen
            $foto = "../Uploads/Usuarios/".$_FILES['foto']['name'];
            // Movemos el archivo a la carpeta Uploads y la carpeta usuarios
            $mover = move_uploaded_file($_FILES['foto']['tmp_name'], $foto);


            //creamos el objeto apartir de la clase
            //creamos el objeto a partir de la clase para enviar los argumentos a la funcion en el modelo(archivo consultas)
            $objConsultas = new Consultas();
            $result = $objConsultas -> insertarUserAdmin($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono , $claveMd, $rol, $estado ,$foto);

            
        }
        else{
            echo '<script> 
            swal.fire({
                icon: "error",
                title: "No pueden haber campos vacios ",
                text: "Por favor completa todos los campos",
                confirmButtonText: "OK"
            }).then(function() {
                window.location = "../views/administrador/registrar-usuario.php";
            });</script>';
            // echo "<script>location.href='../views/administrador/registrar-usuario.php'</script>";
        }


?>

