<?php
session_start();

require "conecta.php";
$con = conecta();

$check = $_POST["check"];
echo $check;

/* ############################# */
/* ARCHIVO */
if ($check) {
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
        copy($file_tmp, $dir . $fileName1);
        echo "YES";
    }


    /* ############################ */
    /* DATOS SQL */

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $id = $_POST['id'];

    $archivo = $file_name;
    $archivo_n = $file_enc;

    $sql = "UPDATE administradores SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol', archivo='$archivo', archivo_n='$archivo_n' WHERE id='$id'";
    $res = mysqli_query($con, $sql);
    echo "Finish with pic";

    if($_SESSION['id']==$id)    {
        $_SESSION['nombre'] = $nombre;
    }
}
else{
    /* ############################ */
    /* DATOS SQL */

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $id = $_POST['id'];

    $sql = "UPDATE administradores SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol' WHERE id='$id'";
    $res = mysqli_query($con, $sql);
    echo "Finish no pic";
    if($_SESSION['id']==$id)    {
        $_SESSION['nombre'] = $nombre;
    }
}