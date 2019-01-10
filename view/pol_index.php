<?php if(!POL_PRUEBA){ ?><script language="javascript">$(function(){$('#pagar').submit();});</script><?php } ?>
<form method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html" target="_self" name="pagar" id="pagar">
<input name="url_respuesta" type="hidden" value="<?php echo MIURL.PATO; ?>pol/respuesta/" />
<input name="url_confirmacion" type="hidden" value="<?php echo MIURL.PATO; ?>pol/confirma/" />
<input name="usuarioId" type="hidden" value="<?php echo POL_ID; ?>" />
<input name="descripcion" type="hidden" value="<?php echo urldecode($descripcion); ?>" />
<!--<input name="extra1" type="hidden" value="<?php echo $descripcion2; ?>" />-->
<input name="refVenta" type="hidden" value="<?php echo $refVenta; ?>" />
<input name="valor" type="hidden" value="<?php echo $valur; ?>" />
<input name="iva" type="hidden" value="<?php echo $iva; ?>" />
<input name="baseDevolucionIva" type="hidden" value="<?php echo $baseDevolucionIva; ?>" />
<input name="firma" type="hidden" value="<?php echo $firma; ?>" />
<input name="emailComprador" type="hidden" value="<?php echo $emailComprador; ?>" />
<input name="prueba" type="hidden" value="<?php echo (POL_PRUEBA)?'1':'0'; ?>" />
<input name="Submit" type="submit" value="Pagar" />
</form>
<?php if(POL_PRUEBA){ ?>
<p>Este paso esta temporalmente para copiar el numero de la tcredito para poder pagar en el sistema de pruebas!
Pero cuando estemos en modo de produccion este paso no sera invisible!<br />
Numeros de Tcredito:<br />
9955555555555501 Aprobada<br />
9955555555555504 Rechazada<br />
verificacion 123</p>
<?php }else{ ?>
<p>Redireccionando a la pasarela de pago...</p>
<?php } ?>
