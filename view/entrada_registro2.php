<div id="adentro">
<table cellpadding="0" cellspacing="8" border="0" width="990"><tr>
  <td width="230" align="left" valign="top">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
       <tr><td align="left" valign="top"><div class="titulitos"><?php echo __('Ya estoy registrado'); ?></div></td></tr>
       <tr><td align="left" valign="top"><form method="post" action="<?php echo PATO; ?>entrada/" name="entrada" id="entrada">
  <table border="0" cellpadding="5" cellspacing="1">
    <tr>
	  <td align="left" valign="top"><?php echo __('EMail'); ?>:</td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="email" id="username" name="username" style="width:200px;" /></td>
    </tr>
    <tr>
	  <td align="left" valign="top"><?php echo __('Clave'); ?>:</td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="password" id="password" name="password" style="width:200px;" /></td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="submit" value="&nbsp;&nbsp;&nbsp;<?php echo __("ingresar"); ?>&nbsp;&nbsp;&nbsp;" /></td>
    </tr>
  </table><input type="hidden" name="desde" id="desde" value="entrada" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="padding:4px;"><a href="JavaScript:;" onclick="ffbb()"><img src="<?php echo PATO; ?>img/fbesco.png" border="0" /></a></p></td></tr>
    </table>
  </td>
  <td width="30" align="left" valign="top" style="border-right:solid 1px #DEDEDE;">&nbsp;</td>
  <td width="30" align="left" valign="top">&nbsp;</td>
  <td align="left" valign="top">

<div class="titulitos"><?php echo __('Registrarme'); ?></div>

<form id="registro" name="registro" method="post" action="<?php echo PATO; ?>entrada/registrando/">
<table border="0" align="center" cellpadding="4" cellspacing="1">
  <tr>
    <td align="left" valign="top" width="220"><?php echo __('Email'); ?> *</td>
    <td align="left" valign="top" width="20">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" valign="top"><input name="email" type="email" id="email" class="sombrai w250" tabindex="1" required />
      <input type="hidden" name="mailtrue" id="mailtrue" value="0" />
      <div id="errmail" class="err" style="display:none;"></div></td>
    <td align="left" valign="top"><img src="<?php echo PATO; ?>img/loading2.png" border="0" alt="<?php echo __('Verificando...'); ?>" title="<?php echo __('Verificando...'); ?>" id="vv2" style="display:none" /><img src="<?php echo PATO; ?>img/gifs/006.gif" border="0" alt="<?php echo __('Verificado'); ?>" title="<?php echo __('Verificado'); ?>" id="mailsi" style="display:none" /><img src="<?php echo PATO; ?>img/gifs/003.gif" border="0" alt="<?php echo __('Su direccion de email ya esta en nuestra base de datos'); ?>" title="<?php echo __('Su direccion de email ya esta en nuestra base de datos'); ?>" id="mailno" style="display:none" />&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Clave'); ?> *</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo __('Verificar Clave'); ?> *</td>
    </tr>
  <tr>
    <td align="left" valign="top"><input name="clave" type="password" id="clave" class="sombrai w250" tabindex="2" required />
      <div id="errclave" class="err" style="display:none;"></div></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="clave2" type="password" id="clave2" class="sombrai w250" tabindex="3" required />
      <div id="errclave2" class="err" style="display:none;"><?php echo __('Las Claves no coinciden'); ?></div></td>
    </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Nombres'); ?> *</td>
    <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" valign="top"><?php echo __('Apellidos'); ?> *</td>
    </tr>
  <tr>
    <td align="left" valign="top"><input name="nombre" type="text" id="nombre" class="sombrai w250" tabindex="4" required />
      <div id="errnombre" class="err" style="display:none;"><?php echo __('Por favor escriba su nombre'); ?></div></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="apellido" type="text" id="apellido" class="sombrai w250" tabindex="5" required />
      <div id="errapellido" class="err" style="display:none;"><?php echo __('Por favor escriba su apellido'); ?></div></td>
    </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Genero'); ?></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo __('Fecha de nacimiento'); ?> *</td>
    </tr>
  <tr>
    <td align="left" valign="top"><select name="sexo" id="sexo" tabindex="6" class="sombrai w257">
      <option value="1"><?php echo __('Masculino'); ?></option>
      <option value="2"><?php echo __('Femenino'); ?></option>
    </select></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="nacimiento" type="text" id="nacimiento" class="sombrai w250" tabindex="7" required readonly />
      <div id="errnacimiento" class="err" style="display:none;"><?php echo __('Por favor escriba su fecha de nacimiento'); ?></div></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Telefono móvil'); ?></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo __('Email alterno'); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><input name="movil" type="text" id="movil" class="sombrai w250" tabindex="10" onKeyPress="return notxt(event)" /></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="email2" type="email" id="email2" class="sombrai w250" tabindex="11" /></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Facebook'); ?></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo __('skype'); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><input name="facebook" type="text" id="facebook" class="sombrai w250" tabindex="12" /></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="skype" type="text" id="skype" class="sombrai w250" tabindex="13" /></td>
  </tr>
  <tr>
    <td align="left" valign="top"><input name="teamviewer" type="text" id="teamviewer" class="sombrai w250" tabindex="13" /></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo __('Departamento'); ?> *</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo __('Ciudad'); ?> *</td>
  </tr>
  <tr>
    <td align="left" valign="top">



