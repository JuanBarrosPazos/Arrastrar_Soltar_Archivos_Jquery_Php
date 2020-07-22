<?php 
//include_once("db_connect.php");
if(!empty($_FILES)){  

  ////////////////////           **********         ////////////////////

      // PARAMETROS INICIALES VALIDACION
      global $extension;
      $extension = substr($_FILES["file"]["name"],-4);
      $extension = strtolower($extension);
      global $ext;
      $ext = str_replace(".","",$extension);


      // EL ARRAY DE VALIDACION HA DE CONICIDIR CON acceptedFiles: EN DROPZONE.JS
      // PUEDO LIMITAR LA VALIDACION EN LOS DOS ARCHIVOS PERO DROPZONE NO PASARÁ ERROR
      global $ext_ok;
      $ext_ok = array('.jpg','.png','jpeg','.avi','.mkv','.mp4','.pdf');
      global $ext_file;
      $ext_file = in_array($extension, $ext_ok);

// 0 CUALQUIER EXTENSION PERMITIDA
if ($ext_file) {

    global $upload_dir;
    $upload_dir = "uploads/";
    global $fileName;
    $fileName = $_FILES['file']['name'];
    $fileName = str_replace(" ","_",$fileName);
    global $uploaded_file;
    $uploaded_file = $upload_dir.$fileName;

  ////////////////////           **********         ////////////////////

  // SOLAMENTE SI ES UNA IMAGEN

  global $ext_img;
  $ext_imgok = array('.jpg','.png','jpeg');
  global $ext_imgok;
  $ext_img = in_array($extension, $ext_imgok);

  if($ext_img){

    copy($_FILES['file']['tmp_name'], "temp/ini.".$ext);   
     
    global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['file']['tmp_name']);

    // SE PERMITEN IMAGENES MENORES DE 900 X 900
    global $anchomax;
    $anchomax = 900;
    global $altomax;
    $altomax = 900;

    if($ancho > $anchomax){   

      global $ext;
      global $uploaded_file;
      global $anchomax;
      global $ancho;
      global $anchodif;
      $anchodif = ($ancho - $anchomax);
      global $porcent;
      $porcent = round((($anchodif * 100)/$ancho),2);
      //echo " % ".$porcent;
      global $anchonew;
      $anchonew = ($ancho - $anchodif);
      //echo " New Width: ".$anchonew;
      global $altonew;
      $altonew = ($alto - (($alto * $porcent)/100));
      $altonew = round($altonew,0);

      // SE RECORTA EL ANCHO DE LA IMAGEN
      if(($ext == 'jpg')||($ext == 'jpeg')||($ext == '')){
        $img= imagecreatefromjpeg("temp/ini.".$ext);
      }elseif($ext == 'png'){ $img= imagecreatefrompng("temp/ini.".$ext); }
            $dst = ImageCreateTrueColor($anchonew, $altonew);
            imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);
        if(($ext == 'jpg')||($ext == 'jpeg')||($ext == '')){
                imagejpeg($dst, $uploaded_file);
              }
        elseif($ext == 'png'){ imagepng($dst, $uploaded_file);
        }else{ }

    } // FIN RECORTA EL ANCHO

    elseif($alto > $altomax){ 

      global $ext;
      global $uploaded_file; 
      global $altomax;
      global $alto;     
      global $altodif;
      $altodif = ($alto - $altomax);
      global $porcent;
      $porcent = round((($altodif * 100)/$alto),2);
      global $altonew;
      $altonew = ($alto - $altodif);
  
      global $anchonew;
      $anchonew = ($ancho - (($ancho * $porcent)/100));
      $anchonew = round($anchonew,0);
  
      // SE RECORTA EL ALTO DE LA IMAGEN
      if(($ext == 'jpg')||($ext == 'jpeg')||($ext == '')){
        $img= imagecreatefromjpeg("temp/ini.".$ext);
      }elseif($ext == 'png'){ $img= imagecreatefrompng("temp/ini.".$ext); }
            $dst = ImageCreateTrueColor($anchonew, $altonew);
            imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);
        if(($ext == 'jpg')||($ext == 'jpeg')||($ext == '')){
                imagejpeg($dst, $uploaded_file);
              }
        elseif($ext == 'png'){ imagepng($dst, $uploaded_file);
        }else{ }

    }

    // FIN SI NO SE REDUCE LA IMAGEN
    else {  global $uploaded_file;
            move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file);} 

  } // FIN SOLO SI ES UNA IMAGEN

  // CUALQUIER OTRO ARCHIVO PERMITIDO
  else{ global $uploaded_file;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_file);} 

  ////////////////////           **********         ////////////////////


  } // 0 FIN CUALQUIER EXTENSIÓN PERMITIDA

  ////////////////////           **********         ////////////////////

} // FIN EMPTY $_FILES
