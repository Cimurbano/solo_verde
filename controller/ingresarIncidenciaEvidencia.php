<?php
  // //ini_set('display_errors', 'On');
  date_default_timezone_set('America/Santiago');
  require('../model/consultas.php');
  session_start();

  if(count($_POST) > 0){
    $idIncidencia = $_POST['idIncidencia'];
    $file = $_FILES['file'];

    $medidasimagen = getimagesize($file['tmp_name']);
    $image = $file['tmp_name'];
    $imageSize = $file['size'];

    if($medidasimagen[0] > 0 || $file['size'] > 100000){
      // echo "foto1<br>";
      $nombrearchivo = $file['name'];
      $rtOriginal = $file['tmp_name'];
      if($file['type'] =='image/jpeg'){
        $original = imagecreatefromjpeg($rtOriginal);
      }
      else if($file['type'] =='image/png'){
        $original = imagecreatefrompng($rtOriginal);
      }
      list($ancho , $alto) = getimagesize($rtOriginal);
      $max_ancho = 600;
      $max_alto = 800;
      $x_ratio = $max_ancho / $ancho;
      $y_ratio = $max_alto / $alto;
      if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
          $ancho_final = $ancho;
          $alto_final = $alto;
      }
      elseif (($x_ratio * $alto) < $max_alto){
          $alto_final = ceil($x_ratio * $alto);
          $ancho_final = $max_ancho;
      }
      else{
          $ancho_final = ceil($y_ratio * $ancho);
          $alto_final = $max_alto;
      }
      $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
      imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
      $hotpink = imagecolorallocate($image, 255, 110, 221);
      $lienzo2 = imagerotate($lienzo, 0, $hotpink);
      if($file['type'] =='image/jpeg'){
        // echo "jpg<br>";
        imagejpeg($lienzo2,$file['tmp_name']);
      }
      else if($file['type'] =='image/png'){
        // echo "png<br>";
        imagepng($lienzo2,$file['tmp_name']);
      }
      $image = $file['tmp_name'];
      $imageSize = $file['size'];
    }

    // $imgContenido = addslashes(file_get_contents($image));

    $img = '';
    if ($file['type'] =='image/jpeg') {
      $img = $idIncidencia . '_' . $random = md5(rand()) . '.jpg';
    } else if ($file['type'] =='image/png') {
      $img = $idIncidencia . '_' . $random = md5(rand()) . '.png';
    } else {
      $img = $idIncidencia . '_' . $random = md5(rand()) . '.png';
    }
    $ruta = str_replace("generaPDF", "", getcwd());
    move_uploaded_file($image, $ruta . '/repositorio/incidencia/img/' . $img);

    $row = '';
    if(file_exists($ruta . '/repositorio/incidencia/img/' . $img)){ //Linux
      $row = ingresarIncidenciaFoto($idIncidencia, $img);
    } else {
      echo "No se generó el archivo";
    }

    if ($row != "Error" ) {
      $results = array(
        "sEcho" => 1,
        "iTotalRecords" => $idIncidencia,
        "iTotalDisplayRecords" => $img,
        "aaData"=>[]
      );
      echo json_encode($results);
    } else {
      echo "Sin datos";
    }
  } else{
    echo "Sin datos Img";
  }
?>
