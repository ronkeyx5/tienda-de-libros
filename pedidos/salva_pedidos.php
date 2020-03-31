<?php
require "../conecta.php";
$con = conecta();

/* ############################# */
/* ARCHIVO */

$file_name = $_FILES['archivo']['name'];           //Nombre real del archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];       //Nombre temporal
$cadena    = explode(".", $file_name);             //Separa el nombre
$ext       = $cadena[1];                            //Extension
$dir       = "archivos\\";                          //Directorio de guardado
$file_enc  = md5_file($file_tmp);                  //Nombre del encriptacion


echo "file_name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";

if ($file_name != '') {
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);
}

/* ############################ */
/* DATOS SQL */

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$stock = $_POST['stock'];

$archivo = $file_name;
$archivo_n = $file_enc;

$sql = "INSERT INTO productos VALUES (0, '$nombre', '$codigo', '$descripcion', $costo, $stock, '$archivo_n', '$archivo', 1, 0)";
$res = mysqli_query($con, $sql);

echo "<br> $nombre $codigo -- $archivo";

//header("Location: lista_administradores.php");
?>