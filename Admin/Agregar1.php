<?php
    include ("config/bd.php");
    session_start();
    $cod_cur = $_SESSION['Cod_Cursos'];
    $año = $_SESSION['Año'];
    $peri = $_SESSION ['Periodo'];
    $cod_est = $_POST['agregarestudiante'];

    $insertar = "INSERT INTO inscripciones VALUES ('$cod_cur', '$cod_est', '$año', '$peri')";
    $insert = pg_query($insertar);

    $consu= "SELECT *  FROM  notas WHERE cod_cur='$cod_cur' and year='$año' and periodo='$peri' ";
    $rescon=pg_num_rows(pg_query($consu));

    if($rescon !=0){
        pg_query("insert into calificaciones (cod_cur, cod_est, year, periodo, cod_nota) select '$cod_cur','$cod_est','$año','$peri', cod_nota from notas where year='$año' and periodo='$peri' and cod_cur='$cod_cur'");
    }
    

    if($insert){
        header('location:EdiNota.php');
    } else {
        ?> No se realizo el procedimiento <?php
    }

?>