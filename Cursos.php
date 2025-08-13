<?php
include("config/bd.php"); 
session_start();

$Cod_docente= $_SESSION['Codigo'];


include("template/Cabecera.php");
?>
    <body>
        <div id="Cabecera">
            <div id="logousuario"><img src="css/usuario.png" id="loguitousuario"></div>
        <a id="Profesor"> PROFESOR: <br><?php echo $_SESSION['Nombre']; ?></a>
        <a href="template/Cerrar_S.php"><button id="cerrar" class="btn btn-dark"> Cerrar sesion</button></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md- 5"><br><br>
                    <form method="POST" action="ValiCursos.php" enctype="multipart/form-data">
                        <div class="card border-dark mb-3">
                            <div class="card-header p-3 mb-2 bg-dark text-white">
                              Cursos de Docente
                            </div>
                                <!-- Selecctor de cursos -->
                                <div class="card-body">
                                    <div class = "form-gruop">
                                    <label>Cursos</label>
                                    <select name="Cursos" id="Cusos">
                                        <?php
                                            $consulCur="SELECT * FROM cursos WHERE cod_doc='$Cod_docente' ";
                                            $consulRes=pg_query($consulCur);
                                            while($valores = pg_fetch_array($consulRes)){
                                                echo '<option value="'.$valores['cod_cur'].'">'.$valores['nomb_cur'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>    
                    
                                <div class="form-group">
                                    <label for="txtAño"><br>Año:</label>
                                    <!-- Selecctor de años -->
                                    <SELECT name="año" id="año">
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Periodo:</label></br>
                                    <!-- Selecctor de periodo -->
                                    <input type="radio" name="Periodo-I"  id="radioPeriodo" value="1"> Periodo I</br>
                                    <input type="radio" name="Periodo-I" id="radioPeriodo" value="2"> Periodo II
                                </div>
                                
                                <button type="submit" value="Editar_estudiantes" class="btn btn-dark">Ver Lista de Estudiantes</button>
                                
                            </div>
                        </div>
                    </form>
                    <!--<div class="btn-group" role="group" aria-label="">
                                    <button type="submit" name="action" value="Editar_notas" class="btn btn-primary">Editar Notas</button>
                                    
                                    <button type="Reset" name="action" value="limpiar" class="btn btn-primary" >limpiar</button>
                    </div>-->
                </div>
           </div>
        </div>
<?php include("template/Pie.php");?>
