<?php

    include("config/bd.php");
    session_start();
    $Cod_docente = $_SESSION['Codigo'];

    $anoCurso = $_SESSION['Año'];
    $perio = $_SESSION['Periodo'];
    $codCurso = $_SESSION['Cod_Cursos'];

    include("template/Cabecera.php");
?>
    <table id="tablaDefinitivas" class="table table-bordered table-responsive">
            <!-- cabecera de la definitiva -->
            <thead class="table-dark text-center">
                <?php 
                $notasPorce = "SELECT * FROM notas WHERE cod_cur='$codCurso' ";
                $resnotasporce = pg_query($notasPorce);
                $notasPorce2 = "SELECT * FROM notas WHERE cod_cur='$codCurso' ";
                $resnotasporce2 = pg_query($notasPorce2);
                ?>
                <tr class="text-center">
                    <th scope="col" class="text-center"></th>
                    <?php
                    /* Muestra las descripciones de las notas en una fila */
                    while ($obj = pg_fetch_object($resnotasporce)) { ?>
                        <th scope="col" class="text-center"><?php echo $obj->nomb_nota;  ?></th>
                    <?php
                    }
                    ?>
                    <th scope="col" class="text-center">Definitivas</th>
                </tr>
                <tr>
                    <th scope="col" class="text-center">Codigo</th>
                    <?php
                    /* muestra los porcentajes de las notas  */
                    while ($obj = pg_fetch_object($resnotasporce2)) { ?>
                        <th scope="col" class="text-center"><?php echo $obj->porcentaje . '%'; ?></th>
                    <?php
                    }
                    /* Se muestra la suma de los procentajes de todas las notas */
                    $consultaDefinitivaTotal = "SELECT sum(porcentaje) AS suma FROM notas WHERE cod_cur='$codCurso'";
                    $resconsuldefinitotal = pg_query($consultaDefinitivaTotal);
                    $definitivaTotal = pg_fetch_object($resconsuldefinitotal)->suma;
                    ?>
                    <th scope="col" class="text-center"><?php echo $definitivaTotal . '%'; ?></th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php
                /*Consulta de todos los inscritos en el curso*/ 
                $consulta = pg_query($conect,"SELECT * FROM inscripciones WHERE year='$anoCurso' and periodo=$perio and cod_cur=$codCurso order by cod_est");
                while ($resultadoLis = pg_fetch_object($consulta)) {
                    
                    /* Se calcula la definitiva de cada estudiante */
                    $calculoDefinitiva = "SELECT sum((c.valor_nota*(n.porcentaje/100))) AS defi FROM calificaciones c, notas n WHERE c.cod_nota=n.cod_nota AND c.cod_est=$resultadoLis->cod_est AND c.year='$anoCurso' AND c.periodo=$perio AND c.cod_cur=$codCurso";
                    $rescalculodefinitiva = pg_query ($calculoDefinitiva);
                    /* Se obtiene el resultado de la consulta */
                    $defValor = pg_fetch_object($rescalculodefinitiva)->defi;
                ?>
                    <tr class="text-center text">
                        <!-- Muestra el codigo del estudiante -->
                        <td><?php echo $resultadoLis->cod_est; ?></td>
                        <?php
                        /* Consulta que trae las notas de los estudiantes */
                        $listValores = pg_query($conect, "SELECT c.valor_nota FROM calificaciones c, notas n WHERE c.cod_nota=n.cod_nota AND c.cod_est=$resultadoLis->cod_est AND c.year='$anoCurso' AND c.periodo=$perio AND c.cod_cur=$codCurso");

                        /* Muestra las notas de los estudiantes */
                        while ($resultadoVal = pg_fetch_object($listValores)) { ?>
                            <td><?php echo $resultadoVal->valor_nota; ?></td>
                        <?php
                        }
                        ?>
                        <!-- Muestra la definitiva de cada estudiante -->
                        <td><?php echo $defValor; ?></td>   
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="EdiNota.php"><button id="cancelar" class="btn btn-dark">Volver a Lista de estudiantes</button></a>
        <?php
    include("template/Cabecera.php");
    ?>