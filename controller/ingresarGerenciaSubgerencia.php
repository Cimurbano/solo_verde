<?php
    require('../model/consultas.php');
    session_start();

    if(count($_POST) > 0){
        $row = '';
        $rutUser = $_SESSION['rutUser'];

        $gerencia = $_POST['gerencia'];
        $subGerencia = $_POST['subGerencia'];
        $idGerente = $_POST['idGerente'];
        $idSubgerente = $_POST['idSubgerente'];

        $row = ingresarGerenciaSubgerencia($gerencia, $subGerencia, $idGerente, $idSubgerente, $rutUser);

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
