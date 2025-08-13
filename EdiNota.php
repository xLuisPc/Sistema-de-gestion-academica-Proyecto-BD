<?php 
    session_start();
    include("config/bd.php"); 
    
    $curso=$_SESSION['Cod_Cursos'];
    $año=$_SESSION['Año'];
    $Periodo=$_SESSION['Periodo'];
    $Cod_docente= $_SESSION['Codigo'];

    include("template/Cabecera.php");      
?>
<body>
    <div>
        <a href="Cursos.php"><button class="btn btn-dark">Volver a Cursos</button></a>
    </div></br>
    <!-- Codigo 1: estudiantes en el curso + agregar estudiante-->
    <div class="container">
        <a href="AgregarEst.php"  class="btn btn-dark"><button class="btn btn-dark">Agregar Estudiante</button></a>
        <div class="row">
            <div class="col-md-12">
                <table class="table" class="table table-bordered" name="EstudiantesCursos">
                    <thead class="thead-dark">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $consulEst="SELECT i.cod_est, e.nomb_est, e.ape_est from inscripciones i, estudiantes e where i.cod_est=e.cod_est and cod_cur='$curso' and year='$año' and periodo='$Periodo'";
                            $consulEstu=pg_query($consulEst);
                            while($fila=pg_fetch_array($consulEstu)){
                        ?>
                        <tr>
                            <td><?php echo $fila['cod_est']; ?></td>
                            <td><?php echo $fila['nomb_est']; ?></td>
                            <td><?php echo $fila['ape_est']; ?></td>
                            <td>
                                <a href="EliminarEst.php?id=<?php echo $fila['cod_est'];?>"><button class="btn btn-dark">Eliminar</button></a>
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
    <!--Codigo 2:notas de los estudiantes -->
    <div class="container"> 
        <div class="row">
            <div>            
            </div>
        </div>
        <div class="row">  
            <div><br><br>
                <div class="card border-dark mb-3">
                    <div class="card-header p-3 mb-2 bg-dark text-white">
                        Agregar Nota
                    </div>
                    <div class="card-body">
                        <form method="POST" action="AgregarNota.php">
                            <div class = "form-gruop">
                                <label>Nombre de la nota: </label>
                                <input type="text" class="form-control" name="Nomb_nota"> 
                            </div>
                            <div class = "form-gruop">
                                <label>Porcentaje de la nota</label>
                                <input type="text" class="form-control" name="Porcentaje"> 
                            </div>
                            <div>
                                <br><button type="submit" name="AgregarN" value="Agregar Nota" class="btn btn-dark">Agregar Nota</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div></br></br>
            <div class="col-md-7">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Descripcion</th>
                            <th>Porcentaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $consulNota="SELECT Cod_nota, Nomb_nota, Porcentaje from notas where Cod_cur= '$curso'";
                            $consulNot=pg_query($consulNota);
                            while($fila=pg_fetch_array($consulNot)){
                        ?>
                        <tr>
                            <td><?php echo $fila['nomb_nota']; ?></td>
                            <td><?php echo $fila['porcentaje']; ?></td>
                            <td>
                                <a href="EditarNota.php?id=<?php echo $fila['cod_nota']; ?>"> <button class="btn btn-dark">Editar Nota</button></a>
                                <a href="BorrarNota.php?id=<?php echo $fila['cod_nota']; ?>"> <button class="btn btn-dark">Borrar Nota</button></a>
                                <a href="validarcodigonota.php?id=<?php echo $fila['cod_nota']; ?>"><button class="btn btn-dark">Registrar Nota</button></a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>     
            <div class="cod-md-">
            <a href="Tabla_final.php"><button class="btn btn-dark">Reporte de notas</button></a>
        </div>
    </div>       
    </div>



    <?php
include("template/Pie.php");
?>
