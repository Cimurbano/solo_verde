<?php
    require('../model/consultas.php');
    session_start();

    if(count($_POST) > 0){
        $row = '';

        $idVehiculo = $_POST['idVehiculo'];
        $patente = $_POST['patente'];
        $kilometraje = $_POST['kilometraje'];
        $ano = $_POST['ano'];
        $tipoVehiculo = $_POST['tipoVehiculo'];
        $vin = $_POST['vin'];
        $color = $_POST['color'];
        $propiedad = $_POST['propiedad'];
        $empresa = $_POST['empresa'];
        $inicio   = $_POST['inicio'];
        $termino = $_POST['termino'];
        $monto = $_POST['monto'];
        $bodega = $_POST['bodega'];
        $aseguradora = $_POST['aseguradora'];
        $montoAseguradora = $_POST['montoAseguradora'];
        $manto = $_POST['manto'];
        $estado = $_POST['estado'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $tipoMonto = $_POST['tipoMonto'];
        $nMotor = $_POST['nMotor'];
        $operacion = $_POST['operacion'];
        $litros = $_POST['litros'];
        $comuna = $_POST['comuna'];
        $patenteOriginal = $_POST['patenteOriginal'];
        $kilometrajeRecorrer = $_POST['kilometrajeRecorrer'];
        $numContrato = $_POST['numContrato'];

        $row = editarPatente($idVehiculo, $patente, $kilometraje,
        $ano, $tipoVehiculo, $vin, $color, $propiedad, $empresa, $inicio, $termino,
        $monto, $bodega, $aseguradora, $montoAseguradora, $manto, $estado, $marca, $modelo, $tipoMonto, $operacion, $nMotor, $litros, $comuna, $patenteOriginal, $kilometrajeRecorrer, $numContrato);

        $v = consultaPatenteEspecifica($patente);
    		$estadoVeh = $v[0]['IDPATENTE_ESTADO'];
    		$tipoVeh = $v[0]['IDPATENTE_TIPOVEHICULO'];
    		$propiedad = $v[0]['IDPATENTE_PROPIEDAD'];
    		$marcaModelo = $v[0]['IDPATENTE_MARCAMODELO'];
    		$proveedor = $v[0]['IDPATENTE_PROVEEDOR'];
    		$bodega = $v[0]['IDSUCURSAL'];
    		$estructOperac = $v[0]['IDESTRUCTURA_OPERACION'];
    		$aseguradora = $v[0]['IDPATENTE_ASEGURADORA'];
    		$subcontratista = $v[0]['IDSUBCONTRATISTAS'];
    		$kilometraje = $v[0]['KILOMETRAJE'];
    		$ano = $v[0]['AÑO'];
    		$vin = $v[0]['VIN'];
    		$color = $v[0]['IDPATENTE_COLOR'];
    		$fInicio = $v[0]['FINICIO'];
    		$fTermino = $v[0]['FTERMINO'];
    		$tipoMonto = $v[0]['TIPOMONTO'];
    		$monto = $v[0]['MONTO'];
    		$montoAseg = $v[0]['MONTO_ASEGURADORA'];
    		$fMantto = $v[0]['FMANTENIMIENTO'];
        $operacion = $v[0]['OPERACION'];
        $nMotor = $v[0]['NRO_MOTOR'];
    		$patenteOriginal = $v[0]['PATENTE_ORIGINAL'];
        $litros = $v[0]['LITROS_ESTANQUE'];

        $v1 = consultaPatenteHistorial($patente);
        $estadoControl = $v1[0]['ESTADO_CONTROL'];
    		$estadoRrhh = $v1[0]['ESTADO_PERSONAL'];
    		$personalAsig = $v1[0]['PERSONAL'];
    		$rutAsig = $v1[0]['DNI'];
        $mensaje = "Se editó el Vehiculo";
        $frealizada = "";
    		$fcaducidad = "";
    		$frealizadaCir = "";
    		$fcaducidadCir = "";
        $docPDFRev1 = "";
        $docPDFCir1 = "";
        $docPDFAsegur1 = "";
        $docPDFOtrosVh1 = "";

        ingresaLogVehiculo($patente, $estadoVeh, $estadoControl, $estadoRrhh, $tipoVeh, $propiedad, $marcaModelo, $proveedor, $personalAsig,
        $rutAsig, $bodega, $estructOperac, $aseguradora, $subcontratista, $kilometraje, $ano, $vin, $color, $fInicio, $fTermino,
        $tipoMonto, $monto, $montoAseg, $fMantto, $docPDFRev1, $frealizada, $fcaducidad, $docPDFCir1, $frealizadaCir, $fcaducidadCir, $docPDFAsegur1,
        $docPDFOtrosVh1, $mensaje, $_SESSION['rutUser'], $operacion, $nMotor, $patenteOriginal, $litros);

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
