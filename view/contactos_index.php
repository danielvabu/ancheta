<table border="0" cellpadding="8" cellspacing="1">
  <tr><td align="left" valign="top" width="160"><h3><?php echo __('Servicio al cliente'); ?></h3></td></tr>
  <tr>
	<td align="left" valign="top"><form action="<?php echo PATO; ?>contactos/contactando/" method="post" id="contactando" name="contactando">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><?php echo __('Asunto'); ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><select name="asunto" id="asunto" style="width:360px;">
		<option value="0"><?php echo __('Seleccione'); ?></option>
		<?php if(!$asuntos->EOF){ while(!$asuntos->EOF){ ?>
		<option value="<?php echo $asuntos->fields['id']; ?>"><?php echo $asuntos->fields['asunto']; ?></option>
		<?php $asuntos->MoveNext();}$asuntos->Move(0);} ?>
	</select>
	<div id="errasunto" class="err" style="display:none;"><?php echo __('Por favor seleccione un asunto'); ?></div></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><?php echo __('Mensaje'); ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><textarea name="mensaje" id="mensaje" style="width:350px;height:250px;"></textarea>
	<div id="errmsg" class="err" style="display:none;"><?php echo __('Por favor escriba un mensaje'); ?></div></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><input type="submit" value="<?php echo __('Enviar'); ?>" /></td>
</tr>
</table>
</form></td>
  </tr>
  
</table>
<script language="javascript" type="text/javascript">
$(function(){
	$('#contactando').submit(function(){
		var err=0;$('.brojito').removeClass('brojito');$('.err').hide();

		if($('#asunto').val()==0){if(err==0)$('#asunto').focus();err++;$('#asunto').addClass('brojito');$('#errasunto').show();}
		if($('#mensaje').val()==''){if(err==0)$('#mensaje').focus();err++;$('#mensaje').addClass('brojito');$('#errmsg').show();}

		$('input, textarea').placeholder();
		if(err==0){return true;}else{return false;}
	});
});
</script>

