<?php
  // ini_set('display_errors', 'On');
  date_default_timezone_set("America/Santiago");
  $ruta = str_replace("controller", "", getcwd()) . '/';

  $_SERVER['DB_HOST'] = 'GfD5FyT5IaW/yfUvHs0leg==';
  $_SERVER['DB_USER'] = 'DF918ru9PmuGsp1Num4j9Q==';
  $_SERVER['DB_PASS'] = 'JSciPp8ebWHm/6RcO4gfioauF+no7qcox395gz/gK7c=';
  $_SERVER['DB_CLAVE_EC'] = 'As233@sZ&eibhQZ#mIkV';

  require($ruta . 'model/consultas.php');

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  $hora = date("Y-m-d H:i:s");
  $rut = $_SERVER['argv'][1];
  $email = $_SERVER['argv'][2];
  $ceco = $_SERVER['argv'][3];
  $fechaIni = $_SERVER['argv'][4];
  $fechaFin = $_SERVER['argv'][5];
  if ($ceco ==-1){
      $nombreDoc = '_Rexmas_' . $fechaIni . '_' . $fechaFin . "_" . $rut . '_' . $hora . ".csv";
      $nombreDoc2 = '_Rexmas_UTF8_' . $fechaIni . '_' . $fechaFin . "_" . $rut . '_' . $hora . ".csv";
  }
  else{
    $nombreDoc = '_Rexmas_' . $fechaIni . '_' . $fechaFin ."_". $ceco . "_" . $rut . '_' . $hora . ".csv";
    $nombreDoc2 = '_Rexmas_UTF8_' . $fechaIni . '_' . $fechaFin ."_". $ceco . "_" . $rut . '_' . $hora . ".csv";
}

  $delimiter = ";";
  $he50 = $_SERVER['argv'][6];
  $he100 = $_SERVER['argv'][7];
  $atraso = $_SERVER['argv'][8];

  $logFile = fopen($ruta . "/controller/repositorio/temp/HE_Rexmas_" . $fechaIni . '_' . $fechaFin ."_". $ceco . "_" . $rut . '_' . $hora . "_log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n".date("Y-m-d H:i:s")." ============= Inicio proceso =============") or die("Error escribiendo en el archivo");
  fclose($logFile);

  // HE50
  if($he50 == "1"){
    $row = cosultaInformeRexmasHE50($ceco,$fechaIni,$fechaFin);

    $report = fopen($ruta . "controller/repositorio/temp/HE50" . $nombreDoc, 'a');

    $lineData = array('Plantilla',	'Contrato',	'Concepto',	'Valor',	'Origen',	'Objeto',	'Periodo de Pago',	'Fecha de Inicio',	'Fecha de Termino',	'Institucion',	'Dato adicional',	'Comentario',	'Valor Por Defecto',	'Centro Costo',	'Accion');
    fputcsv($report, $lineData, $delimiter);

    for($i = 0; $i < count($row); $i++){
      $lineData = array($row[$i][0],$row[$i][1],$row[$i][2],str_replace(".",",",$row[$i][3]),$row[$i][4],$row[$i][5],$row[$i][6],$row[$i][7],$row[$i][8],$row[$i][9],$row[$i][10],$row[$i][11],$row[$i][12],$row[$i][13],$row[$i][14]);
      fputcsv($report, $lineData, $delimiter);
    }

    // fseek($report, 0);
    //
    // $data = file_get_contents($ruta . "controller/repositorio/temp/" . $nombreDoc);
    // $data = mb_convert_encoding($data, 'UTF-8', 'auto');
    // file_put_contents($ruta . "controller/repositorio/temp/" . $nombreDoc2, $data);

    fclose($report);
    // unlink($ruta . "controller/repositorio/temp/" . $nombreDoc);
  }
  // HE100
  if($he100 == "1"){
    $row = cosultaInformeRexmasHE100($ceco,$fechaIni,$fechaFin);

    $report = fopen($ruta . "controller/repositorio/temp/HE100" . $nombreDoc, 'a');

    $lineData = array('Plantilla',	'Contrato',	'Concepto',	'Valor',	'Origen',	'Objeto',	'Periodo de Pago',	'Fecha de Inicio',	'Fecha de Termino',	'Institucion',	'Dato adicional',	'Comentario',	'Valor Por Defecto',	'Centro Costo',	'Accion');
    fputcsv($report, $lineData, $delimiter);

    for($i = 0; $i < count($row); $i++){
      $lineData = array($row[$i][0],$row[$i][1],$row[$i][2],str_replace(".",",",$row[$i][3]),$row[$i][4],$row[$i][5],$row[$i][6],$row[$i][7],$row[$i][8],$row[$i][9],$row[$i][10],$row[$i][11],$row[$i][12],$row[$i][13],$row[$i][14]);
      fputcsv($report, $lineData, $delimiter);
    }

    // fseek($report, 0);
    //
    // $data = file_get_contents($ruta . "controller/repositorio/temp/" . $nombreDoc);
    // $data = mb_convert_encoding($data, 'UTF-8', 'auto');
    // file_put_contents($ruta . "controller/repositorio/temp/" . $nombreDoc2, $data);

    fclose($report);
    // unlink($ruta . "controller/repositorio/temp/" . $nombreDoc);
  }
  // ATRASO
  if($atraso == "1"){
    $row = cosultaInformeRexmasATRASO($ceco,$fechaIni,$fechaFin);

    $report = fopen($ruta . "controller/repositorio/temp/ATRASO" . $nombreDoc, 'a');

    $lineData = array('Plantilla',	'Contrato',	'Concepto',	'Valor',	'Origen',	'Objeto',	'Periodo de Pago',	'Fecha de Inicio',	'Fecha de Termino',	'Institucion',	'Dato adicional',	'Comentario',	'Valor Por Defecto',	'Centro Costo',	'Accion');
    fputcsv($report, $lineData, $delimiter);

    for($i = 0; $i < count($row); $i++){
      $lineData = array($row[$i][0],$row[$i][1],$row[$i][2],str_replace(".",",",$row[$i][3]),$row[$i][4],$row[$i][5],$row[$i][6],$row[$i][7],$row[$i][8],$row[$i][9],$row[$i][10],$row[$i][11],$row[$i][12],$row[$i][13],$row[$i][14]);
      fputcsv($report, $lineData, $delimiter);
    }

    // fseek($report, 0);
    //
    // $data = file_get_contents($ruta . "controller/repositorio/temp/" . $nombreDoc);
    // $data = mb_convert_encoding($data, 'UTF-8', 'auto');
    // file_put_contents($ruta . "controller/repositorio/temp/" . $nombreDoc2, $data);

    fclose($report);
    // unlink($ruta . "controller/repositorio/temp/" . $nombreDoc);
  }

  $logFile = fopen($ruta . "/controller/repositorio/temp/HE_Rexmas_" . $fechaIni . '_' . $fechaFin . "_" . $rut . '_' . $hora . "_log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n".date("Y-m-d H:i:s")." ============= Archivo generado =============") or die("Error escribiendo en el archivo");
  fclose($logFile);

  // Emvio de email
  $mail = new PHPMailer(); // defaults to using php "mail()"

  //Codificacion
  $mail->CharSet = 'UTF-8';

  //indico a la clase que use SMTP
  $mail->SMTPSecure = 'tls';
  $mail->Host = "mail.cimaurbano.cl"; // GMail
  $mail->Port = 587;
  $mail->IsSMTP(); // use SMTP
  $mail->SMTPAuth = true;
  //indico un usuario / clave de un usuario
  $mail->Username = "notificaciones@cimaurbano.cl";
  $mail->Password = "avJ8s8sCoG";

  $firma = "--
            <br />
            <img src='cid:firmaPng' alt='CIMAURBANO' style='width: 180px;' width='180px'>
            <br />
            Aportando calidad de vida en espacios urbanos
            <br />
            ..........................................................................................................................................................................
            <br>
            <br>
            AVISO LEGAL.
            <br>
            <font style='margin-top: 0; line-height: 15px;font-family: Arial;font-size:7.5pt; text-align: justify; width: 100%'>
            Este mensaje y sus documentos anexos pueden contener información confidencial o legalmente protegida. Está dirigido única y exclusivamente a la persona o entidad reseñada como destinatarios del mensaje. Si este mensaje le hubiera llegado por error, por favor elimínelo sin revisarlo ni reenviarlo y notifíquelo lo antes posible al remitente. Cualquier divulgación, copia o utilización de dicha información es contraria a la ley. Le agradecemos su colaboración.
            </font>
            <br>";

    $mail->AddEmbeddedImage($ruta . 'view/img/logo_home.png', 'firmaPng', 'firmaPng.png');

    if($he50 == "1"){
      $mail->AddAttachment($ruta . "controller/repositorio/temp/HE50" . $nombreDoc, "HE50" . $nombreDoc);
    }
    if($he100 == "1"){
      $mail->AddAttachment($ruta . "controller/repositorio/temp/HE100" . $nombreDoc, "HE100" . $nombreDoc);
    }
    if($atraso == "1"){
      $mail->AddAttachment($ruta . "controller/repositorio/temp/ATRASO" . $nombreDoc, "ATRASO" . $nombreDoc);
    }

    $body = "<p><em><span style='color:rgb(165, 165, 165)'><u>Solo Verde - Favor no responder este e-mail</u></span></em></p><br>
            <div style='width: 100%; text-align: justify; margin: 0 auto;'>
    <font style='font-size: 14px;'>
    Estimado,
    <br />
    <br />
    Adjuntamos informes de horas extras y atrasos rexmas según solicitud en portal Solo Verde.<br />
    <br />
    </font>
    <div'>
        <font style='font-size: 14px;'>
            Saludos cordiales.
        </font>
        <br />
        <br />
        " . $firma . "
    </div>
    ";

    $mail->SetFrom('notificaciones@cimaurbano.cl', "Notificaciones");

    //defino la dirección de email de "reply", a la que responder los mensajes
    //Obs: es bueno dejar la misma dirección que el From, para no caer en spam
    $mail->AddReplyTo('notificaciones@cimaurbano.cl', "Notificaciones");
    //Defino la dirección de correo a la que se envía el mensaje

    $mail->AddAddress($email, $email);

    $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $fecha = strtotime('+0 day');
    $fecha = $dias[date('w', $fecha)]." ".date('d', $fecha)." de ".$meses[date('n', $fecha)-1]. " ".date('Y', $fecha) . " a las " . date('h:i:s A', $fecha);

    $mail->Subject = "Horas extras y atrasos archivo rexmas " . $fecha . "";

    //Puedo definir un cuerpo alternativo del mensaje, que contenga solo texto
    $mail->AltBody = "Horas extras y atrasos archivo rexmas " . $fecha . "";

    //inserto el texto del mensaje en formato HTML
    $mail->MsgHTML($body);

    //envío el mensaje, comprobando si se envió correctamente
    if($mail->Send()) {
      echo "Ok";
      $logFile = fopen($ruta . "/controller/repositorio/temp/HE_Rexmas_" . $fechaIni . '_' . $fechaFin . "_" . $rut . '_' . $hora . "_log.txt", 'a') or die("Error creando archivo");
      fwrite($logFile, "\n".date("Y-m-d H:i:s")." ============= Email enviado =============") or die("Error escribiendo en el archivo");
      fclose($logFile);
    }
    else{
      echo $mail->ErrorInfo;
      //echo "Sin datos";
    }
?>
