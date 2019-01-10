<?php
class indexController {

	public $valor;
	public $tradu;

	public function __construct(){
		include_once("model/indexModel.php");
		include_once('inc/googletranslate.php');$this->tradu = new GoogleTranslate();
	}

	public function index(){
		include('view/_header.php');
		if(ifaut()){
			include('view/index_interno.php');
		}else{
			include('view/index_index.php');
		}
		include('view/_footer.php');
	}

	public function idioma(){
		if($this->valor==1){$_SESSION['JC_Idioma']='esco';}else{$_SESSION['JC_Idioma']='enus';}
		header("Location: ".PATO);
	}

	public function captcha(){
		$_SESSION["string"]=substr(md5(rand()),0,5);$captcha=imagecreatetruecolor(130,40);$color=rand(128,160);
		$background_color = imagecolorallocate($captcha, $color, $color, $color);
		imagefill($captcha, 0, 0, $background_color);
		$string = $_SESSION["string"];
		$font = '../fonts/arial.ttf';
		for($i=0;$i<5;$i++){
			$color = rand(0, 32);
			if(file_exists($font)){
				$x=4+$i*23+rand(0,8);$y = rand(25,30);
				imagettftext($captcha, 21, rand(-25, 25), $x, $y, imagecolorallocate($captcha, $color, $color, $color), $font, $string[$i]);
			}else{
				$x=5+$i*24+rand(0,6);$y=rand(1,18);
				imagestring($captcha, 30, $x, $y, $string[$i], imagecolorallocate($captcha, $color, $color, $color));
			}
		}
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-type: image/gif");
		imagejpeg($captcha);
	}

	public function googletraductorexample(){
		$texto = "hello";
		echo $sale = $this->tradu->translate('en','es',$texto);
	}

	public function testtime(){
		echo date('Y-m-d H:i:s',1497649294);
	}

	public function validadrupal741($clave='Jrd52743.',$resultado='$S$DpLSiVUq7w.EkhAxhW2TUNNhSW/Bc/cDbBt3ozxu0JZ9NYDDm.Jc'){
		//$clave='Jrd52743.';
		//$resultado='$S$DpLSiVUq7w.EkhAxhW2TUNNhSW/Bc/cDbBt3ozxu0JZ9NYDDm.Jc';
		$cadenita=substr($resultado,4,8);$count=32768;
		$hash=hash('sha512',$cadenita.$clave,TRUE);
		do{$hash=hash('sha512',$hash.$clave,TRUE);}while(--$count);
		$output=substr('$S$D'.$cadenita.$this->pa64enc($hash,strlen($hash)),0,55);
		//echo $output.' == '.$resultado;
		//exit;
		return ($output==$resultado);
	}

	public function pa64enc($input, $count) {
		$output='';$i=0;$itoa64='./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		do{
			$value=ord($input[$i++]);$output .= $itoa64[$value & 0x3f];
			if($i < $count){$value |= ord($input[$i]) << 8;}
			$output .= $itoa64[($value >> 6) & 0x3f];
			if($i++ >= $count){break;}
			if($i < $count){$value |= ord($input[$i]) << 16;}
			$output .= $itoa64[($value >> 12) & 0x3f];
			if($i++ >= $count){break;}
			$output .= $itoa64[($value >> 18) & 0x3f];
		}while($i < $count);return $output;
	}


}
