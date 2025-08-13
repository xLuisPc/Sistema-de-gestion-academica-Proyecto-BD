<?php
include("config/bd.php"); 
session_start();

$_SESSION['Cod_Cursos'] = $_POST['Cursos'];
$_SESSION['Año'] = $_POST['año'];
$_SESSION['Periodo'] = $_POST['Periodo-I'];

header("location:EdiNota.php");
?>