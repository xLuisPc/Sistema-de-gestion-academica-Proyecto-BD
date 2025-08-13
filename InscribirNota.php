<?php
    include("config/bd.php"); 
    session_start();

    $CodigoNota = $_SESSION['codigonota'];
    $año = $_SESSION ['Año'];
    $perio = $_SESSION['Periodo'];
    $curso=$_SESSION['Cod_Cursos'];

include ("template/Cabecera.php");
?>

<body>
    <a href="EdiNota.php" class="btn btn-dark">Terminar</a>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div>
                    <a>Descripción: </a>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $consulEst="SELECT e.cod_est, e.nomb_est, e.ape_est, c.valor_nota, c.cod_cal from estudiantes e, calificaciones c where c.cod_est=e.cod_est and c.cod_cur='$curso' and  c.year='$año' and c.periodo='$perio' and c.cod_nota='$CodigoNota'";
                            $consulEstu=pg_query($consulEst);
                            while($fila=pg_fetch_array($consulEstu)){
                        ?>
                            <tr>
                                <td><?php echo $fila['cod_est']; ?></td>
                                <td><?php echo $fila['nomb_est']; ?></td>
                                <td><?php echo $fila['ape_est']; ?></td>
                                <td>
                                    <form method="POST" action="ValidarInsNota.php">
                                        
                                        <!--<input type="hidden" name="Nombreestudiante" value="<?php echo $fila['nomb_est']; ?>">-->
                                        <input type="hidden" name="Codigoestudiante" value="<?php echo $fila['cod_est']; ?>">
                                        <input type="number" class="form-control" name="Nota" placeholder="<?php echo $fila['valor_nota']; ?>" Value="<?php echo $fila['valor_nota']; ?> " onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode==46)" step=".1"min="0" max="5"required autocomplete="off">
                                        <button type="submit" value="<?php echo $fila['cod_cal'];?>" name="codigocalificacion" class="btn btn-dark">Insertar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include("template/Pie.php");
?>
