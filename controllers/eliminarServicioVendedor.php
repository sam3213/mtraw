<?php

require_once("../models/conexion.php");
require_once("../models/consultas.php");
//aterrizar variable que enviamos atraves del metodo get desde el boton de la tabla
$id = $_GET['id'];

$objconsultas = new Consultas();
$result = $objconsultas->eliminarServicioVendedor($id);

?>