<select name="departamento_id" id="departamento_id" class="sombrai w250" required>
		<option value="0" selected="selected"><?php echo __("Seleccione Departamento"); ?></option><?php
if($departamentos){
	while(!$departamentos->EOF){ ?>
    	<option value="<?php echo $departamentos->fields["id"]; ?>"><?php echo $departamentos->fields["departamento"]; ?></option><?php
		$departamentos->MoveNext();
	}
	$departamentos->Move(0);
} ?>
		<option value="-1"<?php if($cl==-1){echo ' selected="selected"';} ?>><?php echo __('Otro'); ?></option>
</select><div id="errdepartamento_id" class="err" style="display:none;"><?php echo __("Por favor seleccione el departamento"); ?></div>
<input type="text" name="departamento" id="departamento" style="display:none;" placeholder="<?php echo __('Cual departamento?'); ?>" class="sombrai w250" value="<?php echo $departamento; ?>" />
<div id="errdepartamento" class="err"><?php echo __('Por favor escriba su departamento'); ?></div>
</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" id="tdciudad"><div class="styled-select"><select name="ciudad_id" id="ciudad_id" tabindex="200" class="sombrai w257" required>
      <option value="0" selected="selected"><?php echo __('Seleccione primero el departamento'); ?></option>
      </select></div><img src="<?php echo PATO; ?>img/loading2.png" border="0" style="display:none" id="load-ciudad_id" />
      <div id="errciudad_id" class="err" style="display:none;"><?php echo __('Por favor seleccione una ciudad'); ?></div>
      <input type="text" name="ciudad" id="ciudad" style="display:none" placeholder="cual ciudad?" class="sombrai w250" />
      <div id="errciudad" class="err" style="display:none;"><?php echo __('Por favor escriba su ciudad'); ?></div></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><input type="submit" id="btsb" value="&nbsp;&nbsp;&nbsp;<?php echo __('Siguiente'); ?>&nbsp;&nbsp;&nbsp;" tabindex="1000" style="margin-top:5px;" /></td>
  </tr>
</table>
</form>


