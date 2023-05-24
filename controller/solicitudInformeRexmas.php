<?php
  // ini_set('display_errors', 'On');
	date_default_timezone_set('America/Santiago');
  session_start();

  require('../model/consultas.php');

  $ruta = str_replace("controller", "", getcwd());

  $rutUser = $_SESSION['rutUser'];
  $row = chequeaUsuarioEmail($rutUser);
  $ceco = $_POST['ceco'];
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
	$tipo = $_POST['tipo'];

	if($tipo == "faltas"){
		exec('php -f ' . $ruta . 'controller/generaInformeRexmas.php ' . $rutUser . ' ' . $row['EMAIL'] . ' ' . $ceco . ' ' . $fechaInicio . ' ' . $fechaFin . ' > /dev/null 2>&1 &');
	}
	else if($tipo == "heAtrasos"){
		$he50 = $_POST['he50'];
		$he100 = $_POST['he100'];
		$atraso = $_POST['atraso'];

		exec('php -f ' . $ruta . 'controller/generaInformeRexmasHE.php ' . $rutUser . ' ' . $row['EMAIL'] . ' ' . $ceco . ' ' . $fechaInicio . ' ' . $fechaFin . ' ' . $he50 . ' ' . $he100 . ' ' . $atraso . ' > /dev/null 2>&1 &');
	}
	else if($tipo == "general"){
		// $output = array(); // Variable para almacenar la salida del comando
		// $returnValue = 0; // Variable para almacenar el valor de retorno del comando

		// exec('php -f ' . $ruta . 'controller/generaInformeRexmasGeneral.php ' . $rutUser . ' ' . $row['EMAIL'] . ' ' . $ceco . ' ' . $fechaInicio . ' ' . $fechaFin, $output, $returnValue);

		// echo 'php -f ' . $ruta . 'controller/generaInformeRexmasGeneral.php ' . $rutUser . ' ' . $row['EMAIL'] . ' ' . $ceco . ' ' . $fechaInicio . ' ' . $fechaFin;
		//
		// var_dump($output);
		// var_dump($returnValue);
		//
		// foreach ($output as $line) {
		//     echo $line . "<br>";
		// }

		exec('php -f ' . $ruta . 'controller/generaInformeRexmasGeneral.php ' . $rutUser . ' ' . $row['EMAIL'] . ' ' . $ceco . ' ' . $fechaInicio . ' ' . $fechaFin . ' > /dev/null 2>&1 &');
	}
	echo "Ok";
?>
