<?php
class installModel{

	public $db;
	public $dbs;
	public $tradu;
	public $singular;
	public $singula2;
	public $tbschem;
	public $tbtdsche;
	public $tbschem2;
	public $tbtdsche2;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
		$this->dbs = ADONewConnection(DB_TIPO);$this->dbs->debug = DB_DEBUG;
		$this->dbs->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_SCHEMAS);$this->dbs->SetFetchMode(ADODB_FETCH_ASSOC);
		include_once('inc/googletranslate.php');$this->tradu = new GoogleTranslate();
	}

	function __destruct() {$this->db->close();}

	public function tablas(){
		$result = $this->db->Execute("show tables");
		return $result; 			
	}

	public function campos($t){
		$result = $this->db->Execute("DESCRIBE ".$t);
		return $result; 			
	}

	public function describes($t,$c){
		$sql="SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$t."' and table_schema = '".DB_DB."' and column_name = '".$c."'";
		$result = $this->db->Execute($sql);
		return $result->fields['COLUMN_COMMENT']; 			
	}

	public function mkControl($t,$rrid,$rrna,$ff1,$ff2,$ff3){
		$otrmod=$otrinc='';
		$rrid=array_unique($rrid);
		$rrna=array_unique($rrna);
		$fin=count($rrna);
		if($fin){
			$ya=0;
			while(!$ya){
				$rrval=current($rrna);
				$rrrv=explode('_',$rrval);
				$otrmod.='
		include_once("model/'.$rrrv[0].'Model.php");';
				$otrinc.='
		$'.$rrrv[0].'obj = new '.$rrrv[0].'Model();$'.$rrrv[0].' = $'.$rrrv[0].'obj->listar();';
				next($rrna);
				if(!key($rrna))$ya=1;
			}
		}
		$cod = '<?php
class '.$t.'Controller extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		veraut();
		include_once("model/'.$t.'Model.php");$this->obj = new '.$t.'Model();'.$otrmod.'
	}

	public function index(){'.$otrinc.'
		if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		include("view/_header.php");
		include("view/'.$t.'_index.php");
		include("view/_footer.php");
	}

	public function ver(){
		$sale = $this->obj->ver($this->valor[0]);
		include("view/_header.php");
		include("view/'.$t.'_ver.php");
		include("view/_footer.php");
	}

	public function filtrar(){'.$otrinc.'
		if(count($_POST)>0){
			$llega = limpia2($_POST);
			$sale = $this->obj->filtrar($llega);$msg=0;
		}else{
			if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		}
		include("view/_header.php");
		include("view/'.$t.'_index.php");
		include("view/_footer.php");
	}

	public function agregar(){'.$otrinc.'
		include("view/_header.php");
		include("view/'.$t.'_agregar.php");
		include("view/_footer.php");
	}

	public function agregando(){
'.$ff1.'
		$entra = limpia2($_POST);
		$entra["creado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->agregando($entra);
'.$ff2.'
		$_SESSION["alertas"]=($ret)?iok().__("Se agrego la informacion"):ierror().__("Problema al agregar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function editar(){'.$otrinc.'
		$sale = $this->obj->editar($this->valor[0]);
		include("view/_header.php");
		include("view/'.$t.'_editar.php");
		include("view/_footer.php");
	}

	public function editando(){
'.$ff3.'
		$entra = limpia2($_POST);
		$entra["editado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se actualizo la informacion"):ierror().__("Problema al editar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function eliminar(){
		$ret = $this->obj->eliminar($this->valor[0]);
		$_SESSION["alertas"]=($ret)?iok().__("Se elimino correctamente"):ierror().__("Problema al eliminar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function activar(){
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=1;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Activo correctamente"):ierror().__("Problema al Activar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function desactivar(){
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=0;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Desactivo correctamente"):ierror().__("Problema al Desactivar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function descargar(){
		$rs = $this->obj->ver($this->valor[0]);
		header("Content-length: ".$rs->fields[$this->valor[1]."_size"]);
		header("Content-type: ".$rs->fields[$this->valor[1]."_type"]);
		header("Content-Disposition: attachment; filename=".$rs->fields[$this->valor[1]."_name"]);//inline
		echo $rs->fields[$this->valor[1]];exit;
	}


}

';
		$f=fopen('controller/'.$t.'Controller.php', "w+");
		fwrite($f,$cod);
		fclose($f);
	}

	public function mkControp($t,$rrid,$rrna,$ff1,$ff2,$ff3,$per){
		$otrmod=$otrinc='';
		$rrid=array_unique($rrid);
		$rrna=array_unique($rrna);
		$fin=count($rrna);
		if($fin){
			$ya=0;
			while(!$ya){
				$rrval=current($rrna);
				$rrrv=explode('_',$rrval);
				$otrmod.='
		include_once("model/'.$rrrv[0].'Model.php");';
				$otrinc.='
		$'.$rrrv[0].'obj = new '.$rrrv[0].'Mod();$'.$rrrv[0].' = $'.$rrrv[0].'obj->listar();';
				next($rrna);
				if(!key($rrna))$ya=1;
			}
		}
		$cod = '<?php
class '.$t.'Controller extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		veraut();
		include_once("model/'.$t.'Model.php");$this->obj = new '.$t.'Mod();'.$otrmod.'
	}

	public function index(){'.$otrinc.'
		if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		include("view/_header.php");
		include("view/'.$t.'_index.php");
		include("view/_footer.php");
	}

	public function ver(){
		$sale = $this->obj->ver($this->valor[0]);
		include("view/_header.php");
		include("view/'.$t.'_ver.php");
		include("view/_footer.php");
	}

	public function filtrar(){'.$otrinc.'
		if(count($_POST)>0){
			$llega = limpia2($_POST);
			$sale = $this->obj->filtrar($llega);$msg=0;
		}else{
			if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		}
		include("view/_header.php");
		include("view/'.$t.'_index.php");
		include("view/_footer.php");
	}

	public function agregar(){'.$otrinc.'
		include("view/_header.php");
		include("view/'.$t.'_agregar.php");
		include("view/_footer.php");
	}

	public function agregando(){
'.$ff1.'
		$entra = limpia2($_POST);
		$entra["creado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->agregando($entra);
'.$ff2.'
		$_SESSION["alertas"]=($ret)?iok().__("Se agrego la informacion"):ierror().__("Problema al agregar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function editar(){'.$otrinc.'
		$sale = $this->obj->editar($this->valor[0]);
		include("view/_header.php");
		include("view/'.$t.'_editar.php");
		include("view/_footer.php");
	}

	public function editando(){
'.$ff3.'
		$entra = limpia2($_POST);
		$entra["editado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se actualizo la informacion"):ierror().__("Problema al editar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function eliminar(){
		$ret = $this->obj->eliminar($this->valor[0]);
		$_SESSION["alertas"]=($ret)?iok().__("Se elimino correctamente"):ierror().__("Problema al eliminar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function activar(){
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=1;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Activo correctamente"):ierror().__("Problema al Activar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function desactivar(){
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=0;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Desactivo correctamente"):ierror().__("Problema al Desactivar");
		header("Location: ".PATO."'.$t.'/");exit;
	}

	public function descargar(){
		$rs = $this->obj->ver($this->valor[0]);
		header("Content-length: ".$rs->fields[$this->valor[1]."_size"]);
		header("Content-type: ".$rs->fields[$this->valor[1]."_type"]);
		header("Content-Disposition: attachment; filename=".$rs->fields[$this->valor[1]."_name"]);//inline
		echo $rs->fields[$this->valor[1]];exit;
	}


}

';
		$f=fopen($per.'/controller/'.$t.'Controller.php', "w+");fwrite($f,$cod);fclose($f);
	}

	public function file1k($n,$k){ // file info
		$cod='
		// si es muy viejo el navegador
		if(isset($_FILES["'.$n.'_file"]) && $_FILES["'.$n.'_file"]["size"] > 0){
			$entre'.$k.'["'.$n.'_file_name"]=$_FILES["'.$n.'_file"]["name"];
			$entre'.$k.'["'.$n.'_file_type"]=$_FILES["'.$n.'_file"]["type"];
			$entre'.$k.'["'.$n.'_file_size"]=$_FILES["'.$n.'_file"]["size"];
			$entre'.$k.'["'.$n.'_file"]=file_get_contents($_FILES["'.$n.'_file"]["tmp_name"]);
		}
		// si funciono con HTML5 y uploadify5
		if(isset($_POST["namefile"]) && $_POST["namefile"]!="" && file_exists(TEMP.$_POST["namefile"])){
			$file = TEMP.$_POST["namefile"];
			$entri'.$k.'["'.$n.'_file_name"]=str_replace($_POST["token"],"",$_POST["namefile"]);
			$entri'.$k.'["'.$n.'_file_type"]=$_POST["typefile"];
			$entri'.$k.'["'.$n.'_file_size"]=filesize($file);
			$entri'.$k.'["'.$n.'_file"]=file_get_contents($file);
			unlink($file);
		}
		unset($_POST["'.$n.'_file"]);
';
		return $cod;
	}

	public function file2k($n,$k){ // file edding
		$cod='
		if(isset($entre'.$k.'["'.$n.'_file_name"]) && $entre'.$k.'["'.$n.'_file_name"]!="")$this->obj->editando($ret,$entre'.$k.');
		if(isset($entri'.$k.'["'.$n.'_file_name"]) && $entri'.$k.'["'.$n.'_file_name"]!="")$this->obj->editando($ret,$entri'.$k.');

';
		return $cod;
	}

	public function file3k($n,$k){ // file edding
		$cod='
		// si es muy viejo el navegador
		if(isset($_FILES["'.$n.'_file"]) && $_FILES["'.$n.'_file"]["size"] > 0){
			$entre'.$k.'["'.$n.'_file_name"]=$_FILES["'.$n.'_file"]["name"];
			$entre'.$k.'["'.$n.'_file_type"]=$_FILES["'.$n.'_file"]["type"];
			$entre'.$k.'["'.$n.'_file_size"]=$_FILES["'.$n.'_file"]["size"];
			$entre'.$k.'["'.$n.'_file"]=file_get_contents($_FILES["'.$n.'_file"]["tmp_name"]);
			$this->obj->editando($this->valor[0],$entre'.$k.');
		}
		// si funciono con HTML5 y uploadify5
		if(isset($_POST["namefile"]) && $_POST["namefile"]!="" && file_exists(TEMP.$_POST["namefile"])){
			$file = TEMP.$_POST["namefile"];
			$entri'.$k.'["'.$n.'_file_name"]=str_replace($_POST["token"],"",$_POST["namefile"]);
			$entri'.$k.'["'.$n.'_file_type"]=$_POST["typefile"];
			$entri'.$k.'["'.$n.'_file_size"]=filesize($file);
			$entri'.$k.'["'.$n.'_file"]=file_get_contents($file);
			unlink($file);
			$this->obj->editando($this->valor[0],$entri'.$k.');
		}
		unset($_POST["'.$n.'_file"]);
';
		return $cod;
	}

	public function fsql($t,$name,$type){
		$cod='';
		$ayuda=substr($name,-10);
		$ayuda1=substr($name,-5);
		if($ayuda!='_file_name' && $ayuda!='_file_type' && $ayuda!='_file_size' && $ayuda1!='_file'){
			if(substr($type,0,6)=='bigint' || substr($type,0,9)=='mediumint' || substr($type,0,8)=='smallint' || substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod='		if(isset($llega["'.$name.'"]) && $llega["'.$name.'"]!=-1)
			$where.="'.$t.'.'.$name.' = ".$llega["'.$name.'"]." AND ";
';
				}else{
					$cod='		if(isset($llega["'.$name.'"]) && $llega["'.$name.'"]!=0 && $llega["'.$name.'"]!="")
			$where.="'.$t.'.'.$name.' = ".$llega["'.$name.'"]." AND ";
';
				}
			}else{
				$cod='		if(isset($llega["'.$name.'"]) && $llega["'.$name.'"]!="")
			$where.="'.$t.'.'.$name.' REGEXP \'".$llega["'.$name.'"]."\' AND ";
';
			}
		}
		return $cod.' ';
	}

	public function mkModel($t,$rrid,$rrna,$filtros){
		$selects=$lljj='';
		$fin=count($rrna);
		if($fin){
			$ya=0;
			while(!$ya){
				$rrval=current($rrna);
				$rrrv=explode('_',$rrval);
				//$rrivii=$rrrv[1];
				$rrrv[1] .= (isset($rrrv[2]))?'_'.$rrrv[2]:'';
				$rrrv[1] .= (isset($rrrv[3]))?'_'.$rrrv[3]:'';
				$rrrv[1] .= (isset($rrrv[4]))?'_'.$rrrv[4]:'';
				$rrrv[1] .= (isset($rrrv[5]))?'_'.$rrrv[5]:'';
				$rrrv[1] .= (isset($rrrv[6]))?'_'.$rrrv[6]:'';
				$rrrv[1] .= (isset($rrrv[7]))?'_'.$rrrv[7]:'';
				//$selects.=', '.$rrrv[0].'.'.$rrrv[1].' as '.key($rrna).'_'.$rrrv[1];
				$selects.=', '.$rrrv[0].'.'.$rrrv[1].' as '.$rrrv[0].'_'.$rrrv[1];
				$lljj.='LEFT JOIN '.$rrrv[0].' ON '.$t.'.'.key($rrna).'='.$rrrv[0].'.id
			';
				$filtros.='';
				next($rrna);
				if(!key($rrna))$ya=1;
			}
		}
		$cod = '<?php
class '.$t.'Model {

	public $db;

	function __construct() {
		$this->db = ADONewConnection(DB_TIPO);$this->db->debug = DB_DEBUG;
		$this->db->Connect(DB_SERVER,DB_USER,DB_CLAVE,DB_DB);$this->db->SetFetchMode(ADODB_FETCH_ASSOC);
	}

	function __destruct() {$this->db->close();}

	public function cantidad(){
		$sql="SELECT count('.$t.'.id) as son FROM '.$t.'";
		$son=$this->db->Execute($sql);
		return $son->fields["son"];
	}

	public function activos(){
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.'
			'.$lljj.'WHERE '.$t.'.estado=1";
		return $this->db->Execute($sql);
	}

	public function inactivos(){
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.'
			'.$lljj.'WHERE '.$t.'.estado=0";
		return $this->db->Execute($sql);
	}

	public function listar(){
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.'
			'.$lljj.'";
		return $this->db->Execute($sql);
	}

	public function ver($id){
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.' 
			'.$lljj.'WHERE '.$t.'.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function filtrar($llega){
		$where="";
'.$filtros.'
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.'
			'.$lljj.'
			WHERE ".$where." 1
			";
		return $this->db->Execute($sql);
	}

	public function agregando($entra){
		if($this->db->AutoExecute("'.$t.'",$entra,"INSERT")==false){return 0;}else{return $this->db->INSERT_ID();}
	}

	public function editar($id){
		$sql="
			SELECT '.$t.'.*'.$selects.'
			FROM '.$t.' 
			'.$lljj.'WHERE '.$t.'.id = ".$id;
		return $this->db->Execute($sql);
	}

	public function editando($id,$entra){
		if($this->db->AutoExecute("'.$t.'",$entra,"UPDATE","id=".$id)==false){return 0;}else{return $id;}
	}

	public function eliminar($id){
		return $this->db->Execute("DELETE FROM '.$t.' WHERE id=".$id);
	}


}

';
		$f=fopen('model/'.$t.'Model.php', "w+");
		fwrite($f,$cod);
		fclose($f);
	}

	public function mkModep($t,$rrid,$rrna,$filtros,$per){
		$cod = '<?php
include("../admin/model/'.$t.'Model.php");
class '.$t.'Mod extends '.$t.'Model {


}
';
		$f=fopen($per.'model/'.$t.'Model.php', "w+");fwrite($f,$cod);fclose($f);
	}

	public function mkModeu($t,$rrid,$rrna,$filtros,$per){
		$cod = '<?php
include("admin/model/'.$t.'Model.php");
class '.$t.'Mod extends '.$t.'Model {


}
';
		$f=fopen($per.'model/'.$t.'Model.php', "w+");fwrite($f,$cod);fclose($f);
	}

	public function campoform($t,$name,$type,$null,$key,$def,$ext){
		$sale='';
		$a3=substr($name,-3);
		$ch=($a3=='_id' || $name=="nombre" || $name=="email" || $name=="estado")?' checked="checked"':'';
		$ayuda=substr($name,-10);
		if($ayuda!='_file_name' && $ayuda!='_file_type' && $ayuda!='_file_size'){
			$sale .='<tr>
					<td><div style="height:20px;">'.$name;
			if($name!='id')$sale.=' <input type="text" name="singula2_'.$t.'_'.$name.'" value="'.$this->namea($name).'" data-toggle="tooltip" title="Singular" />';
			$sale.='</div>';
			if($name!='id'){
				$sale .='<div id="tdprop_'.$t.'_'.$name.'" class="tdscpropi_'.$t.'" data-campo="'.$name.'"></div>';
			}
			$sale .='</td>
					<td class="latpadcero"><input type="checkbox" name="i_'.$t.'_'.$name.'" id="i_'.$t.'_'.$name.'" value="1"'.$ch.' /></td>
					<td class="latpadcero"><input type="checkbox" name="v_'.$t.'_'.$name.'" id="v_'.$t.'_'.$name.'" value="1" checked="checked" /></td>
					<td class="latpadcero"><input type="checkbox" name="a_'.$t.'_'.$name.'" id="a_'.$t.'_'.$name.'" value="1"';
			$sale.=		($key!='PRI' && $name!='creado' && $name!='editado')?' checked="checked"':'';
			$sale.=			' /></td>
					<td class="latpadcero"><input type="checkbox" name="e_'.$t.'_'.$name.'" id="e_'.$t.'_'.$name.'" value="1"';
			$sale.=		($key!='PRI' && $name!='creado' && $name!='editado')?' checked="checked"':'';
			$sale.=			' /></td>
					<td class="latpadcero">';
			$sale.=		($key=='PRI')?'<input type="checkbox" name="d_'.$t.'_'.$name.'" id="d_'.$t.'_'.$name.'" value="1" checked="checked" />':'&nbsp;';
			$sale.=			'</td>
					<td class="latpadcero"><input type="checkbox" name="f_'.$t.'_'.$name.'" id="f_'.$t.'_'.$name.'" value="1"'.$ch.' /></td>
					<td>';
			if($key=='MUL' || $a3=='_id'){$sale.=$this->mkselid($t,$name);}else{if($name!='id'){$sale.=$this->mkschematyp2($t,$name);}}
			$sale.=	'</td>
					<td id="tdtxt'.$t.$name.'">&nbsp;</td>
					<td>';
			if(substr($type,0,7)=='tinyint'){
				$finname=substr($name,-4);
				$dese=$this->describes($t,$name);
				if($dese){
					$dese=explode(",",$dese);
					for($h=0;$h<count($dese);$h++){$hh=$h+1;
						$dise[$h]=explode(".",$dese[$h]);
						$sale.=$hh.'<input type="text" name="op'.$hh.'_'.$t.'_'.$name.'" id="op'.$hh.'_'.$t.'_'.$name.'" value="'.$dise[$h][1].'" /><br />';
					}
				}else{
					if($name!='estado' && $name!='sexo' && $finname!='sexo'){
						$sale.='
							<input type="text" name="op1_'.$t.'_'.$name.'" id="op1_'.$t.'_'.$name.'" value="" /><br />
							<input type="text" name="op2_'.$t.'_'.$name.'" id="op2_'.$t.'_'.$name.'" value="" /><br />
							<input type="text" name="op3_'.$t.'_'.$name.'" id="op3_'.$t.'_'.$name.'" value="" /><br />
							<input type="text" name="op4_'.$t.'_'.$name.'" id="op4_'.$t.'_'.$name.'" value="" /><br />
							<input type="text" name="op5_'.$t.'_'.$name.'" id="op5_'.$t.'_'.$name.'" value="" />
	';
					}
				}
				unset($dese);
			}else{$sale.='&nbsp;';}
			$sale.=		'</td>
				</tr>
';
		}
		return $sale;
	}

	public function mkselid($tt,$nn){
		$tablas = $this->tablas();
		if(!$tablas->EOF){
			$sale = '<select name="r_'.$tt.'_'.$nn.'" id="r_'.$tt.'_'.$nn.'" onchange="fnreltxt(this.value,\''.$tt.'\',\''.$nn.'\')">';
			$sale.= '<option value="">Seleccione la tabla.id</option>';
			while(!$tablas->EOF){
				$tb = $tablas->fields['Tables_in_'.DB_DB];
				if($tb!=$tt){
					$campos = $this->campos($tb);
					if(!$campos->EOF){
						while(!$campos->EOF){
							if($campos->fields['Key']=='PRI'){
								$sale.='<option value="'.$tb.'_'.$campos->fields['Field'].'">'.$tb.'.'.$campos->fields['Field'].'</option>';
							}
							$campos->MoveNext();
						}
					}
				}
				$tablas->MoveNext();
			}
			$sale.= '</select>';
		}
		return $sale;
	}

	public function mkseltxt($tt,$nn,$tt2){
		$tablas = $this->tablas();
		if(!$tablas->EOF){
			$sale = '<select name="r2_'.$tt.'_'.$nn.'" id="r2_'.$tt.'_'.$nn.'">';
			while(!$tablas->EOF){
				$tb = $tablas->fields['Tables_in_'.DB_DB];
				if($tb==$tt2){
					$campos = $this->campos($tb);
					if(!$campos->EOF){
						while(!$campos->EOF){
							$ayuda=substr($campos->fields['Field'],-10,5);
							$ayuda1=substr($campos->fields['Field'],-5);
							if($campos->fields['Key']=='' && $ayuda!='_file' && $ayuda1!='_file' && $campos->fields['Field']!='creado' && $campos->fields['Field']!='editado' && $campos->fields['Field']!='estado'){
								$sale.='<option value="'.$tb.'_'.$campos->fields['Field'].'">'.$tb.'.'.$campos->fields['Field'].'</option>';
							}
							$campos->MoveNext();
						}
					}
				}
				$tablas->MoveNext();
			}
			$sale.= '</select>';
		}
		return $sale;
	}

	public function mkschematype($tb='',$ord=1){
		$nord=($ord==1)?'2':'1';
		$hhtt='<button type="button" onclick="schemaidioma(\''.$tb.'\','.$nord.')" class="input-group-addon btn btn-info" data-toggle="tooltip" title="Cambiar de idioma"><i class="fas fa-exchange-alt"></i></button><select id="schema_'.$tb.'" name="schema_'.$tb.'" data-table="'.$tb.'" class="selschema" data-toggle="tooltip" title="Schema.org">
		<option value=""';
		//if($tb!='ciudades' && $tb!='departamentos' && $tb!='usuarios'){$hhtt.=' selected="selected"';}
		$hhtt.='>Ninguno</option>';
		if($ord==1){$ord1='label';}else{$ord1='etiqueta';}
		$sale = $this->dbs->Execute("select id, label, etiqueta from types2 order by ".$ord1." asc");
		if(!$sale->EOF){
			while(!$sale->EOF){
				$hhtt.='<option value="'.$sale->fields['id'].'"';
				//if($tb=='ciudades' && $sale->fields['label']=='City'){$hhtt.=' selected="selected"';}
				//if($tb=='departamentos' && $sale->fields['label']=='State'){$hhtt.=' selected="selected"';}
				//if($tb=='usuarios' && $sale->fields['label']=='Person'){$hhtt.=' selected="selected"';}
				if($ord==1){
					$hhtt.='>'.$sale->fields['label'].' ('.$sale->fields['etiqueta'].')</option>
';
				}else{
					$hhtt.='>'.$sale->fields['etiqueta'].' ('.$sale->fields['label'].')</option>
';
				}
				$sale->MoveNext();
			}
		}
		$hhtt.='</select>
			<button type="button" onclick="schemahelp(\''.$tb.'\')" class="input-group-addon btn btn-info"><i class="fas fa-question"></i></button>';
		return $hhtt;
	}

	public function mkschematyp2($tb='',$name='',$ord=1){
		$nord=($ord==1)?'2':'1';
		$hhtt='<!--button type="button" onclick="schemaidioma(\''.$tb.'\','.$nord.')" class="input-group-addon btn btn-info" data-toggle="tooltip" title="Cambiar de idioma"><i class="fas fa-exchange"></i></button--><select id="schem2_'.$tb.'_'.$name.'" name="schem2_'.$tb.'_'.$name.'" data-table="'.$tb.'" data-campo="'.$name.'" class="selschem2" data-toggle="tooltip" title="Schema.org" style="width:200px;">
		<option value=""';
		//if($tb!='ciudades' && $tb!='departamentos' && $tb!='usuarios'){$hhtt.=' selected="selected"';}
		$hhtt.='>Ninguno</option>';
		if($ord==1){$ord1='label';}else{$ord1='etiqueta';}
		$sale = $this->dbs->Execute("select id, label, etiqueta from types2 order by ".$ord1." asc");
		if(!$sale->EOF){
			while(!$sale->EOF){
				$hhtt.='<option value="'.$sale->fields['id'].'"';
				//if($tb=='ciudades' && $sale->fields['label']=='City'){$hhtt.=' selected="selected"';}
				//if($tb=='departamentos' && $sale->fields['label']=='State'){$hhtt.=' selected="selected"';}
				//if($tb=='usuarios' && $sale->fields['label']=='Person'){$hhtt.=' selected="selected"';}
				if($ord==1){
					$hhtt.='>'.$sale->fields['label'].' ('.$sale->fields['etiqueta'].')</option>
';
				}else{
					$hhtt.='>'.$sale->fields['etiqueta'].' ('.$sale->fields['label'].')</option>
';
				}
				$sale->MoveNext();
			}
		}
		$hhtt.='</select>
			<button type="button" onclick="schemahelp3(\''.$tb.'_'.$name.'\')" class=""><i class="fas fa-question"></i></button>';
		return $hhtt;
	}

	public function mkschemaprop($tb='',$typ='',$ord=1){
		$nord=($ord==1)?'2':'1';
		$hhtt='<!--button type="button" onclick="schemaidioma2(\''.$tb.'\','.$nord.')" class="" data-toggle="tooltip" title="Cambiar de idioma"><i class="fas fa-exchange"></i></button--><select id="schema_'.$tb.'_CAMCAM" name="schema_'.$tb.'_CAMCAM" data-table="'.$tb.'" class="selschpro" data-toggle="tooltip" title="Propiedades del Schema de tabla" style="width:200px;">
		<option value=""';
		$hhtt.='>Ninguno</option>';
		if($ord==1){$ord1='label';}else{$ord1='etiqueta';}
		$sql ="
			SELECT properties2.id, properties2.label, properties2.etiqueta
			FROM types2, properties2
			WHERE types2.id = '".$typ."' AND types2.properties regexp properties2.id
			ORDER by properties2.".$ord1." asc";
		$sale = $this->dbs->Execute($sql);
		if(!$sale->EOF){
			while(!$sale->EOF){
				$hhtt.='<option value="'.$sale->fields['label'].'"';
				if($tb=='ciudades' && $sale->fields['label']=='City'){$hhtt.=' selected="selected"';}
				if($tb=='departamentos' && $sale->fields['label']=='State'){$hhtt.=' selected="selected"';}
				if($tb=='usuarios' && $sale->fields['label']=='Person'){$hhtt.=' selected="selected"';}
				if($ord==1){
					$hhtt.='>'.$sale->fields['label'].' ('.$sale->fields['etiqueta'].')</option>
';
				}else{
					$hhtt.='>'.$sale->fields['etiqueta'].' ('.$sale->fields['label'].')</option>
';
				}
				$sale->MoveNext();
			}
		}
		$hhtt.='</select>
			<button type="button" onclick="schemahelp(\''.$tb.'_CAMCAM\')" class=""><i class="fas fa-question"></i></button>';
		return $hhtt;
	}

	public function mkschemapro2($tb='',$typ='',$ord=1,$name=''){
		$nord=($ord==1)?'2':'1';
		$hhtt='<!--button type="button" onclick="schemaidioma2(\''.$tb.'\','.$nord.')" class="" data-toggle="tooltip" title="Cambiar de idioma"><i class="fas fa-exchange"></i></button--><select id="schep2_'.$tb.'_'.$name.'" name="schep2_'.$tb.'_'.$name.'" class="selschpro" data-toggle="tooltip" title="Propiedades del Schema del campo" style="width:200px;">
		<option value=""';
		$hhtt.='>Ninguno</option>';
		if($ord==1){$ord1='label';}else{$ord1='etiqueta';}
		$sql ="
			SELECT properties2.id, properties2.label, properties2.etiqueta
			FROM types2, properties2
			WHERE types2.id = '".$typ."' AND types2.properties regexp properties2.id
			ORDER by properties2.".$ord1." asc";
		$sale = $this->dbs->Execute($sql);
		if(!$sale->EOF){
			while(!$sale->EOF){
				$hhtt.='<option value="'.$sale->fields['label'].'"';
				if($ord==1){
					$hhtt.='>'.$sale->fields['label'].' ('.$sale->fields['etiqueta'].')</option>
';
				}else{
					$hhtt.='>'.$sale->fields['etiqueta'].' ('.$sale->fields['label'].')</option>
';
				}
				$sale->MoveNext();
			}
		}
		$hhtt.='</select>
			<button type="button" onclick="schemahelp3(\''.$tb.'_'.$name.'\')" class=""><i class="fas fa-question"></i></button>';
		return $hhtt;
	}

	public function indexhead1($t){ // Encabezado h4 nav form
		$t1=$this->namea($t);
		$t2=$this->singular;
		$cod = '
<div>
<h4><?php echo __("'.$t1.'"); ?> <span class="badge badge-primary"><?php if(isset($sale->_numOfRows)){echo $sale->_numOfRows;}else{echo "0";} ?></span></h4>

<nav class="navbar navbar-default" role="navigation">
<div class="navbar-header">

<form action="<?php echo PATO; ?>'.$t.'/filtrar/" method="post" name="'.$t.'-filtrar" id="'.$t.'-filtrar" class="form-inline navbar-text">
<div class="form-group">

';
		return $cod;
	}

	public function indexhead2($t){ // Cierra el 1
		$t1=$this->namea($t);
		$cod = '
<button type="submit" class="btn btn-primary form-control"><i class="fas fa-search"></i> <?php echo __("Buscar"); ?></button>
</div>

</form>

</div>
</nav>

<?php if($sale->EOF){ ?><div class="row"><div class="col-12" align="left"><?php
if($msg==1)echo __("No hay '.$t1.'");
if($msg==2)echo __("Para ver resultados por favor filtre primero");
?></div></div><?php }else{ ?>
<div class="table-responsive"><table border="0" id="tb_sale_'.$t.'" class="table table-bordered table-striped table-hover table-condensed">
<thead>
	<tr class="hidden">
		';
		return $cod;
	}

	public function icampoth($name){
		//$name1=$this->namea($name);
		$cod='<th align="left" valign="top"><?php echo __("'.$this->singula2.'"); ?></th>
		';
		return $cod;
	}

	public function imedtab(){
		$cod='<th class="acciones" align="center" width="130"><?php echo __("Acciones"); ?></th>
	</tr>
</thead>
<tbody><?php
$j=1;$i=0;
	while(!$sale->EOF){ ?>
	<tr id="trtr<?php echo $sale->fields["id"]; ?>" itemscope itemtype="'.$this->tbschem.'">
		';
		return $cod;
	}

	public function icampotd($name,$type,$rn,$opc){
		$cod='<td align="left" valign="top"';
		if($this->tbtdsche!='')$cod.=' itemprop="'.$this->tbtdsche.'"';
		if($this->tbschem2!='')$cod.=' itemscope itemtype="'.$this->tbschem2.'"';
		$cod.='>';
		if($this->tbtdsche2!='')$cod.='	<span itemprop="'.$this->tbtdsche2.'">';
		$name2=substr($name,-4);
		if($rn==''){
			if(substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod.='<?php if($sale->fields["'.$name.'"]){echo __("Activo");}else{echo __("Inactivo");} ?>';
				}elseif($name=='sexo' || $name2=='sexo'){
					$cod.='<?php if($sale->fields["'.$name.'"]==2){echo __("Mujer");}else{echo __("Hombre");} ?>';
				}else{
					$cod.='<?php
					if(!$sale->fields["'.$name.'"]){echo __("&nbsp;");}
					';
					if(isset($opc[1]) && $opc[1]!='')$cod.='if($sale->fields["'.$name.'"]==1){echo __("'.$opc[1].'");}
					';
					if(isset($opc[2]) && $opc[2]!='')$cod.='if($sale->fields["'.$name.'"]==2){echo __("'.$opc[2].'");}
					';
					if(isset($opc[3]) && $opc[3]!='')$cod.='if($sale->fields["'.$name.'"]==3){echo __("'.$opc[3].'");}
					';
					if(isset($opc[4]) && $opc[4]!='')$cod.='if($sale->fields["'.$name.'"]==4){echo __("'.$opc[4].'");}
					';
					if(isset($opc[5]) && $opc[5]!='')$cod.='if($sale->fields["'.$name.'"]==5){echo __("'.$opc[5].'");}
					';
					$cod.='?>';
				}
			}elseif($type=='tinyblob' || $type=='mediumblob' || $type=='blob' || $type=='longblob'){
				$name1 = substr($name,0,-5);
				$cod.='<?php if($sale->fields["'.$name.'_name"]!=""){echo $sale->fields["'.$name.'_name"]; ?> <a href="<?php echo PATO.MODULO.\'/descargar/\'.$sale->fields["id"].\'/'.$name.'/\'; ?>"><img src="<?php echo PATU.\'img/gifs/009.gif\'; ?>" border="0" alt="<?php echo __(\'Descargar archivo\'); ?>" title="<?php echo __(\'Descargar archivo\'); ?>" /></a><?php }else{echo __("No hay '.$name1.'");} ?>';
			}else{$cod .= '<?php echo $sale->fields["'.$name.'"]; ?>';}
		}else{
			$cod .= '<?php echo $sale->fields["'.$rn.'"]; ?>';
		}
		if($this->tbtdsche2!='')$cod.='</span>';
		$cod.='</td>
		';
		return $cod;
	}

	public function ifoot($t,$kcam,$dd,$siestado){
		$t1=substr($t,0,-1);
		$t2=$this->singular;
		$cod='<td align="center" valign="top">

<a href="<?php echo PATO; ?>'.$t.'/ver/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Ver"); ?>" class="btn btn-default"><i class="fas fa-eye"></i></a>

<a href="<?php echo PATO; ?>'.$t.'/editar/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Editar"); ?>" class="btn btn-default"><i class="fas fa-edit"></i></a>

';
		if($siestado==1)$cod.='<?php if($sale->fields["estado"]==1){ ?>
<a href="<?php echo PATO; ?>'.$t.'/desactivar/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Desactivar"); ?>" class="btn btn-default"><i class="fas fa-thumbs-o-down"></i></a><?php
}else{
?><a href="<?php echo PATO; ?>'.$t.'/activar/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Activar"); ?>" class="btn btn-default"><i class="fas fa-thumbs-o-up"></i></a><?php
} ?>

';
		if($dd!='')$cod.='<a href="JavaScript:;" onClick="eliminar'.$t.'(<?php echo $sale->fields["id"]; ?>)" data-toggle="tooltip" title="<?php echo __("Eliminar"); ?>" class="btn btn-default"><i class="fas fa-trash"></i></a>

';
		$cod.='        </td>
	</tr><?php if($j==1){$j=2;}else{$j=1;}$sale->MoveNext();$i++;}$sale->Move(0); ?>
</tbody></table></div>


<div id="pager2" class="pager2 my-2 mx-0">
<form class="form-inline">
<div class="btn-group">
	<button type="button" class="btn btn-default first"><i class="fas fa-fast-backward"></i></button>
	<button type="button" class="btn btn-default prev"><i class="fas fa-backward"></i></button>
	<button type="button" class="btn btn-default"><span class="pagedisplay">&nbsp;</span></button>
	<button type="button" class="btn btn-default next"><i class="fas fa-forward"></i></button>
	<button type="button" class="btn btn-default last"><i class="fas fa-fast-forward"></i></button>
</div>
<div class="form-group" data-placement="right" data-toggle="tooltip" title="<?php echo __("Registros por pagina"); ?>"><select id="rpp" class="custom-select pagesize"><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="100">100</option>
</select></div>
</form>
</div>

<script type="application/javascript">
$(function(){
	$("#rpp").val(<?php echo RPP; ?>);
	$("#tb_sale_'.$t.'").tablesorter({headers: {'.$kcam.': {sorter: false}}, widgets: ["zebra"]});
	$("#tb_sale_'.$t.'").tablesorterPager({container:$(".pager2"),ajaxUrl:null,output:"{startRow} <?php echo __("a"); ?> {endRow} <?php echo __("de un total de"); ?> {totalRows}",updateArrows:true,page:0,size:<?php echo RPP; ?>,fixedHeight:false,removeRows:true,cssNext:".next",cssPrev:".prev",cssFirst:".first",cssLast:".last",cssPageDisplay:".pagedisplay",cssPageSize:".pagesize",cssDisabled:"disabled"});
});
function eliminar'.$t.'(a){
	confirma1(\'<?php echo iinterro().__("Esta seguro de eliminar '.$t2.'?"); ?>\',\'<?php echo __("Si"); ?>\',\'eliminando'.$t.'\',a)}
function eliminando'.$t.'(a){window.location.href = "<?php echo PATO; ?>'.$t.'/eliminar/"+a+"/";}
</script><?php } ?>

<form class="form-inline">

<div class="form-group"><button type="button" class="btn btn-primary form-control" onClick="location.href=\'<?php echo PATO; ?>'.$t.'/agregar/\';"><i class="fas fa-plus"></i>&nbsp;&nbsp;<?php echo __("Nuevo"); ?></button></div>

<div class="form-group"><button type="button" class="btn btn-primary form-control" onClick="location.href=\'<?php echo PATO; ?>\';"><i class="fas fa-home"></i>&nbsp;&nbsp;<?php echo __("Inicio"); ?></button></div>

</form>
</div>

';
		return $cod;
	}

	public function mkind($t,$cod,$per=''){$f=fopen($per.'view/'.$t.'_index.php', "w+");fwrite($f,$cod);fclose($f);}

	public function ahead($t){ // Add tabla
		$t2=$this->singular;
		$cod='
<h4><?php echo __("Nuevo '.$t2.'"); ?></h4>

<form id="'.$t.'-agregando" name="'.$t.'-agregando" class="form-horizontal" method="post" action="<?php echo PATO; ?>'.$t.'/agregando/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">

';
		return $cod;
	}

	public function ftrs($name,$type,$null,$key,$def,$ext,$r1,$r2,$opc){ // inputs de busqueda
		$cod='';
		$name1=$this->singula2;
		$name2=substr($name,-4);
		$ayuda=substr($name,-10);
		if($ayuda!='_file_name' && $ayuda!='_file_type' && $ayuda!='_file_size'){
			if($r2==''){
				$onalgo='';
				if(substr($type,0,6)=='bigint' || substr($type,0,9)=='mediumint' || substr($type,0,8)=='smallint'){
					$onalgo=' onKeyPress="return notxt(event)"';
				}
				$cod='<input id="'.$name.'" name="'.$name.'" placeholder="<?php echo __("'.$name1.'"); ?>" type="text" value="<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]!=""){echo $_POST["'.$name.'"];} ?>" class="form-control"'.$onalgo.' />';
			}else{
				$otrocamp=explode('_',$r2);
				$cod='<select name="'.$name.'" id="'.$name.'" class="custom-select">
	<option value="0"<?php if(isset($_POST["'.$name.'"]) && !$_POST["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo __("'.$name1.'"); ?></option><optgroup label="Activos"><?php
if(!$'.$otrocamp[0].'->EOF){
	while(!$'.$otrocamp[0].'->EOF){if($'.$otrocamp[0].'->fields["estado"]){ ?>
   	<option value="<?php echo $'.$otrocamp[0].'->fields["id"]; ?>"<?php if(isset($_POST["'.$name.'"]) && $'.$otrocamp[0].'->fields["id"]==$_POST["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo $'.$otrocamp[0].'->fields["'.$otrocamp[1].'"]; ?></option><?php
		}$'.$otrocamp[0].'->MoveNext();
	}
	$'.$otrocamp[0].'->Move(0);
} ?>
</optgroup><optgroup label="Inactivos"><?php
if(!$'.$otrocamp[0].'->EOF){
	while(!$'.$otrocamp[0].'->EOF){if(!$'.$otrocamp[0].'->fields["estado"]){ ?>
   	<option value="<?php echo $'.$otrocamp[0].'->fields["id"]; ?>"<?php if(isset($_POST["'.$name.'"]) && $'.$otrocamp[0].'->fields["id"]==$_POST["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo $'.$otrocamp[0].'->fields["'.$otrocamp[1].'"]; ?></option><?php
		}$'.$otrocamp[0].'->MoveNext();
	}
	$'.$otrocamp[0].'->Move(0);
} ?>
</optgroup></select>';
			}
			if(substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod='<select name="'.$name.'" id="'.$name.'" class="custom-select">
	<option value="-1"<?php if(!isset($_POST["'.$name.'"]) || $_POST["'.$name.'"]==-1){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione '.$name1.'"); ?></option>
	<option value="1"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==1){ ?> selected="selected"<?php } ?>><?php echo __("Activo"); ?></option>
	<option value="0"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==0){ ?> selected="selected"<?php } ?>><?php echo __("Inactivo"); ?></option>
</select>';
				}elseif($name=='sexo' || $name2=='sexo'){
					$cod='<select name="'.$name.'" id="'.$name.'" class="custom-select">
	<option value=""<?php if(!isset($_POST["'.$name.'"]) || $_POST["'.$name.'"]==""){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione '.$name1.'"); ?></option>
	<option value="1"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==1){ ?> selected="selected"<?php } ?>><?php echo __("Hombre"); ?></option>
	<option value="2"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==2){ ?> selected="selected"<?php } ?>><?php echo __("Mujer"); ?></option>
</select>';
				}else{
					$cod='<select name="'.$name.'" id="'.$name.'" class="custom-select">
	<option value="0"<?php if(!isset($_POST["'.$name.'"]) || !$_POST["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione '.$name1.'"); ?></option>';
					if(isset($opc[1]) && $opc[1]!='')$cod.='
	<option value="1"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==1){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[1].'"); ?></option>';
					if(isset($opc[2]) && $opc[2]!='')$cod.='
	<option value="2"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==2){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[2].'"); ?></option>';
					if(isset($opc[3]) && $opc[3]!='')$cod.='
	<option value="3"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==3){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[3].'"); ?></option>';
					if(isset($opc[4]) && $opc[4]!='')$cod.='
	<option value="4"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==4){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[4].'"); ?></option>';
					if(isset($opc[5]) && $opc[5]!='')$cod.='
	<option value="5"<?php if(isset($_POST["'.$name.'"]) && $_POST["'.$name.'"]==5){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[5].'"); ?></option>';
					$cod.='
</select>';
				}
			}
			if($type=='tinyblob' || $type=='mediumblob' || $type=='blob' || $type=='longblob'){$cod='';}
		}
		return $cod;
	}

	public function atrs($name,$type,$null,$key,$def,$ext,$r1,$r2,$opc){ // add inputs
		$cod='';
		$name1=$this->singula2;
		$name2=substr($name,-4);
		$rnu=($null=='YES')?'':' required';
		$ayuda=substr($name,-10);
		if($ayuda!='_file_name' && $ayuda!='_file_type' && $ayuda!='_file_size'){
			if($r2==''){
				$onalgo='';
				if(substr($type,0,6)=='bigint' || substr($type,0,9)=='mediumint' || substr($type,0,8)=='smallint'){
					$onalgo=' onKeyPress="return notxt(event)"';
				}
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><input id="'.$name.'" name="'.$name.'" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba '.$this->articulo($name1).' '.$name1.'"); ?>"'.$onalgo.$rnu.' /></div>
</div>

';
			}else{
				$otrocamp=explode('_',$r2);
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'>
		<option value="0" selected="selected"><?php echo __("Seleccione '.$name1.'"); ?></option><?php
if(!$'.$otrocamp[0].'->EOF){
	while(!$'.$otrocamp[0].'->EOF){ ?>
    	<option value="<?php echo $'.$otrocamp[0].'->fields["id"]; ?>"><?php echo $'.$otrocamp[0].'->fields["'.$otrocamp[1].'"]; ?></option><?php
		$'.$otrocamp[0].'->MoveNext();
	}
	$'.$otrocamp[0].'->Move(0);
} ?></select></div>
</div>

';
			}
			if(substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select"'.$rnu.'>
			<option value="1" selected="selected"><?php echo __("Activo"); ?></option>
			<option value="0"><?php echo __("Inactivo"); ?></option>
		</select></div>
</div>

';
				}elseif($name=='sexo' || $name2=='sexo'){
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select"'.$rnu.'>
			<option value="1" selected="selected"><?php echo __("Hombre"); ?></option>
			<option value="2"><?php echo __("Mujer"); ?></option>
		</select></div>
</div>

';
				}else{
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'>
			<option value="0" selected="selected"><?php echo __("Seleccione '.$name1.'"); ?></option>
			';
					if(isset($opc[1]) && $opc[1]!='')$cod.='<option value="1"><?php echo __("'.$opc[1].'"); ?></option>
			';
					if(isset($opc[2]) && $opc[2]!='')$cod.='<option value="2"><?php echo __("'.$opc[2].'"); ?></option>
			';
					if(isset($opc[3]) && $opc[3]!='')$cod.='<option value="3"><?php echo __("'.$opc[3].'"); ?></option>
			';
					if(isset($opc[4]) && $opc[4]!='')$cod.='<option value="4"><?php echo __("'.$opc[4].'"); ?></option>
			';
					if(isset($opc[5]) && $opc[5]!='')$cod.='<option value="5"><?php echo __("'.$opc[5].'"); ?></option>
			';
					$cod.='		</select></div>
</div>

';
				}
			}
			if($type=='tinyblob' || $type=='mediumblob' || $type=='blob' || $type=='longblob'){
				$name1=$this->singula2;
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><input type="file" id="'.$name.'" name="'.$name.'" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el archivo '.$this->articulo($name1).'"); ?>"'.$rnu.' /></div>
</div>

';
			}
			if($type=='text'){
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-2"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><textarea id="'.$name.'" name="'.$name.'" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'></textarea></div>
</div>

';
			}
		}
		return $cod;
	}

	public function afoot1($t,$scdate){ // add foot table
		$cod='
<div class="form-group row">
	<div class="col-2"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
	<div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
</div>

	</div>
</div>

</form>

<script type="application/javascript">
var pavem=0;
$(function(){
	'.$scdate.'
	$("#'.$t.'-agregando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");
';
		return $cod;
	}

	public function aescript($name,$type,$null,$key,$def,$ext,$r1,$r2){
		$cod='';
		if($null=='NO'){
			if($name=='email'){
				$cod='
		if($("#email").val()=="" || !valmail($("#email").val())){
			if(err==0)$("#email").focus();err++;$("#email").addClass("has-error").popover("show").parent("div").addClass("has-error");}
';
			}else{
				if($r1==''){
					$cod='
		if($("#'.$name.'").val()==""){
			if(err==0)$("#'.$name.'").focus();err++;$("#'.$name.'").addClass("has-error").popover("show").parent("div").addClass("has-error");}
';
				}else{
					$cod='

		if($("#'.$name.'").val()==0){
			if(err==0)$("#'.$name.'").focus();err++;$("#'.$name.'").addClass("has-error").popover("show").parent("div").addClass("has-error");}
';
				}
			}
		}
		return $cod;
	}

	public function afoot2($t){
		$cod='
		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>';
		return $cod;
	}

	public function mkadd($t,$cod,$per=''){$f=fopen($per.'view/'.$t.'_agregar.php', "w+");fwrite($f,$cod);fclose($f);}

	public function ehead($t){ // Edd tabla
		$t2=$this->singular;
		$cod='<h4><?php echo __("Editar '.$t2.'"); ?></h4>

<form id="'.$t.'-editando" name="'.$t.'-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>'.$t.'/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">

';
		return $cod;
	}

	public function etrs($name,$type,$null,$key,$def,$ext,$r1,$r2,$opc){ // edd inputs
		$cod='';
		$name1=$this->singula2;
		$name2=substr($name,-4);
		$rnu=($null=='YES')?'':' required';
		$ayuda=substr($name,-10);
		echo $type.'<br />';
		if($ayuda!='_file_name' && $ayuda!='_file_type' && $ayuda!='_file_size'){
			if($r2==''){
				$onalgo='';
				if(substr($type,0,6)=='bigint' || substr($type,0,9)=='mediumint' || substr($type,0,8)=='smallint'){
					$onalgo=' onKeyPress="return notxt(event)"';
				}
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><input id="'.$name.'" name="'.$name.'" type="text" value="<?php echo $sale->fields["'.$name.'"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba '.$this->articulo($name1).' '.$name1.'"); ?>"'.$onalgo.$rnu.' /></div>
</div>

';
			}else{
				$otrocamp=explode('_',$r2);
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'>
		<option value="0"<?php if(!$sale->fields["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione '.$name1.'"); ?></option><?php
if(!$'.$otrocamp[0].'->EOF){
	while(!$'.$otrocamp[0].'->EOF){ ?>
    	<option value="<?php echo $'.$otrocamp[0].'->fields["id"]; ?>"<?php if($'.$otrocamp[0].'->fields["id"]==$sale->fields["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo $'.$otrocamp[0].'->fields["'.$otrocamp[1].'"]; ?></option><?php
		$'.$otrocamp[0].'->MoveNext();
	}
	$'.$otrocamp[0].'->Move(0);
} ?></select></div>
</div>

';
			}
			if(substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select"'.$rnu.'>
			<option value="1"<?php if($sale->fields["'.$name.'"]) { ?> selected="selected"<?php } ?>><?php echo __("Activo"); ?></option>
			<option value="0"<?php if(!$sale->fields["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo __("Inactivo"); ?></option>
		</select></div>
</div>

';
				}elseif($name=='sexo' || $name2=='sexo'){
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select"'.$rnu.'>
			<option value="1"<?php if($sale->fields["'.$name.'"]==1) { ?> selected="selected"<?php } ?>><?php echo __("Hombre"); ?></option>
			<option value="2"<?php if($sale->fields["'.$name.'"]==2) { ?> selected="selected"<?php } ?>><?php echo __("Mujer"); ?></option>
		</select></div>
</div>

';
				}else{
					$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><select name="'.$name.'" id="'.$name.'" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'>
		<option value="0"<?php if(!$sale->fields["'.$name.'"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione '.$name1.'"); ?></option>
		';
					if(isset($opc[1]) && $opc[1]!='')$cod.='<option value="1"<?php if($sale->fields["'.$name.'"]==1){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[1].'"); ?></option>
		';
					if(isset($opc[2]) && $opc[2]!='')$cod.='<option value="2"<?php if($sale->fields["'.$name.'"]==2){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[2].'"); ?></option>
		';
					if(isset($opc[3]) && $opc[3]!='')$cod.='<option value="3"<?php if($sale->fields["'.$name.'"]==3){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[3].'"); ?></option>
		';
					if(isset($opc[4]) && $opc[4]!='')$cod.='<option value="4"<?php if($sale->fields["'.$name.'"]==4){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[4].'"); ?></option>
		';
					if(isset($opc[5]) && $opc[5]!='')$cod.='<option value="5"<?php if($sale->fields["'.$name.'"]==5){ ?> selected="selected"<?php } ?>><?php echo __("'.$opc[5].'"); ?></option>
		';
					$cod.='		</select></div>
</div>

';
				}
			}
			if($type=='tinyblob' || $type=='mediumblob' || $type=='blob' || $type=='longblob'){
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><input type="file" id="'.$name.'" name="'.$name.'" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el archivo '.$this->articulo($name1).'"); ?>"'.$rnu.' /></div>
</div>

';
			}
			if($type=='text'){
				$cod='
<div class="form-group row">
<label for="'.$name.'" class="col-3"><?php echo __("'.$name1.'"); ?></label>
<div class="col-7"><textarea id="'.$name.'" name="'.$name.'" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba '.$this->articulo($name1).' '.$name1.'"); ?>"'.$rnu.'><?php echo $sale->fields["'.$name.'"]; ?></textarea></div>
</div>

';
			}
		}
		return $cod;
	}

	public function efoot1($t,$scdate){ // edd foot table
		$cod='
<div class="form-group row">
	<div class="col-3"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
	<div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
</div>

	</div>
</div>

</form>

<script type="application/javascript">
var pavem=0;
$(function(){
	'.$scdate.'
	$("#'.$t.'-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

';
		return $cod;
	}

	public function efoot2($t){
		$cod='
		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>';
		return $cod;
	}

	public function mkedd($t,$cod,$per=''){$f=fopen($per.'view/'.$t.'_editar.php', "w+");fwrite($f,$cod);fclose($f);}

	public function scriptdate($cam){
		$cod='
	$("#'.$cam.'").datepicker(dateconf);
';
		return $cod;
	}

	public function tdmenuhead(){
		$cod='
<nav class="navbar navbar-expand-md navbar-light bg-faded" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#jcnavbar" aria-controls="jcnavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	<a class="navbar-brand" href="<?php echo PATO; ?>"><i class="fas fa-home"></i></a>
	<div class="collapse navbar-collapse" id="jcnavbar">
		<ul class="navbar-nav mr-auto">
';
		return $cod;
	}

	public function tdmenu($t){
		$t1=$this->namea($t);
		$cod='
			<li class="nav-item<?php if(MODULO=="'.$t.'")echo \' active\'; ?>"><a class="nav-link" href="<?php echo PATO; ?>'.$t.'/" itemprop="URL"> <?php echo __("'.$t1.'"); ?></a></li>

';
		return $cod;
	}

	public function tdmenufoot(){
		$cod='
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0 hidden">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" name="q" />
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> buscar</button>
		</form>
	</div>
</nav>
';
		return $cod;
	}

	public function tdcmenuhead(){
		$cod='
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="javaScript:;" id="navbarDropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i> Configuraciones</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenu1">
';
		return $cod;
	}

	public function tdcmenu($t){
		$t1=$this->namea($t);
		$cod='
				<a class="dropdown-item<?php if(MODULO=="'.$t.'")echo " active"; ?>" href="<?php echo PATO; ?>'.$t.'/" itemprop="URL"><i class="fas fa-angle-right"></i> <?php echo __("'.$t1.'"); ?></a>
';
		return $cod;
	}

	public function mkMenu($cod,$per=''){$f=fopen($per.'view/_menu.php', "w+");fwrite($f,$cod);fclose($f);}

	public function namea($a){ // Nombre de campo relacionado sin id o file
		$a=str_replace('_id','',$a);
		$a=str_replace('_file','',$a);
		$a=str_replace('cion','ción',$a);
		$a=str_replace('elefono','eléfono',$a);
		$a=str_replace('codigo','código',$a);
		$a=str_replace('Codigo','Código',$a);
		$va = strtoupper(substr($a,0,1)).substr(str_replace('_',' ',$a),1);
		return $va;
	}

	public function names($a){ // Nombre a singular
		$va = (substr($a,-2)=='es')?substr($a,0,-2):substr($a,0,-1);
		if($va=='admin'){$va='Administrador';}
		if($va=='Admins'){$va='Administradores';}
		$va = strtoupper(substr($va,0,1)).strtolower(substr($va,1));
		return $va;
	}

	public function articulo($a){
		$sexo=(substr($a,-1)=='a' || substr($a,-1)=='d');
		$va = ($sexo)?'la':'el';
		return $va;
	}

	public function vhead($t){ // Ver tabla
		$cod = '<h4><?php echo __("Ver '.$t.'"); ?></h4>

<div class="row">
	<div class="col-8" itemscope itemtype="'.$this->tbschem.'">

';
		return $cod;
	}

	public function vfoot(){
		$cod = '
<div class="form-group">
<div class="col-5">&nbsp;</div>
<div class="col-7"><button type="button" class="btn btn-primary btn-block mt-2" onClick="window.history.back();">
<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("volver"); ?>
</button></div>
</div>

	</div>
	<div class="col-4">&nbsp;</div>
</div>

';
		return $cod;
	}

	public function mkver($t,$cod,$per=''){$f=fopen($per.'view/'.$t.'_ver.php', "w+");fwrite($f,$cod);fclose($f);}

	public function vcampotr($name,$type,$rn,$opc){
		$name1=$this->singula2;
		//$rn = $rn.'_'.$name;
		$cod='
<div class="row">
	<div class="col-5"><?php echo __("'.$name1.'"); ?></div>
	<div class="col-7"';
		if($this->tbtdsche!='')$cod.=' itemprop="'.$this->tbtdsche.'"';
		if($this->tbschem2!='')$cod.=' itemscope itemtype="'.$this->tbschem2.'"';
		$cod.='>';
		if($this->tbtdsche2!='')$cod.='<span itemprop="'.$this->tbtdsche2.'">';
		$name2=substr($name,-4);
		if($rn==''){
			if(substr($type,0,7)=='tinyint'){
				if($name=='estado'){
					$cod.='<?php if($sale->fields["'.$name.'"]){echo __("Activo");}else{echo __("Inactivo");} ?>';
				}elseif($name=='sexo' || $name2=='sexo'){
					$cod.='<?php if($sale->fields["'.$name.'"]==2){echo __("Mujer");}else{echo __("Hombre");} ?>';
				}else{
					$cod.='<?php
					if(!$sale->fields["'.$name.'"]){echo __("&nbsp;");}
					';
					if(isset($opc[1]) && $opc[1]!='')$cod.='if($sale->fields["'.$name.'"]==1){echo __("'.$opc[1].'");}
					';
					if(isset($opc[2]) && $opc[2]!='')$cod.='if($sale->fields["'.$name.'"]==2){echo __("'.$opc[2].'");}
					';
					if(isset($opc[3]) && $opc[3]!='')$cod.='if($sale->fields["'.$name.'"]==3){echo __("'.$opc[3].'");}
					';
					if(isset($opc[4]) && $opc[4]!='')$cod.='if($sale->fields["'.$name.'"]==4){echo __("'.$opc[4].'");}
					';
					if(isset($opc[5]) && $opc[5]!='')$cod.='if($sale->fields["'.$name.'"]==5){echo __("'.$opc[5].'");}
					';
					$cod.='?>';
				}
			}elseif($type=='tinyblob' || $type=='mediumblob' || $type=='blob' || $type=='longblob'){
				$name1 = substr($name,0,-5);
				$cod.='<?php if($sale->fields["'.$name.'_name"]!=""){echo $sale->fields["'.$name.'_name"]; ?> <a href="<?php echo PATO.MODULO.\'/descargar/\'.$sale->fields["id"].\'/'.$name.'/\'; ?>"><img src="<?php echo PATU.\'img/gifs/009.gif\'; ?>" border="0" alt="<?php echo __(\'Descargar archivo\'); ?>" data-toggle="tooltip" title="<?php echo __(\'Descargar archivo\'); ?>" /></a><?php }else{echo __("No hay '.$name1.'");} ?>';
			}else{$cod .= '<?php echo $sale->fields["'.$name.'"]; ?>';}
		}else{
			$cod .= '<?php echo $sale->fields["'.$rn.'"]; ?>';
		}
		if($this->tbtdsche2!='')$cod.='</span>';
		$cod.='	</div>
</div>

';
		return $cod;
	}

	public function mkperfiles1($ti){
		$ch='<?php
$version = explode(".",phpversion());define("PHPVER",($version[0] * 10000 + $version[1] * 100 + $version[2]));

if(preg_match("/'.TITULO.'/i",$_SERVER["HTTP_HOST"])){
	define("MIURL","'.MIURL.'");
	define("MIURLS","'.MIURLS.'");
	define("PATO","'.PATU.$ti.'/");
	define("PATU","'.PATU.'");
}else{
	define("MIURL","http://localhost");
	define("MIURLS","https://localhost");
	define("PATO","'.PATU.$ti.'/");
	define("PATU","'.PATU.'");
}

//   Varios
define("URLVIEW","'.TITULO.'");
define("PERFIL","'.$ti.'");
define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"]);
define("RPP",'.RPP.');
define("JQUERY","'.JQUERY.'");
define("LOGO","'.LOGO.'");
define("LOGOP","'.LOGOP.'");
define("LOGALT","'.LOGALT.'");
define("PATA",ROOT_PATH.PATO);
define("TEMP",PATA."../73mp0r4l/");
define("IDIOMA","'.IDIOMA.'"); // para ingles: enus, para español: esco

//	============Google============
//	https://developers.google.com/recaptcha/
define("GOOGLE_CLAVE_SITIO","'.GOOGLE_CLAVE_SITIO.'");
define("GOOGLE_CLAVE_SECRETA","'.GOOGLE_CLAVE_SECRETA.'");

// Variables reutilizables
define("TITULO","'.TITULO.'");
define("SEOKEYWORDS","'.SEOKEYWORDS.'");
define("SSEOKEYWORD","'.SSEOKEYWORD.'");
define("SEODESCRIPT","'.SEODESCRIPT.'");
define("SSEODESCRIP","'.SSEODESCRIP.'");
define("ADDTHIS","'.ADDTHIS.'");
define("FIRMA","'.FIRMA.'");
define("YALE","'.YALE.'");
$uuid = uniqid();

// Datos de PagosOnLine
define("POL_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("POL_LLAVE","10a477913d0");
define("POL_ID","11400");
define("POL_MONEDA","COP");

// Datos de PayPal
define("PP_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("PP_BUSINESS","jcjavier@yahoo.com");
define("PP_CURRENCY_CODE","USD");
define("PP_ALT","PayPal - La forma más segura y fácil de pagar en línea"); //PayPal - The safer, easier way to pay online
define("PP_NN","wYgQT7n_j7HmNluCEmnmA7pl7jw3JJJJYxqETBrY5gwwesHdTBvdRxYC_7C");
//Utilice el siguiente código personal de identidad al configurar Transferencia de datos de pago en su sitio Web

// FaceBook
define("YOUR_APP_ID", "112958333830352");
define("YOUR_SECRET", "8437e356e0c30d1c7777b0e411251e8e");
define("FB_SCOPE","public_profile,email,user_birthday,user_location,user_photos");

// Datos de Servidor de correo para envio de correos en general
define("MAIL_SERVER","'.TITULO.'");
define("MAIL_PORT","'.MAIL_PORT.'");
define("MAIL_AUTH",'.MAIL_AUTH.');
define("MAIL_USER","'.MAIL_USER.'");
define("MAIL_PASS","'.MAIL_PASS.'");
define("MAIL_MAIL","'.MAIL_MAIL.'");
define("MAIL_NAME","'.TITULO.'");
define("MAIL_LOGO",PATA."/img/logo.jpg");
define("MAIL_LOGO_NAME","'.MAIL_LOGO_NAME.'");

';
		$fh=fopen('inc/config_'.$ti.'.php', "w+");fwrite($fh,$ch);fclose($fh);
	}

	public function mkperfiles2(){
		$ch='<?php
$version = explode(".",phpversion());define("PHPVER",($version[0] * 10000 + $version[1] * 100 + $version[2]));

if(preg_match("/'.TITULO.'/i",$_SERVER["HTTP_HOST"])){
	define("MIURL","'.MIURL.'");
	define("MIURLS","'.MIURLS.'");
	define("PATO","'.PATU.'");
	define("PATU","'.PATU.'");
}else{
	define("MIURL","http://localhost");
	define("MIURLS","https://localhost");
	define("PATO","'.PATU.'");
	define("PATU","'.PATU.'");
}

//   Varios
define("PERFIL","'.PPUBLICO.'");
define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"]);
define("RPP",'.RPP.');
define("JQUERY","'.JQUERY.'");
define("LOGO","'.LOGO.'");
define("PATA",ROOT_PATH.PATO);
define("TEMP",PATA."73mp0r4l/");
define("IDIOMA","'.IDIOMA.'"); // para ingles: enus, para español: esco

//	============Google============
//	https://developers.google.com/recaptcha/
define("GOOGLE_CLAVE_SITIO","'.GOOGLE_CLAVE_SITIO.'");
define("GOOGLE_CLAVE_SECRETA","'.GOOGLE_CLAVE_SECRETA.'");

// Variables reutilizables
define("TITULO","'.TITULO.'");
define("SEOKEYWORDS","'.SEOKEYWORDS.'");
define("SSEOKEYWORD","'.SSEOKEYWORD.'");
define("SEODESCRIPT","'.SEODESCRIPT.'");
define("SSEODESCRIP","'.SSEODESCRIP.'");
define("ADDTHIS","'.ADDTHIS.'");
define("FIRMA","'.FIRMA.'");
define("YALE","'.YALE.'");
$uuid = uniqid();

// Datos de PagosOnLine
define("POL_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("POL_LLAVE","10a477913d0");
define("POL_ID","11400");
define("POL_MONEDA","COP");

// Datos de PayPal
define("PP_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("PP_BUSINESS","jcjavier@yahoo.com");
define("PP_CURRENCY_CODE","USD");
define("PP_ALT","PayPal - La forma más segura y fácil de pagar en línea"); //PayPal - The safer, easier way to pay online
define("PP_NN","wYgQT7n_j7HmNluCEmnmA7pl7jw3PYIYYxqETBrY5gwweJJJTBvdRxYC_7C");
//Utilice el siguiente código personal de identidad al configurar Transferencia de datos de pago en su sitio Web

// FaceBook
define("YOUR_APP_ID", "112958333830352");
define("YOUR_SECRET", "8437e356e0c307777f91b0e411251e8e");
define("FB_SCOPE","public_profile,email,user_birthday,user_location,user_photos");

// Datos de Servidor de correo para envio de correos en general
define("MAIL_SERVER","'.TITULO.'");
define("MAIL_PORT","'.MAIL_PORT.'");
define("MAIL_AUTH",'.MAIL_AUTH.');
define("MAIL_USER","'.MAIL_USER.'");
define("MAIL_PASS","'.MAIL_PASS.'");
define("MAIL_MAIL","'.MAIL_MAIL.'");
define("MAIL_NAME","'.TITULO.'");
define("MAIL_LOGO",PATA."/img/logo.jpg");
define("MAIL_LOGO_NAME","'.MAIL_LOGO_NAME.'");
';
		$fh=fopen('inc/config_raiz.php', "w+");fwrite($fh,$ch);fclose($fh);
	}

	public function mkperfilesbase($ts,$cp){
		$cod='RewriteEngine on
RewriteCond $1 !^(index\.php|robots\.txt|favicon\.ico|sitemap\.xml|img|js|css|ckeditor|ckfinder|fonts';
		for($i=0;$i<$cp;$i++){ // siclo de perfil completo
			$cod.='|'.$ts[$i];
			$ch='RewriteEngine on
RewriteCond $1 !^(index\.php|img|js|css|robots\.txt)
RewriteRule ^(.*)$ index.php/$1 [L]
';
			$fh=fopen('../'.$ts[$i].'/.htaccess', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
$version = explode(".",phpversion());define("PHPVER",($version[0] * 10000 + $version[1] * 100 + $version[2]));

if(preg_match("/'.TITULO.'/i",$_SERVER["HTTP_HOST"])){
	define("MIURL","'.MIURL.'");
	define("MIURLS","'.MIURLS.'");
	define("PATO","'.PATU.$ts[$i].'/");
	define("PATU","'.PATU.'");
}else{
	define("MIURL","http://localhost");
	define("MIURLS","https://localhost");
	define("PATO","'.PATU.$ts[$i].'/");
	define("PATU","'.PATU.'");
}

//   Varios
define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"]);
define("RPP",'.RPP.');
define("JQUERY","'.JQUERY.'");
define("LOGO","'.LOGO.'");
define("PATA",ROOT_PATH.PATO);
define("IDIOMA","'.IDIOMA.'"); // para ingles: enus, para español: esco
define("TEMP",PATA."../73mp0r4l/");
define("PERFIL","'.$ts[$i].'");

//	============Google============
//	https://developers.google.com/recaptcha/
define("GOOGLE_CLAVE_SITIO","'.GOOGLE_CLAVE_SITIO.'");
define("GOOGLE_CLAVE_SECRETA","'.GOOGLE_CLAVE_SECRETA.'");

// Variables reutilizables
define("TITULO","'.TITULO.'");
define("SEOKEYWORDS","'.SEOKEYWORDS.'");
define("SSEOKEYWORD","'.SSEOKEYWORD.'");
define("SEODESCRIPT","'.SEODESCRIPT.'");
define("SSEODESCRIP","'.SSEODESCRIP.'");
define("ADDTHIS","'.ADDTHIS.'");
define("FIRMA","'.FIRMA.'");
define("YALE","'.YALE.'");
$uuid = uniqid();

// Datos de PagosOnLine
define("POL_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("POL_LLAVE","10a477913d0");
define("POL_ID","11400");
define("POL_MONEDA","COP");

// Datos de PayPal
define("PP_PRUEBA",1);	// Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("PP_BUSINESS","jcjavier@yahoo.com");
define("PP_CURRENCY_CODE","USD");
define("PP_ALT","PayPal - La forma más segura y fácil de pagar en línea"); //PayPal - The safer, easier way to pay online
define("PP_NN","wYgQT7n_j7HmNluCEmnmA7pl7jw3JJJJYxqETBrY5gwwesHdTBvdRxYC_7C");
//Utilice el siguiente código personal de identidad al configurar Transferencia de datos de pago en su sitio Web

// FaceBook
define("YOUR_APP_ID", "112958333830352");
define("YOUR_SECRET", "8437e356e0c30d1c7777b0e411251e8e");
define("FB_SCOPE","public_profile,email,user_birthday,user_location,user_photos");

// Datos de Servidor de correo para envio de correos en general
define("MAIL_SERVER","'.TITULO.'");
define("MAIL_PORT","'.MAIL_PORT.'");
define("MAIL_AUTH",'.MAIL_AUTH.');
define("MAIL_USER","'.MAIL_USER.'");
define("MAIL_PASS","'.MAIL_PASS.'");
define("MAIL_MAIL","'.MAIL_MAIL.'");
define("MAIL_NAME","'.TITULO.'");
define("MAIL_LOGO",PATA."/img/logo.jpg");
define("MAIL_LOGO_NAME","'.MAIL_LOGO_NAME.'");

';
			$fh=fopen('inc/config_'.$ts[$i].'.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php

require_once("../admin/inc/adodb5/adodb.inc.php");require_once("../admin/inc/class.phpmailer.php");
include_once("../admin/inc/config_'.$ts[$i].'.php");include_once("../admin/inc/funciones.php");

session_start();class nada{public $EOF=1;public function index(){echo "";}}if(!isset($_SESSION["JC_Idioma"])){$_SESSION["JC_Idioma"]=IDIOMA;}

$datos = explode("/",limpia(str_replace(PATO,"",$_SERVER["REQUEST_URI"])));$valor = Array();
if($datos[0]!=""&&substr($datos[0],0,1)!="?"){define("MODULO",$datos[0]);}else{define("MODULO","index");}
if(isset($datos[1])&&$datos[1]!=""&&substr($datos[1],0,1)!="?"){define("PROCESO",$datos[1]);}else{define("PROCESO","index");}
$fin=count($datos);if($fin>2){if(substr($datos[2],0,1)!="?"){$j=0;for($i=2;$i<$fin;$i++){if(!empty($datos[$i])){$valor[$j++]=$datos[$i];}}}}

include_once("../admin/inc/db.php");include_once("../admin/controller/baseControl.php");

//include_once("../admin/inc/facebook.php");$facebook=new Facebook(array("appId"=>YOUR_APP_ID,"secret"=>YOUR_SECRET));$userId=$facebook->getUser();

if(substr_count($_SERVER[\'HTTP_ACCEPT_ENCODING\'],\'gzip\')){ob_start("ob_gzhandler");}else{ob_start();}
include_once(\'controller/\'.MODULO.\'Controller.php\');eval(\'$a = new \'.MODULO.\'Controller();\');$a->valor=$valor;eval(\'$a->\'.PROCESO.\'();\');
ob_flush();

';
			$fh=fopen('../'.$ts[$i].'/index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='';$fh=fopen('../'.$ts[$i].'/css/estilos.css', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='';$fh=fopen('../'.$ts[$i].'/js/funciones.js', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php header("Location: ../"); ?>';$fh=fopen('../'.$ts[$i].'/css/index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php header("Location: ../"); ?>';$fh=fopen('../'.$ts[$i].'/js/index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php header("Location: ../"); ?>';$fh=fopen('../'.$ts[$i].'/img/index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class entradaController extends baseControl {

	public $valor;
	public $obj;
	public $log;

	public function __construct(){
		include_once("model/entradaModel.php");$this->obj = new entradaMod();$this->obj->tabla=PERFIL;
		include_once("model/departamentosModel.php");
	}

	public function index(){
		$user=limpia($_POST["username"]);
		$clave=limpia($_POST["password"]);
		if(isset($_POST["recordar"]) && limpia($_POST["recordar"])==1){$recordar=1;}else{$recordar=0;}
		$data["secret"] = GOOGLE_CLAVE_SECRETA;$data["response"] = $_POST["g-recaptcha-response"];$data["remoteip"] = $_SERVER["REMOTE_ADDR"];
		$pave = $this->http_post("https://www.google.com/recaptcha/api/siteverify",$data);$llega = json_decode($pave["content"],true);
		if($llega["success"] == true){
			if($user!="" && $clave!=""){
				$rs = $this->obj->verificar($user,$clave);
				if(!$rs->EOF){
					$_SESSION["JC_UserID"] = $rs->fields["id"];
					$_SESSION["JC_Nombre"] = $rs->fields["nombre"];
					$_SESSION["JC_Apellido"] = $rs->fields["apellido"];
					$_SESSION["JC_Email"] = $rs->fields["email"];
					$_SESSION["JC_Grupo"] = PERFIL;
					$_SESSION["JC_Estado"] = $rs->fields["estado"];
					if($recordar){
						$llave = crypt($_SESSION["JC_UserID"]."~".FIRMA."~".$_SESSION["JC_Email"], "rl");
						setcookie("id", $_SESSION["JC_UserID"], time()+60*60*24*15, PATO);
						setcookie("email", $_SESSION["JC_Email"], time()+60*60*24*15, PATO);
						setcookie("carpeta", PERFIL, time()+60*60*24*15, PATO);
						setcookie("llave", $llave, time()+60*60*24*15, PATO);
					}
					if(isset($_SESSION["idout"]) && $_SESSION["idout"]>0){
						$va=$_SESSION["idout"];
						unset($_SESSION["procesoout"]);unset($_SESSION["fechaout"]);
						header("Location: ".PATO."procesos/ver/".$va."/");
					}else{
						header("Location: ".PATO);
					}
				}else{
					$_SESSION["alertas"]=_("Los datos ingresados, no coinciden en la base de datos, por favor intente de nuevo");
					header("Location: ".PATO);
				}
			}else{
				$_SESSION["alertas"]=__("Por favor escriba el usuario y la contraseña.");
				header("Location: ".PATO);
			}
		}else{
			$_SESSION["alertas"]=__("Por favor defina que ud no es un robot.");
			header("Location: ".PATO);
		}
	}	

	public function salir(){
		setcookie("id",0,time() - 9900, PATO);
		setcookie("email","",time() - 9900, PATO);
		setcookie("llave","",time() - 9900, PATO);
		unset($_SESSION["JC_UserID"]);
		unset($_SESSION["JC_Nombre"]);
		unset($_SESSION["JC_Apellido"]);
		unset($_SESSION["JC_Email"]);
		unset($_SESSION["JC_Grupo"]);
		unset($_SESSION["JC_Estado"]);
		header("Location: ".PATO);
	}

	public function registro(){
		$departamentosobj = new departamentosMod();$departamentos = $departamentosobj->listar();
		if(isset($_POST["departamento"]) && limpia($_POST["departamento"])){$ciudad=limpia($_POST["departamento"]);}else{$departamento="";}
		if(isset($_POST["cl"]) && limpia($_POST["cl"])){$cl=limpia($_POST["cl"]);}else{$cl=0;}
		include("view/_header.php");
		include("view/entrada_registro.php");
		include("view/_footer.php");
	}

	public function registrando(){
		$entra = limpia2($_POST);
		if(limpia($_POST["clave"])==limpia($_POST["clave2"])){
			$ret = $this->obj->registrando($_POST);
			if($ret>0){
				$_POST["username"]=$entra["email"];
				$_POST["password"]=$entra["clave"];
				$this->index();
			}else{
				$_SESSION["alertas"]=__("Problema al registrar");
				header("Location: ".PATO.MODULO."/");exit;
			}
		}else{
			$_SESSION["alertas"]=__("Las Claves no coinciden");
			header("Location: ".PATO.MODULO."/");exit;
		}
	}

	public function verificaEmail(){
		$sale = $this->obj->verificaEmail($this->valor[0]);
		echo ($sale==0)?"1":"0";exit;
	}

	public function olvidoclave(){
		include("view/entrada_olvidoclave.php");
	}

	public function recordando(){
		$email = limpia($_POST["email"]);
		$rs = $this->obj->olvidopass($email);
		if(!$rs->EOF){
			$mail  = new PHPMailer();
			$mail->IsSMTP();$mail->SMTPAuth = MAIL_AUTH;$mail->Host = MAIL_SERVER;
			$mail->Port = MAIL_PORT;$mail->Username = MAIL_USER;$mail->Password = MAIL_PASS;
			$body  = file_get_contents(MIURL.PATO."mails/recordar/".$_SESSION["JC_PaisJX"]."/".$email."/".$rs->fields["clave"]."/".urlencode($rs->fields["nombre"])."/");
			$mail->SetFrom(MAIL_MAIL,MAIL_NAME);$mail->AddReplyTo(MAIL_MAIL,MAIL_NAME);
			$mail->AddAddress($email,$rs->fields["nombre"]);
			$mail->Subject = __("Clave de ".MAIL_NAME);
			$mail->MsgHTML($body);
			$mail->AddAttachment(MAIL_LOGO,MAIL_LOGO_NAME);
			if(!$mail->Send()){echo "Mailer Error: " . $mail->ErrorInfo;}
			$_SESSION["alertas"] = __("Se ha enviado su clave a su correo electronico");
			header("Location: ".PATO);exit;
		}else{
			$_SESSION["alertas"] = __("Su EMail no esta en nuestra base de datos de '.$ts[$i].'");
			header("Location: ".PATO);exit;
		}
	}

	public function http_post($url,$data){
		$data_url = http_build_query($data);
		$data_len = strlen($data_url);
		return array (
			"content"=>file_get_contents (
				$url,
				false,
				stream_context_create(
					array (
						"http"=>array (
							"method"=>"POST",
							"header"=>"Content-Type: application/x-www-form-urlencoded\r\nConnection: close\r\nContent-Length: $data_len\r\n",
							"content"=>$data_url
						)
					)
				)
			),
			"headers"=>$http_response_header
		);
	}


}

';
			$fh=fopen('../'.$ts[$i].'/controller/entradaController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class indexController extends baseControl {

	public $valor;
	public $pro;
	public $entra;

	public function __construct(){
		include_once("model/indexModel.php");
		include_once("model/entradaModel.php");$this->entra = new entradaMod();$this->entra->tabla=PERFIL;
	}

	public function index(){
		if(isset($_COOKIE["email"]) && $_COOKIE["email"]!="" && !isset($_SESSION["JC_UserID"])){
			$llave = crypt($_COOKIE["id"]."~".FIRMA."~".$_COOKIE["email"], "rl");
			if($_COOKIE["carpeta"]=="'.PPUBLICO.'"){
				if($_COOKIE["llave"]==$llave){
					$rs = $this->entra->verificacookie($_COOKIE["id"],$_COOKIE["email"]);
					if(!$rs->EOF){
						$_SESSION["JC_UserID"] = $rs->fields["id"];
						$_SESSION["JC_Nombre"] = $rs->fields["nombre"];
						$_SESSION["JC_Email"] = $rs->fields["email"];
						$_SESSION["JC_Grupo"] = PERFIL;
						$_SESSION["JC_Estado"] = $rs->fields["estado"];
						$llave = crypt($_SESSION["JC_UserID"]."~".FIRMA."~".$_SESSION["JC_Email"], "rl");
						setcookie("id", $_SESSION["JC_UserID"], time()+60*60*24*15, PATO);
						setcookie("email", $_SESSION["JC_Email"], time()+60*60*24*15, PATO);
						setcookie("carpeta", PERFIL, time()+60*60*24*15, PATO);
						setcookie("llave", $llave, time()+60*60*24*15, PATO);
						header("Location: ".PATO);
					}
				}
			}
			if($_COOKIE["carpeta"]!=PERFIL){header("Location: ".PATU."entrada/salir/");exit;}
		}
		include("view/_header.php");
		if(ifaut()){include("view/index_interno.php");}else{include("view/index_index.php");}
		include("view/_footer.php");
	}

	public function idioma(){
		if($this->valor==1){$_SESSION["JC_Idioma"]="esco";}else{$_SESSION["JC_Idioma"]="enus";}
		header("Location: ".PATO);
	}

	public function captcha(){
		$_SESSION["string"] = substr(md5(rand()), 0, 5);
		$captcha = imagecreatetruecolor(130, 40);
		$color = rand(128, 160);
		$background_color = imagecolorallocate($captcha, $color, $color, $color);
		imagefill($captcha, 0, 0, $background_color);
		$string = $_SESSION["string"];
		$font = "../fonts/arial.ttf";
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


}

';
			$fh=fopen('../'.$ts[$i].'/controller/indexController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class mailsController extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		include("view/mails_header.php");
	}

	function __destruct() {
		include("view/mails_footer.php");
	}

	public function index(){
		include("view/mails_index.php");
	}

	public function alta(){
		include("view/mails_alta.php");
	}

	public function recordar(){
		include("view/mails_recordar.php");
	}

	public function contacto(){
		include("view/mails_contacto.php");
	}


}

';
			$fh=fopen('../'.$ts[$i].'/controller/mailsController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class contactosController extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		veraut();
	}

	public function index(){
		include("view/_header.php");
		include("view/contactos_index.php");
		include("view/_footer.php");
	}

	public function contactando(){
		$entra = limpia2($_POST);
		$_SESSION["asunto"]=__("Contacto Web");
		$_SESSION["mensaje"]=limpia($_POST["mensaje"]);
		$body  = file_get_contents(MIURL.PATO."mails/contacto/?id=".urlencode($_SESSION["JC_UserID"])."&asunto=".urlencode($asunto->fields["asunto"])."&msg=".urlencode(limpia($_POST["mensaje"])));
		$mail  = new PHPMailer();
		$mail->IsSMTP();$mail->SMTPAuth = MAIL_AUTH;$mail->Host = MAIL_SERVER;$mail->Port = MAIL_PORT;$mail->AddReplyTo(MAIL_MAIL,MAIL_NAME);
		$mail->Username = MAIL_USER;$mail->Password = MAIL_PASS;$mail->AddAttachment(MAIL_LOGO,MAIL_LOGO_NAME);$mail->SetFrom(MAIL_MAIL,MAIL_NAME);
		$mail->AddAddress($asunto->fields["para"]);
		//$mail->AddBCC("jcjavier@hotmail.com", "Javier Cruz");
		$mail->Subject = __($asunto->fields["asunto"]);$mail->MsgHTML($body);
		if(!$mail->Send()){echo "Mailer Error: " . $mail->ErrorInfo;}
		header("Location: ".PATO."contactos/gracias/");exit;
	}

	public function gracias(){
		include("view/_header.php");
		include("view/contactos_gracias.php");
		include("view/_footer.php");
	}


}

';
			$fh=fopen('../'.$ts[$i].'/controller/contactosController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class departamentosController extends baseControl {

	public $obj;
	public $valor;

	public function __construct(){
		veraut();
		include_once("model/departamentosModel.php");$this->obj = new departamentosMod();
	}

	public function index(){
		if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		include("view/_header.php");
		include("view/departamentos_index.php");
		include("view/_footer.php");
	}

	public function ver(){
		$sale = $this->obj->ver($this->valor[0]);
		include("view/_header.php");
		include("view/departamentos_".PROCESO.".php");
		include("view/_footer.php");
	}


}
';
			$fh=fopen('../'.$ts[$i].'/controller/departamentosController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class ciudadesController extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		include_once("model/ciudadesModel.php");$this->obj = new ciudadesMod();
	}

	public function index(){
		if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		include("view/_header.php");
		include("view/ciudades_index.php");
		include("view/_footer.php");
	}

	public function ver(){
		$sale = $this->obj->ver($this->valor[0]);
		include("view/_header.php");
		include("view/ciudades_ver.php");
		include("view/_footer.php");
	}

	public function filtrar(){
		if(count($_POST)>0){
			$llega = limpia2($_POST);
			$sale = $this->obj->filtrar($llega);$msg=0;
		}else{
			if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		}
		include("view/_header.php");
		include("view/ciudades_index.php");
		include("view/_footer.php");
	}

	public function seleccion(){
		$llega["departamento_id"] = limpia($this->valor[0]);
		$sale = $this->obj->filtrar($llega);$msg=0;
		include("view/ciudades_seleccion.php");
	}

	public function agregar(){
		include("view/_header.php");
		include("view/ciudades_agregar.php");
		include("view/_footer.php");
	}

	public function agregando(){
		veraut();
		$entra = limpia2($_POST);
		$entra["creado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->agregando($entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se agrego la informacion"):ierror().__("Problema al agregar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function editar(){
		$sale = $this->obj->editar($this->valor[0]);
		include("view/_header.php");
		include("view/ciudades_editar.php");
		include("view/_footer.php");
	}

	public function editando(){
		veraut();
		$entra = limpia2($_POST);
		$entra["editado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se actualizo la informacion"):ierror().__("Problema al editar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function eliminar(){
		veraut();
		$ret = $this->obj->eliminar($this->valor[0]);
		$_SESSION["alertas"]=($ret)?iok().__("Se elimino correctamente"):ierror().__("Problema al eliminar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function activar(){
		veraut();
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=1;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Activo correctamente"):ierror().__("Problema al Activar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function desactivar(){
		veraut();
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=0;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Desactivo correctamente"):ierror().__("Problema al Desactivar");
		header("Location: ".PATO."ciudades/");exit;
	}


}

';
			$fh=fopen('../'.$ts[$i].'/controller/ciudadesController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
class nadaController{public $EOF=1;public function index(){echo "";}}
';
			$fh=fopen('../'.$ts[$i].'/controller/nadaController.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
include("../admin/model/indexModel.php");
class indexMod extends indexModel {


}
';
			$fh=fopen('../'.$ts[$i].'/model/indexModel.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
include("../admin/model/departamentosModel.php");
class departamentosMod extends departamentosModel {


}
';
			$fh=fopen('../'.$ts[$i].'/model/departamentosModel.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
include("../admin/model/entradaModel.php");
class entradaMod extends entradaModel {


}
';
			$fh=fopen('../'.$ts[$i].'/model/entradaModel.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
include("../admin/model/mailsModel.php");
class mailsMod extends mailsModel {


}
';
			//$fh=fopen('../'.$ts[$i].'/model/mailsModel.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<?php
include("../admin/model/textosModel.php");
class textosMod extends textosModel {


}
';
			//$fh=fopen('../'.$ts[$i].'/model/textosModel.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<!DOCTYPE html>
<html lang="es-CO">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Javier Cruz jcjavier@hotmail.com">
<title><?php echo TITULO; ?></title>
<link type="image/x-icon" rel="icon" href="<?php echo PATU; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo PATO; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/uploadifive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/tether.min.css" />
<!--[if lt IE 9]>
<script src="<?php echo PATU; ?>js/html5shiv.js"></script>
<script src="<?php echo PATU; ?>js/respond.min.js"></script>
<![endif]-->
<script type="application/javascript" src="<?php echo JQUERY; ?>"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery-ui.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.uploadifive.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.placeholder.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.timer.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.pager.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.popupWindow.js"></script>
<!--
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/ckeditor.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/adapters/jquery.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckfinder/ckfinder.js"></script>
-->
<script type="application/javascript" src="<?php echo PATU; ?>js/jcfw.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="<?php echo PATO; ?>js/funciones.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if(MODULO=="index" && PROCESO=="index"){ ?><script type="application/javascript" src="https://www.google.com/recaptcha/api.js"></script><?php } ?>
<script>
var focux=0;
var dateconf = {
	dateFormat: "yy-mm-dd", altFormat: "yy-mm-dd", numberOfMonths: 1, dayNamesMin: ["<?php echo __("Do"); ?>", "<?php echo __("Lu"); ?>", "<?php echo __("Ma"); ?>", "<?php echo __("Mi"); ?>", "<?php echo __("Ju"); ?>", "<?php echo __("Vi"); ?>", "<?php echo __("Sa"); ?>"],
	monthNames: ["<?php echo __("Enero"); ?>", "<?php echo __("Febrero"); ?>", "<?php echo __("Marzo"); ?>", "<?php echo __("Abril"); ?>", "<?php echo __("Mayo"); ?>","<?php echo __("Junio"); ?>", "<?php echo __("Julio"); ?>", "<?php echo __("Agosto"); ?>", "<?php echo __("Septiembre"); ?>","<?php echo __("Octubre"); ?>", "<?php echo __("Noviembre"); ?>", "<?php echo __("Diciembre"); ?>"],
	monthNamesShort: ["<?php echo __("Ene"); ?>", "<?php echo __("Feb"); ?>", "<?php echo __("Mar"); ?>", "<?php echo __("Abr"); ?>", "<?php echo __("May"); ?>", "<?php echo __("Jun"); ?>", "<?php echo __("Jul"); ?>", "<?php echo __("Ago"); ?>","<?php echo __("Sep"); ?>", "<?php echo __("Oct"); ?>", "<?php echo __("Nov"); ?>", "<?php echo __("Dic"); ?>"]
};
var edadconf = {
	dateFormat: "yy-mm-dd", altFormat: "yy-mm-dd", numberOfMonths: 1, dayNamesMin: ["<?php echo __("Do"); ?>", "<?php echo __("Lu"); ?>", "<?php echo __("Ma"); ?>", "<?php echo __("Mi"); ?>", "<?php echo __("Ju"); ?>", "<?php echo __("Vi"); ?>", "<?php echo __("Sa"); ?>"],
	monthNames: ["<?php echo __("Enero"); ?>", "<?php echo __("Febrero"); ?>", "<?php echo __("Marzo"); ?>", "<?php echo __("Abril"); ?>", "<?php echo __("Mayo"); ?>","<?php echo __("Junio"); ?>", "<?php echo __("Julio"); ?>", "<?php echo __("Agosto"); ?>", "<?php echo __("Septiembre"); ?>","<?php echo __("Octubre"); ?>", "<?php echo __("Noviembre"); ?>", "<?php echo __("Diciembre"); ?>"],
	monthNamesShort: ["<?php echo __("Ene"); ?>", "<?php echo __("Feb"); ?>", "<?php echo __("Mar"); ?>", "<?php echo __("Abr"); ?>", "<?php echo __("May"); ?>", "<?php echo __("Jun"); ?>", "<?php echo __("Jul"); ?>", "<?php echo __("Ago"); ?>","<?php echo __("Sep"); ?>", "<?php echo __("Oct"); ?>", "<?php echo __("Nov"); ?>", "<?php echo __("Dic"); ?>"],
	changeMonth: true, changeYear: true, maxDate: "-18y", yearRange: ("<?php echo date("Y")-90; ?>:<?php echo date("Y")-18; ?>")};
$(function(){
	window.onresize=function(){centrar();};
	$(".movido").draggable({handle:"#dragon",stop:function(event,ui){
		var x = parseInt($("#popup1").css("left"));var y = parseInt($("#popup1").css("top"));
		var cx = x + $("#popup1").width();var cy = y - 8;
		$("#cerrarpopup").css("left",cx+"px");$("#cerrarpopup").css("top",cy+"px");
	}});
	MM_preloadImages("<?php echo PATU; ?>img/loading.gif","<?php echo PATU; ?>img/loading2.png","<?php echo PATU; ?>img/loading3.gif","<?php echo PATU; ?>img/loader.gif");
	$(".open").popupWindow();
	$("#fondo").on("click",function(){cerrarpopup();});
	<?php if(isset($_SESSION["alertas"])){ ?>alerta1(\'<?php echo $_SESSION["alertas"]; ?>\');<?php unset($_SESSION["alertas"]);} ?>
});
</script>
</head>
<body>
<div class="container-fluid bordeext1" itemscope itemtype="http://schema.org/WebPage">
	<div class="row bordeint1<?php if(!ifaut()){ ?> align-items-center<?php } ?>">
		<div class="col-12 col-sm-3" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><img src="<?php echo LOGO; ?>" border="0" itemprop="contentUrl" /></div>
		<div class="col-12 col-sm-9">
			<h4 class="text-right" itemprop="name"><?php echo __("Sistema de '.$ts[$i].'"); ?></h4>
			<?php if(ifaut()){ ?>
			<div class="row">
				<div class="col-12 text-right" itemprop="customer" itemscope itemtype="http://schema.org/Person"><?php echo __("Conectado como"); ?>: <span itemprop="name"><?php echo $_SESSION["JC_Nombre"]; ?></span> <a href="<?php echo PATO; ?>entrada/salir/" class="btn btn-danger btn-sm" role="button"><span class="hidden-xs-down"><?php echo __("Cerrar Sesión"); ?> </span><i class="fas fa-sign-out"></i></a></div>
			</div>
			<div class="row">
				<div class="col-12"><?php include("_menu.php"); ?></div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12">

';
			$fh=fopen('../'.$ts[$i].'/view/_header.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='	</div>
</div>

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="footer" align="center">
	<p><a href="<?php echo MIURL; ?>" target="_blank" class="blanco"><?php echo MIURL; ?></a> - <?php echo __("® Todos los derechos reservados.")." ".date("Y"); ?> - IngenioSoft.com</p>
</div>

</div>


<div id="fondo"></div><div id="popup1"></div>

<div class="hidden"><?php print_r($_COOKIE); ?></div>
<iframe width="1" height="1" frameborder="0" name="nmprimir" id="imprimir" src="<?php echo PATO; ?>nada/"></iframe>
<script>$(function(){jf_fin();});</script>
<script type="application/javascript" src="<?php echo PATU; ?>js/tether.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/bootstrap.min.js"></script>
</body></html>
';
			$fh=fopen('../'.$ts[$i].'/view/_footer.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='
<h4 class="text-right"><?php echo __("Perfil de '.$ts[$i].'"); ?></h4>
<div class="row text-right">
	<div class="col-12"><?php echo __("Conectado como"); ?>: <?php echo $_SESSION["JC_Nombre"]; ?> <a href="<?php echo PATO; ?>entrada/salir/" class="btn btn-danger btn-sm" role="button"><span class="hidden-xs-down"><?php echo __("Cerrar Sesión"); ?> </span><i class="fas fa-sign-out"></i></a></div>
</div>
<?php if($_SESSION["JC_Estado"]==0){ ?>
<div class="row">
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo __("Su registro se encuentra en verificación"); ?>
</div>
</div>
<?php } ?>
';
			//$fh=fopen('../'.$ts[$i].'/view/_login.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='
<h4 class="text-right"><?php echo __("Usted está en el área de '.$ts[$i].'"); ?></h4>
<div class="row text-right">
	<div class="col-12"><a href="<?php echo PATO; ?>entrada/registro/" class="blanco"><?php echo __("Registro"); ?></a></div>
</div>
<form method="post" action="<?php echo PATO; ?>entrada/" name="<?php echo MODULO; ?>-entrada" id="<?php echo MODULO; ?>-entrada">
<div class="row">
	<div class="col-2"><a href="JavaScript:;" onClick="ffbb()"><img src="<?php echo PATU; ?>img/login_facebook.png" border="0" /></a></div>
	<div class="col-2"><input type="email" id="username" name="username" placeholder="<?php echo __("Email"); ?>" class="form-control" data-placement="bottom" data-original-title="<?php echo __(\'Dato requerido\'); ?>" data-content="<?php echo __(\'Por favor escriba su nombre de usuario\'); ?>" /></div>
	<div class="col-2"><input type="password" id="password" name="password" placeholder="<?php echo __("Clave"); ?>" class="form-control" data-placement="bottom" data-original-title="<?php echo __(\'Dato requerido\'); ?>" data-content="<?php echo __(\'Por favor escriba su Clave\'); ?>" /><br /><a href="JavaScript:;" onClick="olvidoclc(\'<?php echo PATO; ?>entrada/olvidoclave/\');"><?php echo __("Olvide mi clave"); ?></a></div>
	<div class="col-4"><div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_CLAVE_SITIO; ?>"></div></div>
	<div class="col-2"><button type="submit" class="btn btn-primary btn-block" data-loading-text="Verificando..."><?php echo __("Entrar"); ?></button></div>
</div>
<input type="hidden" name="desde" id="desde" value="<?php echo MODULO; ?>" />
</form>
<script type="application/javascript">
var pavem=0;var me="#<?php echo MODULO; ?>-entrada";
$(function(){
	$(me+" #username").focus();
	$(me).submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($(me+" #username").val()==""){
			if(err==0)$(me+" #username").focus();
			err++;$(me+" #username").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}
		if($(me+" #password").val()==""){
			if(err==0)$(me+" #password").focus();
			err++;$(me+" #password").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
/*
window.fbAsyncInit = function() {
	FB.init({appId: \'<?php echo YOUR_APP_ID; ?>\',status: true,cookie: true,xfbml: true,oauth: true});
	FB.Event.subscribe(\'auth.login\', function(response){
		$.ajax({type:\'GET\',url:\'<?php echo PATO; ?>ajax/fbin/\',success: function(a){if(a==1){window.location.reload();}}});
	});
	FB.Event.subscribe(\'auth.logout\', function(response){});
};
(function(d){
	var js, id = \'facebook-jssdk\';if(d.getElementById(id)){return;}js = d.createElement(\'script\');js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";d.getElementsByTagName(\'head\')[0].appendChild(js);
}(document));
function ffbb(){
	FB.login(function(response){
		if(response.authResponse){window.location=\'<?php echo MIURL.PATO; ?>entrada/facebook/\';}else{console.log(\'User cancelled login or did not fully authorize.\');}
	},{scope: \'<?php echo FB_SCOPE; ?>\'});
}
*/
function ffbb(){
	alert("descomentar la funcion ffbb y borrar este comentario.");
}
</script>
';
			//$fh=fopen('../'.$ts[$i].'/view/_logout.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='
<h4><?php echo __("Gracias por contactarse con nosotros"); ?></h4>

<div class="row">&nbsp;</div>

<div class="row"><?php echo __("La información que usted envió es la siguiente"); ?></div>

<div class="row">
	<div class="col-4"><?php echo __("Asunto"); ?></div>
	<div class="col-8"><?php echo $_SESSION["asunto"]; ?></div>
</div>

<div class="row">
	<div class="col-4"><?php echo __("Mensaje"); ?></div>
	<div class="col-8"><?php echo $_SESSION["mensaje"]; ?></div>
</div>

<div class="row">&nbsp;</div>

<div class="row"><button type="button" onClick="location.href=\'<?php echo PATO; ?>\';"><?php echo __("Inicio"); ?></button></div>

<div class="row">&nbsp;</div>

';
			$fh=fopen('../'.$ts[$i].'/view/contactos_gracias.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='
<h4><?php echo __("Contacto"); ?></h4>

<form action="<?php echo PATO; ?>contactos/contactando/" method="post" id="contactando" name="contactando">

<div class="row">
	<div class="col-4"><?php echo __("Asunto"); ?></div>
	<div class="col-8"><input type="text" name="asunto" id="asunto" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba un asunto"); ?>" /></div>
</div>

<div class="row">
	<div class="col-4"><?php echo __("Mensaje"); ?></div>
	<div class="col-8"><textarea name="mensaje" id="mensaje" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba un mensaje"); ?>"></textarea></div>
</div>

<div class="row">&nbsp;</div>

<div class="row"><button type="submit"><?php echo __("Enviar"); ?></button></div>

<div class="row">&nbsp;</div>

</form>


<script type="application/javascript">
$(function(){
	$("#contactando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($("#asunto").val()==""){
			if(err==0)$("#asunto").focus();err++;$("#asunto").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}
		if($("#mensaje").val()==""){
			if(err==0)$("#mensaje").focus();err++;$("#mensaje").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>

';
			$fh=fopen('../'.$ts[$i].'/view/contactos_index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<div style="border-radius:5px;padding:5px;" class="alert alert-info" align="center">
<a id="cerrarpopup" class="close" data-dismiss="alert" href="#" onClick="cerrarpopup()">&times;</a>
<form id="entrada_olvido" name="entrada_olvido" method="post" action="<?php echo PATO; ?>entrada/recordando/">
<table width="350" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td scope="row" align="left">&nbsp;</td>
    <td colspan="2" align="left" scope="row"><?php echo __("Por favor escriba su E-Mail para enviarle su clave") ?>.</td>
    <td scope="row" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo __("Email"); ?></td>
    <td><input name="email" type="email" id="email" class="sombrai" style="width:200px;" placeholder="E-Mail" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row" align="center">&nbsp;</td>
    <td scope="row" align="center">&nbsp;</td>
    <td align="left" valign="top" scope="row"><button type="submit" class="btn btn-info"><?php echo __("Enviar"); ?></button></td>
    <td scope="row" align="center">&nbsp;</td>
  </tr>
</table>
</form>
</div>
<script type="application/javascript">
$(function(){
	$("#entrada_olvido").submit(function(){
		var err=0;$(".brojito").removeClass("brojito");$(".err").hide();

		if($("#entrada_olvido #email").val()==""){
			$("#entrada_olvido #email").focus();err++;$("#entrada_olvido #email").addClass("brojito");
		}else{
			if(!valmail($("#entrada_olvido #email").val())){
				$("#entrada_olvido #email").focus();err++;$("#entrada_olvido #email").addClass("brojito");
			}
		}

		$("input, textarea").placeholder();
		if(err==0){return true;}else{return false;}
	});
});
</script>
';
			$fh=fopen('../'.$ts[$i].'/view/entrada_olvidoclave.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='
<h4><?php echo __("Registro de '.$ts[$i].'"); ?></h4>

<div class="row">&nbsp;</div>

<form id="registro" name="registro" method="post" action="<?php echo PATO; ?>entrada/registrando/" enctype="multipart/form-data">

<div class="row">
	<div class="col-5"><?php echo __("Email"); ?></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5">&nbsp;</div>
</div>
<div class="row">
	<div class="col-5"><input name="email" type="email" id="email" tabindex="1" required class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __(""); ?>" /></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><img src="<?php echo PATO; ?>img/loading2.png" border="0" alt="<?php echo __("Verificando..."); ?>" data-toggle="tooltip" title="<?php echo __("Verificando..."); ?>" id="vv2" class="hidden" /><img src="<?php echo PATO; ?>img/gifs/006.gif" border="0" alt="<?php echo __("Verificado"); ?>" data-toggle="tooltip" title="<?php echo __("Verificado"); ?>" id="mailsi" class="hidden" /><img src="<?php echo PATO; ?>img/gifs/003.gif" border="0" alt="<?php echo __("Su direccion de email ya esta en nuestra base de datos"); ?>" data-toggle="tooltip" title="<?php echo __("Su direccion de email ya esta en nuestra base de datos"); ?>" id="mailno" class="hidden" /><input type="hidden" name="mailtrue" id="mailtrue" value="0" /></div>
</div>

<div class="row">
	<div class="col-5"><?php echo __("Clave"); ?></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><?php echo __("Verificar Clave"); ?></div>
</div>
<div class="row">
	<div class="col-5"><input name="clave" type="password" id="clave" tabindex="2" required class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __(""); ?>" /></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><input name="clave2" type="password" id="clave2" tabindex="3" required class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Las Claves no coinciden"); ?>" /></div>
</div>

<div class="row">
	<div class="col-5"><?php echo __("Nombres"); ?></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><?php echo __("Apellidos"); ?></div>
</div>
<div class="row">
	<div class="col-5"><input name="nombre" type="text" id="nombre" tabindex="4" required class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba su nombre"); ?>" /></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><input name="apellido" type="text" id="apellido" tabindex="5" required class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba su apellido"); ?>" /></div>
</div>

<div class="row">
	<div class="col-5"><?php echo __("Departamento"); ?></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5">&nbsp;</div>
</div>
<div class="row">
	<div class="col-5"></div>
	<div class="col-2">&nbsp;</div>
	<div class="col-5"><select name="departamento_id" id="departamento_id" tabindex="100" required class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Departamento"); ?>">
		<option value="0" selected="selected"><?php echo __("Seleccione Departamento"); ?></option><?php
if($departamentos){
	while(!$departamentos->EOF){ ?>
    	<option value="<?php echo $departamentos->fields["id"]; ?>"><?php echo $departamentos->fields["departamento"]; ?></option><?php
		$departamentos->MoveNext();
	}
	$departamentos->Move(0);
} ?>
</select></div>
</div>

<button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="<?php _(\'Guardando...\'); ?>">
<i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button>

</form>

<script type="application/javascript">
$(function(){
	$("#registro").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($("#mailtrue").val()==0){if(err==0)$("#registro #email").focus();err++;
			$("#registro #email").attr("data-content","<?php echo __("Su Email ya se encuentra registrado en nuestra sistema"); ?>");
			$("#registro #email").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}
		if($("#registro #email").val()==""){if(err==0)$("#registro #email").focus();err++;
			$("#registro #email").attr("data-content","<?php echo __("Por favor escriba su email"); ?>");
			$("#registro #email").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}else{
			if(!valmail($("#registro #email").val())){if(err==0)$("#registro #email").focus();err++;
				$("#registro #email").attr("data-content","<?php echo __("Por favor escriba un EMail valido"); ?>");
				$("#registro #email").addClass("has-error").popover("show").parent("div").addClass("has-error");
			}
		}

		if($("#registro #clave").val()==""){if(err==0)$("#registro #clave").focus();err++;
			$("#registro #clave").addClass("brojito");
			$("#errclave").html("<?php echo __("Por favor escriba una clave"); ?>").show();
		}else{
			if($("#registro #clave").val().length<6){if(err==0)$("#registro #clave").focus();err++;
				$("#registro #clave").addClass("brojito");
				$("#errclave").html("<?php echo __("la clave debe tener minimo 6 caracteres"); ?>").show();
			}
		}

		if($("#registro #clave").val()!=$("#registro #clave2").val()){if(err==0)$("#registro #clave2").focus();err++;
			$("#registro #clave2").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if($("#nombre").val()==""){if(err==0)$("#nombre").focus();err++;
			$("#nombre").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if($("#apellido").val()==""){if(err==0)$("#apellido").focus();err++;
			$("#apellido").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if($("#telefono_movil").val()==""){if(err==0)$("#telefono_movil").focus();err++;
			$("#telefono_movil").attr("data-content","<?php echo __("Por favor escriba un numero telefonico"); ?>");
			$("#telefono_movil").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}else{
			if($("#telefono_movil").val().length<6){if(err==0)$("#telefono_movil").focus();err++;
				$("#telefono_movil").attr("data-content","<?php echo __("el numero es muy corto"); ?>");
				$("#telefono_movil").addClass("has-error").popover("show").parent("div").addClass("has-error");
			}
		}

		if($("#telefono_fijo").val()==""){if(err==0)$("#telefono_fijo").focus();err++;
			$("#telefono_fijo").attr("data-content","<?php echo __("Por favor escriba un telefono"); ?>");
			$("#telefono_fijo").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}else{
			if($("#telefono_fijo").val().length<6){if(err==0)$("#telefono_fijo").focus();err++;
				$("#telefono_fijo").attr("data-content","<?php echo __("el telefono es muy corto"); ?>");
				$("#telefono_fijo").addClass("has-error").popover("show").parent("div").addClass("has-error");
			}
		}

		if($("#direccion").val()==""){if(err==0)$("#direccion").focus();err++;
			$("#direccion").attr("data-content","<?php echo __("Por favor escriba su dirección"); ?>");
			$("#direccion").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}else{
			if($("#direccion").val().length<6){if(err==0)$("#direccion").focus();err++;
				$("#direccion").attr("data-content","<?php echo __("la direccion es muy corta"); ?>");
				$("#direccion").addClass("has-error").popover("show").parent("div").addClass("has-error");
			}
		}

		if($("#departamento").val()==0){if(err==0)$("#departamento").focus();err++;
			$("#departamento").addClass("has-error").popover("show").parent("div").addClass("has-error");
		}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});

	$("#registro #email").on("blur",function(){
		if($("#registro #email").val()!=""){
			$("#btsb").val("   <?php echo __("Verificando..."); ?>   ");
			$("#btsb").attr("disabled","disabled");
			$("#vv2").show();$("#mailsi").hide();$("#mailno").hide();$("#mailtrue").val(0);
			if(pavem!=0)pavem.abort();
			pavem = $.ajax({type: "POST", url: "<?php echo PATO; ?>entrada/verificaEmail/"+$("#registro #email").val()+"/",
				success: function(a){
					$("#vv2").hide();
					if(a==1){$("#mailsi").show();$("#mailno").hide();$("#mailtrue").val(1);}
					else{$("#mailsi").hide();$("#mailno").show();$("#mailtrue").val(0);}
					$("#btsb").val("   <?php echo __("Siguiente"); ?>   ");
					$("#btsb").removeAttr("disabled");
				}
			});
		}
	});


});
</script>
';
			$fh=fopen('../'.$ts[$i].'/view/entrada_registro.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<div class="container">
	<form action="<?php echo PATO; ?>entrada/" method="post" name="<?php echo MODULO; ?>-entrada" class="form-horizontal" id="<?php echo MODULO; ?>-entrada">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-6"><?php
				if(isset($_GET["error"])){ ?><div align="center" class="alert alert-danger"><?php
				if($_GET["error"]==1){echo __("Nombre de usuario o contraseña inválido. Por favor intente nuevamente");}
				if($_GET["error"]==2){echo __("Falta el nombre de usuario o contraseña. Por favor intente nuevamente");}
				if($_GET["error"]==3){echo __("Por favor verifique que usted no es un robot.");}
				?></div><?php }else{echo "&nbsp;";} ?>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-5">
				<div id="fguser" class="form-group">
					<label for="username" class="sr-only"><?php echo __("EMail"); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
						<input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="<?php echo __("EMail"); ?>" />
					</div>
				</div>
				<div id="fgclave" class="form-group">
					<label for="password" class="sr-only"><?php echo __("Contraseña"); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
						<input type="password" class="form-control" id="password" name="password" placeholder="<?php echo __("Clave"); ?>" />
					</div>
				</div>
				<div class="form-group">
				<div class="col-12"><div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_CLAVE_SITIO; ?>"></div></div>
				</div>
				<div class="form-group">
					<div class="col-12"><button id="btentrar" type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in"></i> <?php echo __("Entrar"); ?></button></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
var pavem=0;
$(function(){
	$("#username").focus();
	$("#<?php echo MODULO; ?>-entrada").submit(function(){
		var err=0;$(".has-warning").removeClass("has-warning");$(".form-control-warning").removeClass("form-control-warning");
		$("#btentrar").html(\'<?php echo __("Entrando..."); ?> <i class="fas fa-circle-o-notch fa-spin"></i>\');
		if($("#username").val()==""){
			$("#fguser").addClass("has-warning");$("#username").addClass("form-control-warning");if(err==0)$("#username").focus();err++;
		}
		if($("#password").val()==""){
			$("#fgclave").addClass("has-warning");$("#password").addClass("form-control-warning");if(err==0)$("#password").focus();err++;
		}
		if(err==0){return true;}else{$("#btentrar").html(\'<i class="fas fa-sign-in"></i> <?php echo __("Entrar"); ?>\');return false;}
	});
});
</script>

';
			$fh=fopen('../'.$ts[$i].'/view/index_index.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<h4><?php echo __("Resumen"); ?></h4>

<p><?php echo __("Aca se monta unas estadisticas basicas"); ?></p>

';
			$fh=fopen('../'.$ts[$i].'/view/index_interno.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<p align="justify">Estimado <?php echo utf8_encode(urldecode($this->valor[0])); ?>, su cuenta <?php echo $this->valor[1]; ?> en la aplicacion <?php echo $this->valor[2]; ?> <br/> ha sido activada correctamente</p>';
			$fh=fopen('../'.$ts[$i].'/view/mails_alta.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
</head>

<body>
Correo de contacto<br />
<br />
id: <?php echo $_GET["id"]; ?><br />
asunto: <?php echo $_GET["asunto"]; ?><br />
mensaje: <?php echo $_GET["msg"]; ?>

</body>
</html>';
			$fh=fopen('../'.$ts[$i].'/view/mails_contacto.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='</td></tr></table></td></tr>
<tr><td align="center">&nbsp;</td></tr>
<tr><td align="center"><table border="0" cellpadding="5" cellspacing="0" width="100%" align="center"><tr>
	<td bgcolor="#666666" style="color:#FFFFFF;font-size:10px;" align="center"><a href="<?php echo MIURL.PATO; ?>" style="color:#FFFFFF;"><?php echo MIURL.PATO; ?></a> - ® <?php echo TITULO; ?> es un tema online de IngenioSoft. - <a href="http://www.ingeniosoft.com" style="color:#FFFFFF;">www.ingeniosoft.com</a> - ® Todos los derechos reservados.</td>
</tr></table></td></tr>
<tr><td align="center">&nbsp;</td></tr></table></body></html>';
			$fh=fopen('../'.$ts[$i].'/view/mails_footer.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es-co" />
<title><?php echo TITULO; ?></title>
<style type="text/css">
body {margin:0;font-family:Verdana,Geneva,sans-serif;font-size:14px;color:#444444;background-color:#FFFFFF;}
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
<tr><td align="center">&nbsp;</td></tr>
<tr><td align="center"><table align="center" border="1" width="540" cellspacing="0" cellpadding="15" bgcolor="#FFFFFF"><tr>
<td><img src="<?php echo MAIL_LOGO_NAME; ?>" border="0" /><br /><br />
';
			$fh=fopen('../'.$ts[$i].'/view/mails_header.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<p>&nbsp;</p>
<p align="justify">Estimado <?php echo utf8_encode(urldecode($this->valor[3])); ?>,
su nombre de usuario es: <?php echo $this->valor[1]; ?>,<br />
y su clave es: <?php echo $this->valor[2]; ?></p>
<p>&nbsp;</p>
<p>Cordialmente,</p>
<p>Equipo de <?php echo TITULO; ?></p>
';
			$fh=fopen('../'.$ts[$i].'/view/mails_recordar.php', "w+");fwrite($fh,$ch);fclose($fh);
			$ch='<div class="titulitos"><?php echo $_SESSION["JC_Nombre"]." ".$_SESSION["JC_Apellido"]; ?></div>

<p>Resumen y/o estadisticas</p>';
			//$fh=fopen('../'.$ts[$i].'/view/resumen_index.php', "w+");fwrite($fh,$ch);fclose($fh);
		} // siclo de perfil completado
		$cod.=')
RewriteRule ^(.*)$ index.php/$1 [L]
';
		$f=fopen('../.htaccess', "w+");fwrite($f,$cod);fclose($f);
	}

	public function otrosfinal(){
		$ch='<?php
class ciudadesController extends baseControl {

	public $valor;
	public $obj;

	public function __construct(){
		include_once("model/ciudadesModel.php");$this->obj = new ciudadesMod();
	}

	public function index(){
		if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		include("view/_header.php");
		include("view/ciudades_index.php");
		include("view/_footer.php");
	}

	public function ver(){
		$sale = $this->obj->ver($this->valor[0]);
		include("view/_header.php");
		include("view/ciudades_ver.php");
		include("view/_footer.php");
	}

	public function filtrar(){
		if(count($_POST)>0){
			$llega = limpia2($_POST);
			$sale = $this->obj->filtrar($llega);$msg=0;
		}else{
			if($this->obj->cantidad()<10001){$sale = $this->obj->listar();$msg=1;}else{$sale=new nada();$msg=2;}
		}
		include("view/_header.php");
		include("view/ciudades_index.php");
		include("view/_footer.php");
	}

	public function seleccion(){
		$llega["departamento_id"] = limpia($this->valor[0]);
		$sale = $this->obj->filtrar($llega);$msg=0;
		include("view/ciudades_seleccion.php");
	}

	public function agregar(){
		include("view/_header.php");
		include("view/ciudades_agregar.php");
		include("view/_footer.php");
	}

	public function agregando(){
		veraut();
		$entra = limpia2($_POST);
		$entra["creado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->agregando($entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se agrego la informacion"):ierror().__("Problema al agregar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function editar(){
		$sale = $this->obj->editar($this->valor[0]);
		include("view/_header.php");
		include("view/ciudades_editar.php");
		include("view/_footer.php");
	}

	public function editando(){
		veraut();
		$entra = limpia2($_POST);
		$entra["editado"]=date("Y-m-d H:i:s");
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se actualizo la informacion"):ierror().__("Problema al editar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function eliminar(){
		veraut();
		$ret = $this->obj->eliminar($this->valor[0]);
		$_SESSION["alertas"]=($ret)?iok().__("Se elimino correctamente"):ierror().__("Problema al eliminar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function activar(){
		veraut();
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=1;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Activo correctamente"):ierror().__("Problema al Activar");
		header("Location: ".PATO."ciudades/");exit;
	}

	public function desactivar(){
		veraut();
		$entra["editado"]=date("Y-m-d H:i:s");
		$entra["estado"]=0;
		$ret = $this->obj->editando($this->valor[0],$entra);
		$_SESSION["alertas"]=($ret)?iok().__("Se Desactivo correctamente"):ierror().__("Problema al Desactivar");
		header("Location: ".PATO."ciudades/");exit;
	}


}

';
		$fh=fopen('../controller/ciudadesController.php', "w+");fwrite($fh,$ch);fclose($fh);

	}

	public function deptosyciudades(){
		$json=file_get_contents("http://wsp.sicom.gov.co:83/sicomdata/DepartamentosBasico/");
		$deptos=json_decode($json,true);
		//print_r($deptos['value']);
		for($i=0;$i<count($deptos['value']);$i++){
			$entra['departamento']=$deptos['value'][$i]['Nombre'];
			$entra['codigo']=$deptos['value'][$i]['Codigo'];
			$entra['creado']=date('Y-m-d H:i:s');
			if($this->db->AutoExecute("departamentos",$entra,"INSERT")==false){$dpid = 0;}else{$dpid = $this->db->INSERT_ID();}
			if($dpid){
				$json2=file_get_contents("http://wsp.sicom.gov.co:83/sicomdata/DepartamentosBasico('".$entra['codigo']."')/Municipios/");
				$ciudades=json_decode($json2,true);
				for($j=0;$j<count($ciudades['value']);$j++){
					//print_r($ciudades['value']);exit;
					$entra2['departamento_id']=$dpid;
					$entra2['ciudad']=$ciudades['value'][$j]['Nombre'];
					$entra2['codigo']=$ciudades['value'][$j]['Codigo'];
					$entra2['creado']=date('Y-m-d H:i:s');
					if($this->db->AutoExecute("ciudades",$entra2,"INSERT")==false){$ciid = 0;}else{$ciid = $this->db->INSERT_ID();}
				}
			}
		}
	}

	public function schematranslateenumvalues2(){
		$sale = $this->dbs->Execute("select n, label from enumvalues2 WHERE etiqueta is NULL order by label asc");
		//print_r($sale);exit;
		if(!$sale->EOF){
			while(!$sale->EOF){
				$nl=$he=0;$tp='';
				$texto = str_split($sale->fields['label'],1);
				foreach($texto as $letra){
					if(ctype_upper($letra)){ //ctype_alnum, ctype_digit, ctype_lower, 
						if($nl && !$he)$tp.=' ';
						$tp.=$letra;
						$he++;
					}else{
						if($he){
							$tp=substr($tp,0,-1).' '.substr($tp,-1).$letra;
						}else{$tp.=$letra;}
						$he=0;
					}
					$nl++;
				}
				if(count($sale->fields['label'])){
					$entra['etiqueta']=$this->tradu->translate('en','es',$tp);
					//echo $tp.': '.$entra['etiqueta'].'<br />';
					if($this->dbs->AutoExecute("enumvalues2",$entra,"UPDATE","n=".$sale->fields['n'])==false)
						{echo 'errn:'.$tp.'<br />';}else{echo 'Ok '.$tp.': '.$entra['etiqueta'].'<br />';}
				}
				$sale->MoveNext();
			}
		}else{echo "No hay ninguna sin traduccion";}
	}

	public function schematranslatetypes2(){
		$sale = $this->dbs->Execute("select n, label from types2 WHERE etiqueta is NULL order by label asc");
		//print_r($sale);exit;
		if(!$sale->EOF){
			while(!$sale->EOF){
				$nl=$he=0;$tp='';
				$texto = str_split($sale->fields['label'],1);
				foreach($texto as $letra){
					if(ctype_upper($letra)){ //ctype_alnum, ctype_digit, ctype_lower, 
						if($nl && !$he)$tp.=' ';
						$tp.=$letra;
						$he++;
					}else{
						if($he){
							$tp=substr($tp,0,-1).' '.substr($tp,-1).$letra;
						}else{$tp.=$letra;}
						$he=0;
					}
					$nl++;
				}
				if(count($sale->fields['label'])){
					$entra['etiqueta']=$this->tradu->translate('en','es',$tp);
					//echo $tp.': '.$entra['etiqueta'].'<br />';
					if($this->dbs->AutoExecute("types2",$entra,"UPDATE","n=".$sale->fields['n'])==false)
						{echo 'errn:'.$tp.'<br />';}else{echo 'Ok '.$tp.': '.$entra['etiqueta'].'<br />';}
				}
				$sale->MoveNext();
			}
		}else{echo "No hay ninguna sin traduccion";}
	}

	public function schematranslateproperties2(){
		$sale = $this->dbs->Execute("select n, label from properties2 WHERE etiqueta is NULL order by label asc");
		//print_r($sale);exit;
		if(!$sale->EOF){
			while(!$sale->EOF){
				$nl=$he=0;$tp='';
				$texto = str_split($sale->fields['label'],1);
				foreach($texto as $letra){
					if(ctype_upper($letra)){ //ctype_alnum, ctype_digit, ctype_lower, 
						if($nl && !$he)$tp.=' ';
						$tp.=$letra;
						$he++;
					}else{
						if($he){
							$tp=substr($tp,0,-1).' '.substr($tp,-1).$letra;
						}else{$tp.=$letra;}
						$he=0;
					}
					$nl++;
				}
				if(count($sale->fields['label'])){
					$entra['etiqueta']=$this->tradu->translate('en','es',$tp);
					//echo $tp.': '.$entra['etiqueta'].'<br />';
					if($this->dbs->AutoExecute("properties2",$entra,"UPDATE","n=".$sale->fields['n'])==false)
						{echo 'errn:'.$tp.'<br />';}else{echo 'Ok '.$tp.': '.$entra['etiqueta'].'<br />';}
				}
				$sale->MoveNext();
			}
		}else{echo "No hay ninguna sin traduccion";}
	}



}

//$type = bigint(20), mediumint(9), smallint(6), tinyint(4), varchar(255), text, date, time, datetime, blob, longblob
//$null = YES, NO
//$key = <<vacio>>, PRI, MUL
//$ext = <<vacio>>, auto_increment

