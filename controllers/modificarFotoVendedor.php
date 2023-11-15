<?php
    require_once("../models/conexion.php");
    require_once("../models/consultas.php");



    $id = $_POST['identificacion'];

    $foto= "../Uploads/Usuarios/".$_FILES['foto']['name'];
    $resultado = move_uploaded_file($_FILES['foto']['tmp_name'], $foto);


    $objConsultas = new Consultas();
    $result = $objConsultas -> actualizarFotoVendedor($id, $foto);

?>