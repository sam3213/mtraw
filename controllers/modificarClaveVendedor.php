<?php
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");

    $identificacion = $_POST['identificacion'];
    $clave =$_POST['clave'];
    $clave2 =$_POST['clave2'];

    if($clave == $clave2){

        $clavemd = md5($clave);

        $objConsultas = new Consultas();
        $result = $objConsultas -> actualizarClaveVendedor($identificacion, $clavemd);

    }else{

        echo "<script> 
            swal.fire({
                icon: 'error',
                title: 'Las claves no coinciden',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = '../views/Vendedor/perfil.php?id=$identificacion';
            });</script>";

        
    }


?>