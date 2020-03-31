<?php
$file_name = $_FILES['archivo']['name'];           //Nombre real del archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];       //Nombre temporal
$cadena    = explode(".", $file_name);             //Separa el nombre
$ext       = $cadena[1];                           //Extension
$dir       = "archivos/";                          //Directorio de guardado
$file_enc  = md5_file($file_tmp);                  //Nombre del encriptacion


echo "file_name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";

if ($file_name != '') {
    $fileName1 = "$file_enc.$ext";
    @copy($file_tmp, $dir.$fileName1);
}
?>