</td></tr></table>
</div>
<script language="javascript" type="text/javascript">
$(function(){

	$('#entrada').submit(function(){
		var err=0;$('.brojito').removeClass('brojito');$('.err').hide();
		if($('#entrada #username').val()==''){
			if(err==0)$('#entrada #username').focus();err++;$('#entrada #username').addClass('brojito');$('#entrada #errusername').show();
		}
		if($('#entrada #password').val()==''){
			if(err==0)$('#entrada #password').focus();err++;$('#entrada #password').addClass('brojito');$('#entrada #errpassword').show();
		}
		if(err==0){return true;}else{$('#<?php echo MODULO; ?>bbttss').show();$('#<?php echo MODULO; ?>loading').hide();return false;}
	});

	$('#nacimiento').datepicker(edadconf);
	$('#registro').submit(function(){
		var err=0;$('.brojito').removeClass('brojito');$('.err').hide();

		if($('#mailtrue').val()==0){
			$('#errmail').html('<?php echo __('Su Email ya se encuentra registrado en nuestra sistema'); ?>');
			if(err==0)$('#registro #email').focus();err++;$('#registro #email').addClass('brojito');$('#errmail').show();
		}
		if($('#registro #email').val()==''){
			$('#errmail').html('<?php echo __('Por favor escriba su email'); ?>');
			if(err==0)$('#registro #email').focus();err++;$('#registro #email').addClass('brojito');$('#errmail').show();
		}else{
			if(!valmail($('#registro #email').val())){
				$('#errmail').html('<?php echo __('Por favor escriba un EMail valido'); ?>');
				if(err==0)$('#registro #email').focus();err++;$('#registro #email').addClass('brojito');$('#errmail').show();
			}
		}

		if($('#registro #clave').val()==''){
			if(err==0)$('#registro #clave').focus();err++;$('#registro #clave').addClass('brojito');
			$('#errclave').html('<?php echo __('Por favor escriba una clave'); ?>').show();
		}else{
			if($('#registro #clave').val().length<6){
				if(err==0)$('#registro #clave').focus();err++;$('#registro #clave').addClass('brojito');
				$('#errclave').html('<?php echo __('la clave debe tener minimo 6 caracteres'); ?>').show();
			}
		}
		if($('#registro #clave').val()!=$('#registro #clave2').val()){
			if(err==0)$('#registro #clave2').focus();err++;$('#registro #clave2').addClass('brojito');$('#errclave2').show();
		}

		if($('#nombre').val()==''){if(err==0)$('#nombre').focus();err++;$('#nombre').addClass('brojito');$('#errnombre').show();}
		if($('#apellido').val()==''){if(err==0)$('#apellido').focus();err++;$('#apellido').addClass('brojito');$('#errapellido').show();}
		if($('#nacimiento').val()==''){if(err==0)$('#nacimiento').focus();err++;$('#nacimiento').addClass('brojito');$('#errnacimiento').show();}
		if($('#documento').val()==''){if(err==0)$('#documento').focus();err++;$('#documento').addClass('brojito');$('#errdocumento').show();}
		if($('#departamento_id').val()==0){
			if(err==0)$('#departamento_id').focus();
			err++;$('#registro .styled-select:has(#departamento_id)').addClass('brojito');$('#errdepartamento_id').show();}
		if($('#ciudad_id').val()==0){
			if(err==0)$('#ciudad_id').focus();err++;$('#registro .styled-select:has(#ciudad_id)').addClass('brojito');$('#errciudad_id').show();}
		if($('#ciudad_id').val()==-1 && $('#ciudad').val()==''){
			if(err==0){$('#ciudad').focus();}err++;$('#ciudad').addClass('brojito');$('#errciudad').show();}

		$('input, textarea').placeholder();
		if(err==0){return true;}else{return false;}
	});

	<?php if($cl==-1){ ?>$('#departamento').show();<?php } ?>
	$('#departamento_id').change(function(){
		if($('#departamento_id').val()==-1){
			$('#load-ciudad_id').show();$('#departamento').show();
			$('#tdciudad').load('<?php echo PATO; ?>ciudades/seleccion/'+$('#departamento_id').val()+'/');
			$('#errdepartamento_id').hide();
		}
		if($('#departamento_id').val()==0){
			$('#load-ciudad_id').show();$('#departamento').hide();
			$('#tdciudad').load('<?php echo PATO; ?>ciudades/seleccion/'+$('#departamento_id').val()+'/');
			$('#errdepartamento_id').show();
		}
		if($('#departamento_id').val()>0){
			$('#load-ciudad_id').show();$('#departamento').hide();$('#ciudad').hide();
			$('#tdciudad').load('<?php echo PATO; ?>ciudades/seleccion/'+$('#departamento_id').val()+'/');
			$('#errdepartamento_id').hide();
		}
	});

	$('#registro #email').on('blur',function(){
		if($('#registro #email').val()!=''){
			$('#btsb').val('   <?php echo __('Verificando...'); ?>   ');
			$('#btsb').attr('disabled','disabled');
			$('#vv2').show();$('#mailsi').hide();$('#mailno').hide();$('#mailtrue').val(0);
			if(pavem!=0)pavem.abort();
			pavem = $.ajax({type: 'POST', url: '<?php echo PATO; ?>entrada/verificaEmail/'+$('#registro #email').val()+'/',
				success: function(a){
					$('#vv2').hide();
					if(a==1){$('#mailsi').show();$('#mailno').hide();$('#mailtrue').val(1);}
					else{$('#mailsi').hide();$('#mailno').show();$('#mailtrue').val(0);}
					$('#btsb').val('   <?php echo __('Siguiente'); ?>   ');
					$('#btsb').removeAttr('disabled');
				}
			});
		}
	});


});
</script>
