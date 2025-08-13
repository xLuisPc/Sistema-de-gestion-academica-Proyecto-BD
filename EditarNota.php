<?php
    include ("config/bd.php");
    session_start();

    $_SESSION['Codigo_nota'] = $_GET['id'];

    include("template/Cabecera.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
                <div class="col-md-6"><br><br>
                    <div class="card border-dark mb-3">
                        <div class="card-header p-3 mb-2 bg-dark text-white">
                            Editar nota
                        </div>
                        
                        <div class="card-body">
                
                        <form method="POST" action="EditarNota1.php">
                            <div class = "form-gruop">
                                <label>Nombre de la nota</label>
                                <input type="text" class="form-control" name="Nomb_nota"> 
                            </div>
                            <div class = "form-gruop">
                                <label>Porcentaje de la nota</label>
                                <input type="text" class="form-control" name="Porcentaje"> <br>
                            </div>                            
                            <button type="submit" value="Registrar" class="btn btn-dark">Actualizar</button> 
                        </form>
                    </div>
                </div>
                <a href="EdiNota.php"><button id ="cancelar2" class="btn btn-dark">Cancelar</button></a>
            </div>
        </div>
    </div>
    <?php
    include('Template/Pie.php');
?>