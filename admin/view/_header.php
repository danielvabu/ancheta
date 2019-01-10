<!DOCTYPE html>
<html lang="es-CO">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Javier Cruz jcjavier@hotmail.com">
<title><?php echo TITULO; ?></title>
<link type="image/x-icon" rel="icon" href="<?php echo PATU; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATO; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/uploadifive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/all.css" />
<!--link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/tether.min.css" /-->
<script type="application/javascript" src="<?php echo JQUERY; ?>"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery-ui.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.uploadifive.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.placeholder.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.timer.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.pager.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.popupWindow.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/popper.js"></script>
<!--
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/ckeditor.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/adapters/jquery.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckfinder/ckfinder.js"></script>
-->
<script type="application/javascript" src="<?php echo PATU; ?>js/jcfw.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="<?php echo PATO; ?>js/funciones.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if(MODULO=='index' && PROCESO=='index'){ ?><script type="application/javascript" src='https://www.google.com/recaptcha/api.js'></script><?php } ?>
<script>
var focux=0;
var dateconf = {
	dateFormat: 'yy-mm-dd', altFormat: 'yy-mm-dd', numberOfMonths: 1, dayNamesMin: ['<?php echo __('Do'); ?>', '<?php echo __('Lu'); ?>', '<?php echo __('Ma'); ?>', '<?php echo __('Mi'); ?>', '<?php echo __('Ju'); ?>', '<?php echo __('Vi'); ?>', '<?php echo __('Sa'); ?>'],
	monthNames: ['<?php echo __('Enero'); ?>', '<?php echo __('Febrero'); ?>', '<?php echo __('Marzo'); ?>', '<?php echo __('Abril'); ?>', '<?php echo __('Mayo'); ?>','<?php echo __('Junio'); ?>', '<?php echo __('Julio'); ?>', '<?php echo __('Agosto'); ?>', '<?php echo __('Septiembre'); ?>','<?php echo __('Octubre'); ?>', '<?php echo __('Noviembre'); ?>', '<?php echo __('Diciembre'); ?>'],
	monthNamesShort: ['<?php echo __('Ene'); ?>', '<?php echo __('Feb'); ?>', '<?php echo __('Mar'); ?>', '<?php echo __('Abr'); ?>', '<?php echo __('May'); ?>', '<?php echo __('Jun'); ?>', '<?php echo __('Jul'); ?>', '<?php echo __('Ago'); ?>','<?php echo __('Sep'); ?>', '<?php echo __('Oct'); ?>', '<?php echo __('Nov'); ?>', '<?php echo __('Dic'); ?>']
};
var edadconf = {
	dateFormat: 'yy-mm-dd', altFormat: 'yy-mm-dd', numberOfMonths: 1, dayNamesMin: ['<?php echo __('Do'); ?>', '<?php echo __('Lu'); ?>', '<?php echo __('Ma'); ?>', '<?php echo __('Mi'); ?>', '<?php echo __('Ju'); ?>', '<?php echo __('Vi'); ?>', '<?php echo __('Sa'); ?>'],
	monthNames: ['<?php echo __('Enero'); ?>', '<?php echo __('Febrero'); ?>', '<?php echo __('Marzo'); ?>', '<?php echo __('Abril'); ?>', '<?php echo __('Mayo'); ?>','<?php echo __('Junio'); ?>', '<?php echo __('Julio'); ?>', '<?php echo __('Agosto'); ?>', '<?php echo __('Septiembre'); ?>','<?php echo __('Octubre'); ?>', '<?php echo __('Noviembre'); ?>', '<?php echo __('Diciembre'); ?>'],
	monthNamesShort: ['<?php echo __('Ene'); ?>', '<?php echo __('Feb'); ?>', '<?php echo __('Mar'); ?>', '<?php echo __('Abr'); ?>', '<?php echo __('May'); ?>', '<?php echo __('Jun'); ?>', '<?php echo __('Jul'); ?>', '<?php echo __('Ago'); ?>','<?php echo __('Sep'); ?>', '<?php echo __('Oct'); ?>', '<?php echo __('Nov'); ?>', '<?php echo __('Dic'); ?>'],
	changeMonth: true, changeYear: true, maxDate: "-18y", yearRange: ("<?php echo date('Y')-90; ?>:<?php echo date('Y')-18; ?>")};
$(function(){
	window.onresize=function(){centrar();};
	$(".movido").draggable({handle:"#dragon",stop:function(event,ui){
		var x = parseInt($('#popup1').css('left'));var y = parseInt($('#popup1').css('top'));
		var cx = x + $('#popup1').width();var cy = y - 8;
		$('#cerrarpopup').css('left',cx+'px');$('#cerrarpopup').css('top',cy+'px');
	}});
	MM_preloadImages('<?php echo PATO; ?>img/loading.gif','<?php echo PATO; ?>img/loading2.png','<?php echo PATO; ?>img/loading3.gif','<?php echo PATO; ?>img/loader.gif');
	$('.open').popupWindow();
	$("#fondo").on('click',function(){cerrarpopup();});
	<?php if(isset($_SESSION["alertas"])){ ?>alerta1('<?php echo $_SESSION["alertas"]; ?>');<?php unset($_SESSION["alertas"]);} ?>
});
</script>
</head>
<body>
<div class="container mt-3">
<div class="container-fluid bordeext1">
	<div class="row bordeint1<?php if(!ifaut()){ ?> align-items-center<?php } ?>">
		<div class="col-12 col-sm-3"><img src="<?php echo LOGO; ?>" border="0" /></div>
		<div class="col-12 col-sm-9">
			<h4 class="text-right"><?php echo __('Administración'); ?></h4>
			<?php if(ifaut()){ ?>
			<div class="row">
				<div class="col-12 text-right"><?php echo __('Conectado como'); ?>: <?php echo $_SESSION['JC_Nombre']; ?> <a href="<?php echo PATO; ?>entrada/salir/" class="btn btn-danger btn-sm" role="button"><span class="hidden-xs-down"><?php echo __('Cerrar Sesión'); ?> </span><i class="fas fa-sign-out"></i></a></div>
			</div>
			<div class="row">
				<div class="col-12"><?php include('_menu.php'); ?></div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
