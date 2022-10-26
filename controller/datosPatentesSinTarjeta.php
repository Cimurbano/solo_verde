<?php
    //ini_set('display_errors', 'ON');
    require('../model/consultas.php');
    session_start();

	if(count($_POST) == 0){
        $row = '';


        $row = consultaPatentesSinTarjeta();

        if(is_array($row))
        {
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($row),
                "iTotalDisplayRecords" => count($row),
                "aaData"=>$row
            );
            echo json_encode($results);
        }
        else{
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => 0,
                "iTotalDisplayRecords" => 0,
                "aaData"=>[]
            );
            echo json_encode($results);
        }
	}
	else{
		echo "Sin datos";
	}
?>
