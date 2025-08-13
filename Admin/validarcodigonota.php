<?php
    include("config/bd.php"); 
    session_start();

    $CodigoNota = $_GET['id'];
    $_SESSION['codigonota'] = $CodigoNota;
    
    header("location:InscribirNota.php");
?>