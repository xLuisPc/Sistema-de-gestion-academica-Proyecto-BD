<?php
    include ("config/bd.php");
    session_start();

    $NNomb_nota = $_POST['Nomb_nota'];
    $NPorcentaje = $_POST['Porcentaje'];
    $id= $_SESSION['Codigo_nota'];
                  
    $EditaNota = "UPDATE notas SET nomb_nota = '$NNomb_nota', porcentaje = $NPorcentaje WHERE notas.cod_nota = $id";
    $ResEdi = pg_query($EditaNota);

    if($ResEdi){
        header('location:EdiNota.php');
    } else {
        ?> no se puede hacer nada <?php
    }


?>