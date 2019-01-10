<?php
class indexController extends baseControl {

	public $valor;
	public $pro;
	public $entra;

	public function __construct(){
		include_once("model/indexModel.php");
		include_once("model/entradaModel.php");$this->entra = new entradaModel();
	}

	public function index(){
		if(isset($_COOKIE['email']) && $_COOKIE['email']!='' && !isset($_SESSION['JC_UserID'])){
			$llave = crypt($_COOKIE['id'].'~'.FIRMA.'~'.$_COOKIE['email'], 'rl');
			if($_COOKIE['carpeta']=='personas'){
				if($_COOKIE['llave']==$llave){
					$rs = $this->entra->verificacookie($_COOKIE['id'],$_COOKIE['email']);
					if(!$rs->EOF){
						$_SESSION['JC_UserID'] = $rs->fields['id'];
						$_SESSION['JC_Nombre'] = $rs->fields['nombre'];
						$_SESSION['JC_Email'] = $rs->fields['email'];
						$_SESSION['JC_Grupo'] = "personas";
						$_SESSION['JC_Estado'] = $rs->fields['estado'];
						$llave = crypt($_SESSION['JC_UserID'].'~'.FIRMA.'~'.$_SESSION['JC_Email'], 'rl');
						setcookie("id", $_SESSION['JC_UserID'], time()+60*60*24*15, PATO);
						setcookie("email", $_SESSION['JC_Email'], time()+60*60*24*15, PATO);
						setcookie("carpeta", 'personas', time()+60*60*24*15, PATO);
						setcookie("llave", $llave, time()+60*60*24*15, PATO);
						header("Location: ".PATO);
					}
				}
			}
			if($_COOKIE['carpeta']=='consultores'){header("Location: ".PATO."consultores/");exit;}
		}
		$timestamp = time();
		$unique_salt = md5(FIRMA.$timestamp);
		include_once("model/departamentosModel.php");$departamentoobj = new departamentosModel();
		$departamentos = $departamentoobj->listar();
		include('view/_header.php');
		if(ifaut()){include('view/index_interno.php');}else{include('view/index_index.php');}
		include('view/_footer.php');
	}

	public function idioma(){
		if($this->valor==1){$_SESSION['JC_Idioma']='esco';}else{$_SESSION['JC_Idioma']='enus';}
		header("Location: ".PATO);
	}

	public function captcha(){
		$_SESSION["string"] = substr(md5(rand()), 0, 5);
		$captcha = imagecreatetruecolor(130, 40);
		$color = rand(128, 160);
		$background_color = imagecolorallocate($captcha, $color, $color, $color);
		imagefill($captcha, 0, 0, $background_color);
		$string = $_SESSION["string"];
		$font = 'fonts/arial.ttf';
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

	public function codebar(){
		$alto=40;	// alto
		$rrr=1;		// resolucion 1 2 3
		$fff=2;		// fuente 0 -5
		//$a1='';	// Checksum 1 empty
		//$a2='';	// npi
		define('IN_CB',true);
		require('admin/inc/barcodegenerator/index.php');
		require('admin/inc/barcodegenerator/FColor.php');
		require('admin/inc/barcodegenerator/BarCode.php');
		require('admin/inc/barcodegenerator/FDrawing.php');
		if(include('admin/inc/barcodegenerator/code39.barcode.php')){
			$color_black = new FColor(0,0,0);
			$color_white = new FColor(255,255,255);
			//if(!empty($a2)) $code_generated = new code39($alto,$color_black,$color_white,$rrr,$codigo,$fff,$a1,$a2);
			//elseif(!empty($a1)) $code_generated = new code39($alto,$color_black,$color_white,$rrr,$codigo,$fff,$a1);else
			$code_generated = new code39($alto,$color_black,$color_white,$rrr,$this->valor[0],$fff);
			$drawing = new FDrawing(1024,1024,'',$color_white);
			$drawing->init();
			$drawing->add_barcode($code_generated);
			$drawing->draw_all();
			$im = $drawing->get_im();
			$im2 = imagecreate($code_generated->lastX,$code_generated->lastY);
			imagecopyresized($im2,$im,0,0,0,0,$code_generated->lastX,$code_generated->lastY,$code_generated->lastX,$code_generated->lastY);
			$drawing->set_im($im2);
			$drawing->finish(1);
		}
	}

	public function imprimir(){
		include_once("../MPDF571/mpdf.php");
		$url=MIURL.PATO.'mails/alta/javier/principal/colcable/';
		$html = file_get_contents($url);
		$nombre_archivo = 'archivo.pdf';
		$mpdf=new mPDF('c', 'Letter');
		$mpdf->SetTopMargin(10);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output($nombre_archivo,'I');
		exit;
	}

	public function excel(){
		require_once 'admin/inc/phpexcel/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Javier Cruz")
							 ->setLastModifiedBy("Javier Cruz")
							 ->setTitle("titulito")
							 ->setSubject("asuntico")
							 ->setDescription("descripcioncita.")
							 ->setKeywords("palabritas clave")
							 ->setCategory("categoriita");
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hola')
            ->setCellValue('B1', 'Parcero')
            ->setCellValue('C1', 'en')
            ->setCellValue('D1', 'la');
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Letras raras')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
		$objPHPExcel->getActiveSheet()->setTitle('Pruebando');
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="pruebandofile.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}


}

