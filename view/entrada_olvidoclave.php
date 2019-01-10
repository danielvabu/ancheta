<div style="border-radius:5px;padding:5px;" class="bgb" align="center">
<form id="entrada_olvido" name="entrada_olvido" method="post" action="<?php echo PATO; ?>entrada/recordando/">
<table width="350" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td scope="row" align="left">&nbsp;</td>
    <td colspan="2" align="left" scope="row">Por favor escriba su E-Mail para enviarle su clave.</td>
    <td scope="row" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo __('Email'); ?></td>
    <td><input name="email" type="email" id="email" class="sombrai" style="width:200px;" placeholder="E-Mail" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row" align="center">&nbsp;</td>
    <td scope="row" align="center">&nbsp;</td>
    <td align="left" valign="top" scope="row"><input type="submit" value="&nbsp;&nbsp;&nbsp;<?php echo __('Enviar'); ?>&nbsp;&nbsp;&nbsp;" /></td>
    <td scope="row" align="center">&nbsp;</td>
  </tr>
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
$(function(){
	$('#entrada_olvido').submit(function(){
		var err=0;$('.brojito').removeClass('brojito');$('.err').hide();

		if($('#entrada_olvido #email').val()==''){
			$('#entrada_olvido #email').focus();err++;$('#entrada_olvido #email').addClass('brojito');
		}else{
			if(!valmail($('#entrada_olvido #email').val())){
				$('#entrada_olvido #email').focus();err++;$('#entrada_olvido #email').addClass('brojito');
			}
		}

		$('input, textarea').placeholder();
		if(err==0){return true;}else{return false;}
	});
});
</script>
