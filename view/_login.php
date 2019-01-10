<table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;">
  <tr>
   <td width="124"><a class="apestana" href="<?php echo PATO; ?>" onclick="window.location.href = '<?php echo PATO; ?>'" target="_self"><div id="pestana1" class="pestana"><table cellpadding="0" cellspacing="0" border="0"><tr><td align="center" valign="middle"><?php echo __('Usuario'); ?></td></tr></table></div></a></td>
  </tr>
  <tr><td colspan="2" style="padding-right:90px;"></td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;"><tr>
	<td><a href="<?php echo PATO; ?>"><?php echo __('Inicio'); ?></a></td>
    <td>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><?php echo __("Conectado como").": ".$_SESSION["JC_Nombre"]; ?></td>
    <td>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="<?php echo PATO; ?>resumen/"><?php echo __('Panel de Control'); ?></a></td>
    <td>&nbsp;&nbsp;|&nbsp;&nbsp;</td>
	<td><a href="JavaScript:;" onclick="pasalir()"><?php echo __('Cerrar sesión'); ?></a></td>
</tr></table>
<script language="javascript" type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({appId: '<?php echo YOUR_APP_ID; ?>',status: true,cookie: true,xfbml: true,oauth: true});
	FB.Event.subscribe('auth.login', function(response){
		$.ajax({type:'GET',url:'<?php echo PATO; ?>ajax/fbin/',success: function(a){if(a==1){window.location.reload();}}});
	});
	FB.Event.subscribe('auth.logout', function(response){});
};
(function(d){
	var js, id = 'facebook-jssdk';if(d.getElementById(id)){return;}js = d.createElement('script');js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";d.getElementsByTagName('head')[0].appendChild(js);
}(document));
function pasalir(){

	<?php if(!preg_match("/localhost/i",$_SERVER["HTTP_HOST"]) && $_SESSION['FB']>0){ ?>
	FB.logout(function(response){
		<?php } ?>

		window.location.href = '<?php echo PATO; ?>entrada/salir/';

		<?php if(!preg_match("/localhost/i",$_SERVER["HTTP_HOST"]) && $_SESSION['FB']>0){ ?>
	});
	<?php } ?>

}
</script>