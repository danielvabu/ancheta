<?php
// Necesita db y config
function __($a){
	/*  //Posible funcion de traducion de textos
		include_once('inc/googletranslate.php');
		$tradu = new GoogleTranslate();
		$a = $tradu->translate('en','es',$a);
	*/
	return $a;
}
function mayus($t){
	$t = strtoupper($t);
	$letras1 = array("á", "é", "í", "ó", "ú", "ñ", "à", "è", "ì", "ò", "ù");
	$letras2 = array("Á", "É", "Í", "Ó", "Ù", "Ñ", "Á", "É", "Í", "Ó", "Ù");
	$t = str_replace($letras1, $letras2, $t);
	return $t;
}
function urlliza($cadena){
	$cadena=str_replace(' ','-',trim(ucwords(strtolower($cadena))));
	return normaliza($cadena);
}
function normaliza($cadena){
	//if(!is_unicode($cadena))$cadena=utf8_encode($cadena);
	$cadena=str_replace(array('á','à','ä','â','ª','Á','À','Â','Ä'),array('a','a','a','a','a','a','a','a','a'),$cadena);
	$cadena=str_replace(array('é','è','ë','ê','É','È','Ê','Ë'),array('e','e','e','e','e','e','e','e'),$cadena);
	$cadena=str_replace(array('í','ì','ï','î','Í','Ì','Ï','Î'),array('i','i','i','i','i','i','i','i'),$cadena);
	$cadena=str_replace(array('ó','ò','ö','ô','Ó','Ò','Ö','Ô'),array('o','o','o','o','o','o','o','o'),$cadena);
	$cadena=str_replace(array('ú','ù','ü','û','Ú','Ù','Û','Ü'),array('u','u','u','u','u','u','u','u'),$cadena);
	$cadena=str_replace(array('ñ','Ñ','ç','Ç'),array('n','n','c','c'),$cadena);
	$cadena=str_replace(array('$',',','.',';'),array('','','',''),$cadena);
	return $cadena;
}
function edad($fecha){
	list($Y,$m,$d) = explode("-",$fecha);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
function limpia($var){ // Limpia Strings
	$malo = array("\\",";","\"","\'","'");$var = str_replace($malo,"",strip_tags(trim($var)));
	return $var;
}
function limpia2($arr){ // Limpia Arrays
	$ya=0;$arr2=array();while(!$ya){$arr2[key($arr)]=limpia(current($arr));next($arr);if(!key($arr))$ya=1;}return $arr2;
}
function limpia3($arr){
	$ya=0;$arr2=array();while(!$ya){$arr2[key($arr)]=limpia(normaliza(urldecode(current($arr))));next($arr);if(!key($arr))$ya=1;}return $arr2;
}
function txtmes($a){
	if($a==1)$e='Enero';if($a==2)$e='Febrero';if($a==3)$e='Marzo';if($a==4)$e='Abril';if($a==5)$e='Mayo';if($a==6)$e='Junio';
	if($a==7)$e='Julio';if($a==8)$e='Agosto';if($a==9)$e='Septiembre';if($a==10)$e='Octubre';if($a==11)$e='Noviembre';if($a==12)$e='Diciembre';
	return $e;
}
function ffecha($a){
	$dia = substr($a,8,2);
	$mes = substr($a,5,2);
	$ano = substr($a,0,4);
	return $dia." de ".txtmes($mes)." de ".$ano;
}
function iok(){return '<img src="'.PATU.'img/ok2.png" border="0" class="ijc" /> ';}
function ierror(){return '<img src="'.PATU.'img/error2.png" border="0" class="ijc" /> ';}
function iadmira(){return '<img src="'.PATU.'img/admiracion2.png" border="0" class="ijc" /> ';}
function iinterro(){return '<img src="'.PATU.'img/interrogacion2.png" border="0" class="ijc" /> ';}
function veraut($a=1){
	if(!isset($_SESSION['JC_UserID']) || $_SESSION['JC_UserID']<1 || $_SESSION['JC_Grupo']!=PERFIL){
		if($a==2){echo "<script>window.location.reload();</script>";exit;}else{header("Location: ".PATO);exit;}
	}
}
function ifaut(){
	if(isset($_SESSION['JC_UserID']) && $_SESSION['JC_UserID']>0 && $_SESSION['JC_Grupo']==PERFIL){return true;}else{return false;}
}
function isImage($tempFile){
	$size = getimagesize($tempFile);if(isset($size) && $size[0] && $size[1] && $size[0] * $size[1] > 0){return true;}else{return false;}
}
function imgresize($src,$dst,$width,$height,$crop=0){
  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type";$type = strtolower(substr(strrchr($src,"."),1));
  if($type == 'jpeg') $type = 'jpg';
  switch($type){
    case 'bmp': $img = imagecreatefromwbmp($src); break;
    case 'gif': $img = imagecreatefromgif($src); break;
    case 'jpg': $img = imagecreatefromjpeg($src); break;
    case 'png': $img = imagecreatefrompng($src); break;
    default : return "Unsupported picture type!";
  }
  if($crop){
    if($w < $width or $h < $height) return false;
    $ratio=max($width/$w,$height/$h);$h=$height/$ratio;$x=($w-$width/$ratio)/2;$w=$width/$ratio;
  }else{
    if($w < $width and $h < $height) return false;
    $ratio = min($width/$w, $height/$h);$width=$w*$ratio;$height=$h*$ratio;$x=0;
  }
  $new = imagecreatetruecolor($width, $height);
  if($type == "gif" or $type == "png"){
    imagecolortransparent($new,imagecolorallocatealpha($new,0,0,0,127));imagealphablending($new,false);imagesavealpha($new,true);
  }
  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
  switch($type){
    case 'bmp': imagewbmp($new, $dst); break;
    case 'gif': imagegif($new, $dst); break;
    case 'jpg': imagejpeg($new, $dst); break;
    case 'png': imagepng($new, $dst); break;
  }
  return true;
}
function imggps(){
	if ( !empty($exif['GPSLongitude']) && !empty($exif['GPSLatitude']) ) {
		$d = (float) $exif['GPSLongitude'][0];
		$m = exif_float($exif['GPSLongitude'][1] );
		$s = exif_float( $exif['GPSLongitude'][2] );
		 
		$gps_longitude = (float) $d + $m/60 + $s/3600;
		if ( $exif['GPSLongitudeRef'] == 'W')
			$gps_longitude = -$gps_longitude;
		 
		$d = $exif['GPSLatitude'][0];
		$m = exif_float($exif['GPSLatitude'][1] );
		$s = exif_float( $exif['GPSLatitude'][2] );
		 
		$gps_latitude = (float) $d + $m/60 + $s/3600;
		if ( $exif['GPSLatitudeRef'] == 'S')
			$gps_latitude = -$gps_latitude;
	}
}
function stripAttributes($s, $allowedattr = array()) {
	if (preg_match_all("/<[^>]*\\s([^>]*)\\/*>/msiU", $s, $res, PREG_SET_ORDER)){
		foreach ($res as $r){
			$tag = $r[0];
			$attrs = array();
			preg_match_all("/\\s.*=(['\"]).*\\1/msiU", " " . $r[1], $split, PREG_SET_ORDER);
			foreach($split as $spl){$attrs[]=$spl[0];}
			$newattrs = array();
			foreach($attrs as $a){
				$tmp = explode("=", $a);
				if (trim($a) != "" && (!isset($tmp[1]) || (trim($tmp[0]) != "" && !in_array(strtolower(trim($tmp[0])), $allowedattr)))){}else{$newattrs[]=$a;}
			}
			$attrs = implode(" ", $newattrs);
			$rpl = str_replace($r[1], $attrs, $tag);
			$s = str_replace($tag, $rpl, $s);
		}
	}
	return $s;
}
?>
