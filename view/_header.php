<!DOCTYPE html>
<html lang="es-CO">
<head itemscope itemtype="http://schema.org/WebSite">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
<meta name="description" content="<?php if(isset($description) && $description!=''){echo $description.SSEODESCRIP;}else{echo SEODESCRIPT;} ?>" />
<meta name="keywords" content="<?php if(isset($seowords) && $seowords!=''){echo $seowords.SSEOKEYWORD;}else{echo SEOKEYWORDS;} ?>" />
<meta name="author" content="Javier Cruz jcjavier@hotmail.com" />
<meta name="Audience" content="All" />
<meta name="robots" content="index, follow" />
<meta name="fragment" content="!" />
<meta property="og:site_name" content="ingenioSoft.com" />
<meta property="fb:app_id" content="1902669176617429" />
<meta property="og:title" content="<?php if(isset($seotit) && $seotit!=''){echo $seotit.'| ';}echo TITULO; ?>" />
<meta property="og:description" content="<?php if(isset($description) && $description!=''){echo $description.SSEODESCRIP;}else{echo SEODESCRIPT;} ?>" />
<meta property="og:image" content="<?php echo MIURLS;echo (isset($logopafb) && isset($logopafbo) && is_file($logopafbo))?$logopafb:'/img/logofb.jpg'; ?>" />
<meta property="og:url" content="<?php echo MIURLS; ?>" />
<meta property="og:type" content="website" />
<meta property="og:image:secure_url" content="<?php echo MIURLS;echo (isset($logopafb) && isset($logopafbo) && is_file($logopafbo))?$logopafb:'/img/logofb.jpg'; ?>" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="<?php echo (isset($lwfb) && $lwfb>0)?$lwfb:180; ?>" />
<meta property="og:image:height" content="<?php echo (isset($lhfb) && $lhfb>0)?$lhfb:99; ?>" />
<meta property="og:updated_time" content="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i:s'); ?>-05:00" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="<?php echo MIURLS; ?>" />
<meta name="twitter:title" content="<?php if(isset($seotit) && $seotit!=''){echo $seotit.'| ';}echo TITULO; ?>" />
<meta name="twitter:description" content="<?php if(isset($description) && $description!=''){echo $description.SSEODESCRIP;}else{echo SEODESCRIPT;} ?>" />
<meta name="twitter:image" content="<?php echo MIURLS;echo (isset($logopafb) && isset($logopafbo) && is_file($logopafbo))?$logopafb:'/img/logofb.jpg'; ?>" />
<meta name="twitter:image:width" content="<?php echo (isset($lwfb) && $lwfb>0)?$lwfb:180; ?>" />
<meta name="twitter:image:height" content="<?php echo (isset($lhfb) && $lhfb>0)?$lhfb:99; ?>" />
<meta name="twitter:image:alt" content="VivaLaSabana.com" />
<meta itemprop="name" content="<?php if(isset($seotit) && $seotit!=''){echo $seotit.'| ';}echo TITULO; ?>" />
<meta itemprop="description" content="<?php if(isset($description) && $description!=''){echo $description.SSEODESCRIP;}else{echo SEODESCRIPT;} ?>" />
<meta itemprop="image" content="<?php echo MIURLS;echo (isset($logopafb) && isset($logopafbo) && is_file($logopafbo))?$logopafb:'/img/logofb.jpg'; ?>" />
<meta name="google-site-verification" content="4itCBIAFwAJj2eMzHRO1_rtqhWwQYhA5H3zgZy0TDvQ" />
<meta name="msvalidate.01" content="281191DA4D56B0DB99DC2ED21270BAE5" />
<title itemprop='name'><?php if(isset($seotit) && $seotit!=''){echo $seotit.'| ';}echo TITULO; ?></title>
<link type="image/x-icon" rel="shortcut icon" href="<?php echo PATU; ?>favicon.ico" />
<link rel="canonical" href="<?php echo (isset($canonical) && $canonical!='')?$canonical:MIURLS; ?>" />
<?php if(isset($alternate) && $alternate!=''){ ?><link rel="alternate" href="<?php echo $alternate; ?>" /><?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/estilos.css?<?php echo microtime(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/uploadifive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/all.css" />
<!--link rel="stylesheet" type="text/css" href="<?php echo PATU; ?>css/tether.min.css" /-->
<script type="application/javascript" src="<?php echo JQUERY; ?>"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery-ui.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.uploadifive.min.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.timer.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.popupWindow.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/popper.js"></script>

<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>js/jquery.tablesorter.pager.js"></script>
<!--
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/ckeditor.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckeditor/adapters/jquery.js"></script>
<script type="application/javascript" src="<?php echo PATU; ?>ckfinder/ckfinder.js"></script>
-->
<script type="application/javascript" src="<?php echo PATU; ?>js/jcfw.js?<?php echo microtime(); ?>"></script>
<script type="application/javascript" src="<?php echo PATO; ?>js/funciones.js?<?php echo microtime(); ?>"></script>
<!--
<script type="application/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=<?php echo ADDTHIS; ?>"></script>
-->
<script type="application/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if(MODULO=='index' && PROCESO=='index'){ ?><script type="application/javascript" src='https://www.google.com/recaptcha/api.js'></script><?php } ?>
<script>
var focux=0;var pavem = 0;var msg='';var pato = '<?php echo PATO; ?>';
var addthis_config = {"data_track_addressbar":false};
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
		var x = parseInt($("#popup1").css("left"));var y = parseInt($("#popup1").css("top"));
		var cx = x + $("#popup1").width();var cy = y - 8;
		$("#cerrarpopup").css("left",cx+"px");$("#cerrarpopup").css("top",cy+"px");
	}});
	MM_preloadImages('<?php echo PATO; ?>img/loading.gif','<?php echo PATO; ?>img/loading2.png','<?php echo PATO; ?>img/loading3.gif','<?php echo PATO; ?>img/loader.gif');
	$('.open').popupWindow();
	$("#fondo").on('click',function(){cerrarpopup();});
	<?php if(isset($_SESSION["alertas"])){ ?>alerta1('<?php echo $_SESSION["alertas"]; ?>');<?php unset($_SESSION["alertas"]);} ?>
});
</script>
</head>
<body itemscope itemtype="http://schema.org/WebPage" onload="fnonload();">
<div class="container mt-3">
<div class="container-fluid bordeext1">

<div class="row bordeint1">
	<div class="col-12 col-sm-3" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><img src="<?php echo LOGO; ?>" border="0" class="img-fluid" itemprop="contentUrl" /></div>
	<div class="col-12 col-sm-9">
		<?php if(ifaut()){ ?>
		<div class="row">
			<div class="col-12 text-right" itemprop="customer" itemscope itemtype="http://schema.org/Person"><?php echo __('Conectado como'); ?>: <span itemprop="name"><?php echo $_SESSION['JC_Nombre']; ?></span> <a href="<?php echo PATO; ?>entrada/salir/" class="btn btn-danger btn-sm" role="button"><span class="hidden-xs-down"><?php echo __('Cerrar Sesión'); ?> </span><i class="fas fa-sign-out"></i></a></div>
		</div>
		<?php } ?>
		<div class="row"><div class="col-12"><?php include('_menu.php'); ?></div></div>
	</div>
</div>

<div class="row">
	<div class="col-12">
