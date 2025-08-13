<?php
include ("config/bd.php");

session_start();
$nomb_n = $_POST['Nomb_nota'];
$Porcen_n = $_POST['Porcentaje'];
$codigonota = rand(0,99);
$codcur = $_SESSION['Cod_Cursos'];
$año = $_SESSION['Año'];
$periodo = $_SESSION['Periodo'];

$porcentotal="SELECT porcentaje from notas where cod_cur='$codcur' and year='$año' and periodo='$periodo'";
$resporcento=pg_query($porcentotal);
$totalpocen= $Porcen_n;
while($row = pg_fetch_array($resporcento)){
$totalpocen = $totalpocen + $row['porcentaje'];
}
if($totalpocen<=100){    
    $insert_nota = "INSERT INTO notas VALUES ('$codigonota','$Porcen_n','$nomb_n','$año','$periodo','$codcur')";
    $insertnota= pg_query($insert_nota);
    
    if($insertnota){
        header('location:EdiNota.php');
    } else {
        ?> No se realizo el procedimiento <?php
    }
} else {
    include("EdiNota.php");
    
}

?>
