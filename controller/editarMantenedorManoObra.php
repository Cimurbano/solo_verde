<?php
    require('../model/consultas.php');
    session_start();

    if(count($_POST) > 0){
        $row = '';

        $folioMO = $_POST['folioMO'];
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $especialidad = $_POST['especialidad'];
        $um = $_POST['um'];
        $cantidad = $_POST['cantidad'];
        $pb = $_POST['pb'];

        $row = editarMantenedorManoObra($folioMO,$nombre,$codigo,$especialidad,$um,$cantidad,$pb);

        if($row != "Error" )
        {
            echo "OK";

        }
        else{
            echo "Sin datos";
        }
    }
    else{
        echo "Sin datos";
    }
?>