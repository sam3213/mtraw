<?php

    session_start();

    if(!isset($_SESSION['AUTENTICADO'])){

        echo '<script> alert("Por favor inicie sesion") </script>';
        echo "<script>location.href='../Cliensite/login.html'</script>";
    }

    if($_SESSION['rol'] !="Cliente"){
        echo '<script> alert("No tiene los permisos necesarios para la interfaz") </script>';
        echo '<script>window.history.back();</script>';
    }



?>