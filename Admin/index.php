<?php
session_start();
if(isset($_SESSION['Nombre'])){
    header('location:Cursos.php');
}

include("template/Cabecera.php");

?>
<body>
    <div id="Cabecera">
    <div id="logo1"><img src="css/logo.png" id="loguito"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
                <div class="col-md-4"><br><br>
                    <div class="card border-dark mb-3">
                        <div class="card-header p-3 mb-2 bg-dark text-white">
                            Inicio de sesion
                        </div>
                        
                        <div class="card-body">
                
                        <form method="POST" action="Validar.php">
                            <div class = "form-gruop">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="Usuario" placeholder="Nombre de usuario"> 
                            </div>

                            <div class="form-group">
                                <br>
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="Contraseña" placeholder="Contraseña">
                                <br><br>
                            </div>
                                
                            <button id=entrar type="submit" value="Entrar" class="btn btn-dark">Entrar</button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("template/Pie.php");?>
<script src="./nodos/sweetalert/dist/sweetalert2.all.min.js"></script>
