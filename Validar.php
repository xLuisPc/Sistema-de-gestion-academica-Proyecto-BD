<script src="main.js"></script>
<?php
include_once("config/bd.php");
session_start();

$usuario = $_POST ['Usuario'];
$password = $_POST['Contraseña'];

$consulta = "SELECT * FROM docentes WHERE correo='$usuario' and clave='$password'";
$resultado=pg_query($consulta);
$prueba=pg_fetch_object($resultado);
$filas=pg_num_rows($resultado);

if($filas>0){
    $_SESSION['Nombre'] = $prueba->nomb_doc;
    $_SESSION['Codigo'] = $prueba->cod_doc;
    header("location:Cursos.php");
}
else {
      
include("index.php");
echo '<script>Incorrecto()</script>';

}
?>
