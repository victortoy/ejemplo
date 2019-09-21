<?php
require_once "$_POST[objeto].php";
$objeto = new $_POST['objeto']();

$metodo = $_POST['metodo'];

$respuesta = $objeto->$metodo($_POST['datos']);

echo json_encode($respuesta);