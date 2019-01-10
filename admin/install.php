<?php
/* -------------------------------------------------------------------------
		IS-SunView-JC Ver.2.3.0
		Javier Cruz - jcjavier@hotmail.com
--------------------------------------------------------------------------*/
$miver='2.3.0';
require_once('inc/adodb5/adodb.inc.php');
include_once('inc/config.php');
include_once('inc/db.php');
include_once('inc/funciones.php');
session_start();
include('model/installModel.php');
$obj = new installModel();
if(isset($_GET['hacer']) && $_GET['hacer']=='schematranslate1'){echo $obj->schematranslatetypes2();exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schematranslate2'){echo $obj->schematranslateproperties2();exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schematranslate3'){echo $obj->schematranslateenumvalues2();exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schemaidioma'){echo $obj->mkschematype($_GET['tb'],$_GET['ord']);exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='mkseltxt'){$tt=$_GET['tt'];$nn=$_GET['nn'];$tb=$_GET['tb'];echo $obj->mkseltxt($tt,$nn,$tb);exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schemasproperties'){echo $obj->mkschemaprop($_GET['tb'],$_GET['typ']);exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schemaspropertie2'){echo $obj->mkschemapro2($_GET['tb'],$_GET['typ'],1,$_GET['na']);exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='schemaspropertlan'){echo $obj->mkschemaprop($_GET['tb'],$_GET['pro'],$_GET['ord']);exit;}
if(isset($_GET['hacer']) && $_GET['hacer']=='importardeptosycitys'){$obj->deptosyciudades();echo '1';exit;}
?>
<!DOCTYPE html>
<html lang="es-CO">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Instalador del FrameWork IS-SunView-JC">
<meta name="author" content="Javier Cruz jcjavier@hotmail.com">
<title>Instalando <?php echo TITULO; ?></title>
<link type="image/x-icon" rel="icon" href="<?php echo PATU; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATO; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/uploadifive.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/tether.min.css" />
<style rel="stylesheet" type="text/css"></style>
<script type="application/javascript" src="<?php echo JQUERY; ?>"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery-ui.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.uploadifive.min.js"></script>
<!--script type="application/javascript" src="<?php echo PATU; ?>js/tether.min.js"></script-->
<script type="application/javascript" src="<?php echo PATU; ?>js/popper.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/bootstrap.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.placeholder.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.timer.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.pager.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.popupWindow.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jcfw.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="<?php echo PATO; ?>js/funciones.js"></script>
<script>
var focux=0;
$(function(){
	MM_preloadImages('<?php echo PATO; ?>img/loading2.gif');
	$('.open').popupWindow();
	$('input, select, textarea').on('focusin',function(event){$(this).addClass('sombrabox');});
	$('input, select, textarea').on('focusout',function(event){$(this).removeClass('sombrabox');});
	$("#fondo").on('click',function(){cerrarpopup();});
	<?php if(isset($_SESSION["alertas"])){ ?>alerta1('<?php echo $_SESSION["alertas"]; ?>');<?php unset($_SESSION["alertas"]);} ?>
	$('[data-toggle="tooltip"]').tooltip();
	$('.selschema').on('change',function(){
		var tb=$(this).data('table');var c='';
		var ty = $('#schema_'+tb+' option:selected').val();
		if(ty!=''){
			$.ajax({method: "GET",url:"install.php?hacer=schemasproperties&tb="+tb+"&typ="+ty}).done(function(data){
				$('.tdscpropi_'+tb).each(function(){var queda=data.replace(/CAMCAM/gi,$(this).data('campo'));$(this).html(queda);});
			});
		}else{$('.tdscpropi_'+tb).each(function(){$(this).html('');});}
	});
	$('.selschem2').on('change',function(){
		var tb=$(this).data('table');
		var ca=$(this).data('campo');
		var ty = $(this).find('option:selected').val();
		if(ty!=''){
			$.ajax({method: "GET",url:"install.php?hacer=schemaspropertie2&tb="+tb+"&na="+ca+"&typ="+ty}).done(function(data){
				$('#tdtxt'+tb+ca).each(function(){$(this).html(data);});
			});
		}else{$('#tdtxt'+tb+ca).each(function(){$(this).html('');});}
	});
});
function fnreltxt(tbid,tt,nn){
	if(tbid!=''){
		$('#tdtxt'+tt+nn).html('<img src="<?php echo PATO; ?>img/loading2.gif" border="0" />');
		dato = tbid.split('_');$('#tdtxt'+tt+nn).load('install.php?hacer=mkseltxt&tt='+tt+'&nn='+nn+'&tb='+dato[0]);}
	else{$('#tdtxt'+tt+nn).html('&nbsp;');}
}
function importardeptosycitys(){
	$('#btcdyc').html('<i class="fas fa-database"></i> Cargando... (sicom.gov.co) <i class="fas fa-download"></i> <i class="fas fa-spin fa-circle-o-notch"></i>');
	$.ajax({method: "GET",url:"install.php?hacer=importardeptosycitys"}).done(function(){alert('Se cargaron las tablas');
	$('#btcdyc').html('<i class="fas fa-database"></i> Se cargo la db! <i class="fas fa-download"></i>');});
}
function schemahelp(a){
	var b = $('#schema_'+a+' option:selected').val();
	if(b!=''){jcpop('<iframe src="'+b+'" width="900" height="480" border="0"></iframe>');}
}
function schemahelp2(a,c){
	var b = $(c).parent().find('select option:selected').val();
	if(b!=''){jcpop('<iframe src="http://schema.org/'+b+'" width="900" height="480" border="0"></iframe>');}
}
function schemahelp3(a){
	var b = $('#schem2_'+a+' option:selected').val();
	if(b!=''){jcpop('<iframe src="'+b+'" width="900" height="480" border="0"></iframe>');}
}
function schemaidioma(tb,or){$('#divschema_'+tb).load('install.php?hacer=schemaidioma&tb='+tb+'&ord='+or,function(){
	$('.selschema').on('change',function(){
		var tb=$(this).data('table');var c='';
		var ty = $('#schema_'+tb+' option:selected').val();
		if(ty!=''){
			$.ajax({method: "GET",url:"install.php?hacer=schemasproperties&tb="+tb+"&typ="+ty}).done(function(data){
				$('.tdscpropi_'+tb).each(function(){var queda=data.replace(/CAMCAM/gi,$(this).data('campo'));$(this).html(queda);});
			});
		}else{$('.tdscpropi_'+tb).each(function(){$(this).html('');});}
	});
});}
</script>
</head>
<body style="font-size:14px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col"><?php
if(!isset($_POST['hacer']) && !isset($_GET['hacer'])){
	$tablas = $obj->tablas();
	if(!$tablas->EOF){
		echo '<form action="install.php" name="lawebera" id="lawebera" method="post" target="_blank">
		<h1>Instalando IS-SunView-JC V.'.$miver.' :: Proyecto '.TITULO.'</h1>
		<ol id="accordion">
';
		while(!$tablas->EOF){
			$campos = $obj->campos($tablas->fields['Tables_in_'.DB_DB]);
			$tb = $tablas->fields['Tables_in_'.DB_DB];
			echo '<li style="font-weight:bold;">
';
			echo '<h2>'.$tb;
			if($tb!='admins' && $tb!=PPUBLICO && $tb!='departamentos' && $tb!='ciudades'){echo '
			<label><input type="checkbox" name="perfil_'.$tb.'" id="perfil_'.$tb.'" value="1" /> <i class="fas fa-user" data-toggle="tooltip" title="Crear como Perfil"></i></label>
			<label><input type="checkbox" name="configu_'.$tb.'" id="configu_'.$tb.'" value="1" /> <i class="fas fa-cog" data-toggle="tooltip" title="Menu de configuración"></i></label>
			';}
			if($tb=='departamentos'){echo '
				<button type="button" id="btcdyc" class="btn btn-info" onclick="importardeptosycitys();"><i class="fas fa-database"></i> Importar datos de depto y citys de CO <i class="fas fa-download"></i></button>
				<label><input type="checkbox" name="configu_'.$tb.'" id="configu_'.$tb.'" value="1" /> <i class="fas fa-cog" data-toggle="tooltip" title="Menu de configuración"></i></label>';
			}
			if($tb=='ciudades'){echo '
				<label><input type="checkbox" name="configu_'.$tb.'" id="configu_'.$tb.'" value="1" /> <i class="fas fa-cog" data-toggle="tooltip" title="Menu de configuración"></i></label>';
			}
			if($tb==PPUBLICO){echo '<i class="fas fa-question" data-toggle="tooltip" title="Perfil configurado como publico en config.php"></i>';}
			echo '</h2>
			<div class="row">
				<div class="col"><input type="text" name="singular_'.$tb.'" value="'.$obj->names($tb).'" data-toggle="tooltip" title="Singular" class="form-control mb-2 mr-sm-2 mb-sm-0" /></div>
				<div class="col"><div class="input-group mb-2 mr-sm-2 mb-sm-0" id="divschema_'.$tb.'">';
			echo $obj->mkschematype($tb);
			echo '
			</div></div>
			</div>
';
			if(!$campos->EOF){
				echo '<table border="0" cellpadding="2" cellspacing="1" class="table table-bordered table-striped table-hover table-condensed tablesorter">
					<thead>
						<tr>
							<th align="left" class="thcdtb">Campo / Propiedad</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="poner en Index">I</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="poner en pagina Ver">V</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="poner en form de Adicion">A</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="poner en form de Edicion">E</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="Opcion de borrar registro">D</th>
							<th align="left" class="thcdtb latpadcero" data-toggle="tooltip" title="poner como filtro">F</th>
							<th align="left" class="thcdtb">Relacion ID</th>
							<th align="left" class="thcdtb">Relacion TXT / type</th>
							<th align="left" class="thcdtb">Opciones / Propiedad</th>
						</tr>
					</thead>
					<tbody>
';
				while(!$campos->EOF){
					echo $obj->campoform(
											$tb,
											$campos->fields['Field'],
											$campos->fields['Type'],
											$campos->fields['Null'],
											$campos->fields['Key'],
											$campos->fields['Default'],
											$campos->fields['Extra']
										);
					//echo '<td>';print_r($campos->fields);echo '</td>';
					$campos->MoveNext();
				}
				echo '</tbody></table>
';
			}
			echo '</li>
';
			$tablas->MoveNext();
		}
		echo '</ol><input type="hidden" name="hacer" id="hacer" value="weberiar" />';
		echo '<p align="center"><button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-cog fa-spin"></i> Weberiar</button></p><p>&nbsp;</p></form>';
	}
}
if(isset($_POST['hacer']) && $_POST['hacer']=='weberiar'){
	$tbmenu=$tbmenu0=$tbmenuco='';$htcont=0;$tbusers=0;
	$tablas = $obj->tablas();
	if(!$tablas->EOF){
		echo '<h1>Instalando IS-SunView-JC V.'.$miver.'</h1><ol>
';
		while(!$tablas->EOF){ // si perfil -> Creo directorios
			$tb = $tablas->fields['Tables_in_'.DB_DB];
			if(isset($_POST['perfil_'.$tb]) && $_POST['perfil_'.$tb]==1){
				$htaccess[$htcont++]=$tb;
				if(!is_dir('../'.$tb.'/'))				mkdir('../'.$tb.'/');
				if(!is_dir('../'.$tb.'/controller/'))	mkdir('../'.$tb.'/controller/');
				if(!is_dir('../'.$tb.'/css/'))			mkdir('../'.$tb.'/css/');
				if(!is_dir('../'.$tb.'/img/'))			mkdir('../'.$tb.'/img/');
				if(!is_dir('../'.$tb.'/js/'))			mkdir('../'.$tb.'/js/');
				if(!is_dir('../'.$tb.'/model/'))		mkdir('../'.$tb.'/model/');
				if(!is_dir('../'.$tb.'/view/'))			mkdir('../'.$tb.'/view/');
			}
			if(isset($_POST['configu_'.$tb]) && $_POST['configu_'.$tb]==1){
				$tbmenuco.=$obj->tdcmenu($tb);
			}else{
				$tbmenu0.=$obj->tdmenu($tb);
				if($tb!='admins'){$tbmenu.=$obj->tdmenu($tb);}
			}
			if($tb==PPUBLICO)$tbusers=1;
			$tablas->MoveNext();
		}$tablas->Move(0);
		while(!$tablas->EOF){ // Creo archivos
			$k=0;$rrid=array();$rrna=array();$file1=$file2=$file3='';$kcam=0;$siestado=0;
			$campos = $obj->campos($tablas->fields['Tables_in_'.DB_DB]);
			$tb = $tablas->fields['Tables_in_'.DB_DB];
			if(isset($_POST['singular_'.$tb]) && trim($_POST['singular_'.$tb])!=''){$obj->singular=$_POST['singular_'.$tb];}
			else{$obj->singular=$obj->names($tb);}
			$obj->tbschem=(isset($_POST['schema_'.$tb]) && trim($_POST['schema_'.$tb])!='')?$_POST['schema_'.$tb]:'';
			if($tb!='admins'){
				echo '<li style="font-weight:bold;">';
				echo '<h2>Cosiatando '.$tb.'</h2>';
				$i_head1=$obj->indexhead1($tb);$i_head2=$obj->indexhead2($tb);$ths=$tds=$ftrs=$fsql='';
				$v_head=$obj->vhead($tb);$vtrs='';
				$a_head=$obj->ahead($tb);$atrs=$ascript=$adate='';
				$e_head=$obj->ehead($tb);$etrs=$escript=$edate='';
				if(!$campos->EOF){
					while(!$campos->EOF){
						if(isset($_POST['schema_'.$tb.'_'.$campos->fields['Field']]) && trim($_POST['schema_'.$tb.'_'.$campos->fields['Field']])!=''){$obj->tbtdsche=$_POST['schema_'.$tb.'_'.$campos->fields['Field']];}else{$obj->tbtdsche='';}
						if(isset($_POST['schem2_'.$tb.'_'.$campos->fields['Field']]) && trim($_POST['schem2_'.$tb.'_'.$campos->fields['Field']])!=''){$obj->tbschem2=$_POST['schem2_'.$tb.'_'.$campos->fields['Field']];}else{$obj->tbschem2='';}
						if(isset($_POST['schep2_'.$tb.'_'.$campos->fields['Field']]) && trim($_POST['schep2_'.$tb.'_'.$campos->fields['Field']])!=''){$obj->tbtdsche2=$_POST['schep2_'.$tb.'_'.$campos->fields['Field']];}else{$obj->tbtdsche2='';}
						if($campos->fields['Field']=='id'){$obj->singula2='id';}else{if(isset($_POST['singula2_'.$tb.'_'.$campos->fields['Field']]) && trim($_POST['singula2_'.$tb.'_'.$campos->fields['Field']])!=''){$obj->singula2=$_POST['singula2_'.$tb.'_'.$campos->fields['Field']];}else{$obj->singula2=$obj->namea($campos->fields['Field']);}}
						echo '.';
						$ijj='i_'.$tb.'_'.$campos->fields['Field'];
						$vjj='v_'.$tb.'_'.$campos->fields['Field'];
						$ajj='a_'.$tb.'_'.$campos->fields['Field'];
						$ejj='e_'.$tb.'_'.$campos->fields['Field'];
						$djj='d_'.$tb.'_id';
						$fjj='f_'.$tb.'_'.$campos->fields['Field'];
						$r1j='r_'.$tb.'_'.$campos->fields['Field'];
						$r2j='r2_'.$tb.'_'.$campos->fields['Field'];
						$op1='op1_'.$tb.'_'.$campos->fields['Field'];$oo[1]=(isset($_POST[$op1]))?$_POST[$op1]:'';
						$op2='op2_'.$tb.'_'.$campos->fields['Field'];$oo[2]=(isset($_POST[$op2]))?$_POST[$op2]:'';
						$op3='op3_'.$tb.'_'.$campos->fields['Field'];$oo[3]=(isset($_POST[$op3]))?$_POST[$op3]:'';
						$op4='op4_'.$tb.'_'.$campos->fields['Field'];$oo[4]=(isset($_POST[$op4]))?$_POST[$op4]:'';
						$op5='op5_'.$tb.'_'.$campos->fields['Field'];$oo[5]=(isset($_POST[$op5]))?$_POST[$op5]:'';
						$j=1;$opc=array();
						for($i=1;$i<6;$i++){if($oo[$i]!=''){$opc[$j]=$oo[$i];$j++;}}
						$sifile = substr($campos->fields['Field'],-5);
						$xifile = substr($campos->fields['Field'],0,-5);
						if($sifile=='_file'){$file1.=$obj->file1k($xifile,$k);$file2.=$obj->file2k($xifile,$k);$file3.=$obj->file3k($xifile,$k);$k++;}
						if(isset($_POST[$ijj]) && $_POST[$ijj]==1){
							$ths.=$obj->icampoth($campos->fields['Field']);
							$tds.=$obj->icampotd(	$campos->fields['Field'],
													$campos->fields['Type'],
													(isset($_POST[$r2j]))?$_POST[$r2j]:'',
													$opc
												);
							$kcam++;
						}
						if(isset($_POST[$r1j]) && isset($_POST[$r2j])){
							$rrid[$campos->fields['Field']] = $_POST[$r1j];
							$rrna[$campos->fields['Field']] = $_POST[$r2j];
						}
						if(isset($_POST[$fjj]) && $_POST[$fjj]==1){
							$ftrs.=$obj->ftrs(
												$campos->fields['Field'],
												$campos->fields['Type'],
												$campos->fields['Null'],
												$campos->fields['Key'],
												$campos->fields['Default'],
												$campos->fields['Extra'],
												(isset($_POST[$r1j]))?$_POST[$r1j]:'',
												(isset($_POST[$r2j]))?$_POST[$r2j]:'',
												$opc
											  );
							$fsql.=$obj->fsql(
												$tb,
												$campos->fields['Field'],
												$campos->fields['Type']
											  );
						}
						if(isset($_POST[$vjj]) && $_POST[$vjj]==1){
							$vtrs.=$obj->vcampotr(
													$campos->fields['Field'],
													$campos->fields['Type'],
													(isset($_POST[$r2j]))?$_POST[$r2j]:'',
													$opc
												  );
						}
						if(isset($_POST[$ajj]) && $_POST[$ajj]==1){
							$atrs.=$obj->atrs(
												$campos->fields['Field'],
												$campos->fields['Type'],
												$campos->fields['Null'],
												$campos->fields['Key'],
												$campos->fields['Default'],
												$campos->fields['Extra'],
												(isset($_POST[$r1j]))?$_POST[$r1j]:'',
												(isset($_POST[$r2j]))?$_POST[$r2j]:'',
												$opc
											  );
							$ascript.=$obj->aescript(
													$campos->fields['Field'],
													$campos->fields['Type'],
													$campos->fields['Null'],
													$campos->fields['Key'],
													$campos->fields['Default'],
													$campos->fields['Extra'],
													(isset($_POST[$r1j]))?$_POST[$r1j]:'',
													(isset($_POST[$r2j]))?$_POST[$r2j]:''
												  );
							if($campos->fields['Type']=='date'){$adate.=$obj->scriptdate($campos->fields['Field']);}
						}
						if(isset($_POST[$ejj]) && $_POST[$ejj]==1){
							$etrs.=$obj->etrs(
												$campos->fields['Field'],
												$campos->fields['Type'],
												$campos->fields['Null'],
												$campos->fields['Key'],
												$campos->fields['Default'],
												$campos->fields['Extra'],
												(isset($_POST[$r1j]))?$_POST[$r1j]:'',
												(isset($_POST[$r2j]))?$_POST[$r2j]:'',
												$opc
											  );
							$escript.=$obj->aescript(
													$campos->fields['Field'],
													$campos->fields['Type'],
													$campos->fields['Null'],
													$campos->fields['Key'],
													$campos->fields['Default'],
													$campos->fields['Extra'],
													(isset($_POST[$r1j]))?$_POST[$r1j]:'',
													(isset($_POST[$r2j]))?$_POST[$r2j]:''
												  );
							if($campos->fields['Type']=='date'){$edate.=$obj->scriptdate($campos->fields['Field']);}
						}
						if($campos->fields['Field']=='estado'){$siestado=1;}
						$campos->MoveNext();
					}
				}
				$index_foot=$obj->ifoot($tb,$kcam,(isset($_POST[$djj]))?$_POST[$djj]:'',$siestado);
				$obj->mkind($tb,$i_head1.$ftrs.$i_head2.$ths.$obj->imedtab().$tds.$index_foot);		// crea vista index
				$obj->mkver($tb,$v_head.$vtrs.$obj->vfoot());										// crea vista ver
				$obj->mkadd($tb,$a_head.$atrs.$obj->afoot1($tb,$adate).$ascript.$obj->afoot2($tb));	// crea vista add
				$obj->mkedd($tb,$e_head.$etrs.$obj->efoot1($tb,$edate).$escript.$obj->efoot2($tb));	// crea vista edd
				echo '</li>';
				$obj->mkControl($tb,$rrid,$rrna,$file1,$file2,$file3);								// crea controlador
				$obj->mkModel($tb,$rrid,$rrna,$fsql);												// crea modelo
				if($tbusers){
					$obj->mkind($tb,$i_head1.$ftrs.$i_head2.$ths.$obj->imedtab().$tds.$index_foot,'../');
					$obj->mkver($tb,$v_head.$vtrs.$obj->vfoot(),'../');
					$obj->mkadd($tb,$a_head.$atrs.$obj->afoot1($tb,$adate).$ascript.$obj->afoot2($tb),'../');
					$obj->mkedd($tb,$e_head.$etrs.$obj->efoot1($tb,$edate).$escript.$obj->efoot2($tb),'../');
					$obj->mkControp($tb,$rrid,$rrna,$file1,$file2,$file3,'../');
					$obj->mkModeu($tb,$rrid,$rrna,$fsql,'../');
				}
				if($htcont){
					for($i=0;$i<$htcont;$i++){
						$obj->mkind($tb,$i_head1.$ftrs.$i_head2.$ths.$obj->imedtab().$tds.$index_foot,'../'.$htaccess[$i].'/');
						$obj->mkver($tb,$v_head.$vtrs.$obj->vfoot(),'../'.$htaccess[$i].'/');
						$obj->mkadd($tb,$a_head.$atrs.$obj->afoot1($tb,$adate).$ascript.$obj->afoot2($tb),'../'.$htaccess[$i].'/');
						$obj->mkedd($tb,$e_head.$etrs.$obj->efoot1($tb,$edate).$escript.$obj->efoot2($tb),'../'.$htaccess[$i].'/');
						$obj->mkControp($tb,$rrid,$rrna,$file1,$file2,$file3,'../'.$htaccess[$i].'/');
						$obj->mkModep($tb,$rrid,$rrna,$fsql,'../'.$htaccess[$i].'/');
					}
				}
			}else{
				echo '<li style="font-weight:bold;">';
				echo '<h2>No se cosiato '.$tb.', por que solo va en el admin y ya esta cosiatada.</h2></li>';
			}
			$tablas->MoveNext();
		}
		$obj->mkMenu($obj->tdmenuhead().$tbmenu0.$obj->tdcmenuhead().$tbmenuco.$obj->tdmenufoot());					// crea Menu admin
		if($tbusers){
			$obj->mkMenu($obj->tdmenuhead().$tbmenu.$tbmenuco.$obj->tdmenufoot(),'../');		// crea Menu index
			$obj->mkperfiles1(PPUBLICO);
		}
		if($htcont){
			for($i=0;$i<$htcont;$i++){
				$obj->mkMenu($obj->tdmenuhead().$tbmenu.$obj->tdcmenuhead().$tbmenuco.$obj->tdmenufoot(),'../'.$htaccess[$i].'/');	// crea Menu perfil
			}
			$obj->mkperfilesbase($htaccess,$htcont);
		}
		$obj->mkperfiles2();
		echo '</ol>';
	}
	$obj->otrosfinal();
}
?>
			</div>
		</div>
	</div>
<div id="fondo"></div><div id="popup1"></div>
<script>$(function(){$('input,textarea').placeholder();});</script>
</body></html>