<table border="0" cellpadding="8" cellspacing="1">
  <tr><td align="left" valign="top"><h3><?php echo __('Gracias por contactarse con nosotros'); ?></h3></td></tr>
  <tr><td align="left" valign="top"><?php echo __('La información que usted envió es la siguiente'); ?></td></tr>
  <tr>
	<td align="left" valign="top"><table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td align="left" valign="top" style="padding:4px 0;font-size:18px;"><?php echo __('Destinatario'); ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><?php echo $_SESSION['asunto']; ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;font-size:18px;"><?php echo __('Mensaje'); ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><?php echo $_SESSION['mensaje']; ?></td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;">&nbsp;</td>
</tr>
<tr>
	<td align="left" valign="top" style="padding:4px 0;"><input type="button" value="<?php echo __('Ir a Inicio'); ?>" onClick="location.href='<?php echo PATO; ?>';" /></td>
</tr>
</table></td>
  </tr>
  
</table>
