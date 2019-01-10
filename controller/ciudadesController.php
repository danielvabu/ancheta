<?php
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

