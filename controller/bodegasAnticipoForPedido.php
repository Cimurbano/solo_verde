<?php
	header('Access-Control-Allow-Origin: *');
	require('../model/consultas.php');
	session_start();

	if(count($_POST) > 0){
		$id = $_POST['id'];

		$row = bodegasAnticipoForPedido($id);

		if(is_array($row)){
			echo $row['BODEGA'];
		}
		else{
			echo "Sin datos";
		}
}
else{
	echo "Sin datos";
}
?>
