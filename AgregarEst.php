<?php
include ("config/bd.php");
session_start();
$codcur = $_SESSION['Cod_Cursos'];
include("template/Cabecera.php");
?>
<div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
                <div class="col-md-6"><br><br>
                    <div class="card border-dark mb-3">
                        <div class="card-header p-3 mb-2 bg-dark text-white">
                            Agregar Estudiante
                        </div>
                        
                        <div class="card-body">
                
                        <form method="POST" action="Agregar1.php">
                            <div class = "form-gruop">
                                <select name="agregarestudiante" id="agregarestudiante">
                                    <option>--Selecione el estudiante--</option>
                                        <?php
                                            $consulCur="SELECT cod_est, nomb_est FROM estudiantes where cod_est not in (select cod_est from inscripciones where cod_cur='$codcur') ";
                                            $consulRes=pg_query($consulCur);
                                            while($valores = pg_fetch_array($consulRes)){
                                                echo '<option value="'.$valores['cod_est'].'">'.$valores['cod_est'].'   '.$valores['nomb_est'].'</option>';
                                            }
                                        ?>
                                    </select>
                            </div>
                            <br><button type="submit" value="Registrar" class="btn btn-dark">Registrar</button>
                        </form>
                    </div>  
                </div>
                <a href="EdiNota.php"><button id="cancelar" class="btn btn-dark">Cancelar</button></a>
            </div>
        </div>
    </div>
<?php

include("template/Pie.php");

?>