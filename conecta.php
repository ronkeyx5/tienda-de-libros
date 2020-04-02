<?php
define ("HOST",'localhost');
define ("BD",'minzon');
define ("USER_BD",'root');
define ("PASS_BD",'');

function conecta(){
    if(!($con = mysqli_connect(HOST,USER_BD,PASS_BD)))   {
        echo "Error conectando al Servidor de BD";
        exit();
    }
    if(!mysqli_select_db($con, BD))   {
        echo "Error seleccionando BD";
        exit();
    }
    return $con;
}
?>