<?php
include ("config/bd.php");

$EnvioD = $_GET['id'];

$EliminarNota="DELETE from notas where Cod_nota='$EnvioD'";
$ResEliNota=pg_query($EliminarNota);

    if($EliminarNota){
        header('location:EdiNota.php');
    } else {
        ?> no se realizo la eliminacion <?php
    }


?>

