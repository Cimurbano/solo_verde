<?php
    require('../model/consultas.php');
    session_start();

    if(count($_POST) > 0){
        $row = '';

        $rutIngreso = $_POST['rutIngreso'];
        $mombreIngreso = $_POST['nombreIngreso'];
        $monedaIngreso = $_POST['monedaIngreso'];
        $direccionIngreso = $_POST['direccionIngreso'];
        $comunaIngreso = $_POST['comunaIngreso'];
        $telefonoIngreso = $_POST['telefonoIngreso'];

        $row = ingresaAseguradora($rutIngreso, $mombreIngreso, $monedaIngreso, $direccionIngreso,
        $comunaIngreso, $telefonoIngreso);

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