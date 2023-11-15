<?php

    require_once("../models/conexion.php");
    require_once("../models/consultas.php");
    
    $idCita=$_POST['idcita'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];

    if (strlen($fecha)>0 && strlen($hora)>0 ){
        
        $objConsultas = new Consultas();
        $result = $objConsultas -> MostrarCitasReagendar($idCita, $fecha, $hora);
    }else{

        echo "<script> 
            swal.fire({
                icon: 'error',
                title: 'No pueden haber campos vacios',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = '../views/Vendedor/VerCitas.php';
            });</script>";

        
    }

?>