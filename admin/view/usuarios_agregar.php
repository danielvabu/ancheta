
<h4><?php echo __("Nuevo Usuario"); ?></h4>

<form id="usuarios-agregando" name="usuarios-agregando" class="form-horizontal" method="post" action="<?php echo PATO; ?>usuarios/agregando/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="old_id" class="col-2"><?php echo __("Old"); ?></label>
<div class="col-7"><input id="old_id" name="old_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Old"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="constructora_id" class="col-2"><?php echo __("Constructora"); ?></label>
<div class="col-7"><input id="constructora_id" name="constructora_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Constructora"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="inmobiliaria_id" class="col-2"><?php echo __("Inmobiliaria"); ?></label>
<div class="col-7"><input id="inmobiliaria_id" name="inmobiliaria_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Inmobiliaria"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="email" class="col-2"><?php echo __("Email"); ?></label>
<div class="col-7"><input id="email" name="email" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Email"); ?>" /></div>
</div>


<div class="form-group row">
<label for="clave" class="col-2"><?php echo __("Clave"); ?></label>
<div class="col-7"><input id="clave" name="clave" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Clave"); ?>" /></div>
</div>


<div class="form-group row">
<label for="drupal" class="col-2"><?php echo __("Drupal"); ?></label>
<div class="col-7"><input id="drupal" name="drupal" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Drupal"); ?>" /></div>
</div>


<div class="form-group row">
<label for="nombre" class="col-2"><?php echo __("Nombre"); ?></label>
<div class="col-7"><input id="nombre" name="nombre" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Nombre"); ?>" /></div>
</div>


<div class="form-group row">
<label for="apellidos" class="col-2"><?php echo __("Apellidos"); ?></label>
<div class="col-7"><input id="apellidos" name="apellidos" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Apellidos"); ?>" /></div>
</div>


<div class="form-group row">
<label for="tdocumento" class="col-2"><?php echo __("Tdocumento"); ?></label>
<div class="col-7"><select name="tdocumento" id="tdocumento" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Tdocumento"); ?>" required>
			<option value="0" selected="selected"><?php echo __("Seleccione Tdocumento"); ?></option>
			<option value="1"><?php echo __("NIT"); ?></option>
			<option value="2"><?php echo __("CC"); ?></option>
			<option value="3"><?php echo __("CE"); ?></option>
			<option value="4"><?php echo __("Pasaporte"); ?></option>
					</select></div>
</div>


<div class="form-group row">
<label for="documento" class="col-2"><?php echo __("Documento"); ?></label>
<div class="col-7"><input id="documento" name="documento" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Documento"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="telefono" class="col-2"><?php echo __("Teléfono"); ?></label>
<div class="col-7"><input id="telefono" name="telefono" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Teléfono"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="celular" class="col-2"><?php echo __("Celular"); ?></label>
<div class="col-7"><input id="celular" name="celular" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Celular"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="celular2" class="col-2"><?php echo __("Celular2"); ?></label>
<div class="col-7"><input id="celular2" name="celular2" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Celular2"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="departamento_id" class="col-2"><?php echo __("Departamento"); ?></label>
<div class="col-7"><input id="departamento_id" name="departamento_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Departamento"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="ciudad_id" class="col-2"><?php echo __("Ciudad"); ?></label>
<div class="col-7"><input id="ciudad_id" name="ciudad_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Ciudad"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
<label for="direccion" class="col-2"><?php echo __("Dirección"); ?></label>
<div class="col-7"><input id="direccion" name="direccion" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Dirección"); ?>" /></div>
</div>


<div class="form-group row">
<label for="resena" class="col-2"><?php echo __("Resena"); ?></label>
<div class="col-7"><input id="resena" name="resena" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Resena"); ?>" /></div>
</div>


<div class="form-group row">
<label for="web" class="col-2"><?php echo __("Web"); ?></label>
<div class="col-7"><input id="web" name="web" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Web"); ?>" /></div>
</div>


<div class="form-group row">
<label for="img" class="col-2"><?php echo __("Img"); ?></label>
<div class="col-7"><input id="img" name="img" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Img"); ?>" /></div>
</div>


<div class="form-group row">
<label for="origname" class="col-2"><?php echo __("Origname"); ?></label>
<div class="col-7"><input id="origname" name="origname" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Origname"); ?>" /></div>
</div>


<div class="form-group row">
<label for="estado" class="col-2"><?php echo __("Estado"); ?></label>
<div class="col-7"><select name="estado" id="estado" class="custom-select" required>
			<option value="1" selected="selected"><?php echo __("Activo"); ?></option>
			<option value="0"><?php echo __("Inactivo"); ?></option>
		</select></div>
</div>


<div class="form-group row">
<label for="login" class="col-2"><?php echo __("Login"); ?></label>
<div class="col-7"><input id="login" name="login" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Login"); ?>" /></div>
</div>


<div class="form-group row">
<label for="biguser_id" class="col-2"><?php echo __("Biguser"); ?></label>
<div class="col-7"><input id="biguser_id" name="biguser_id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Biguser"); ?>" onKeyPress="return notxt(event)" /></div>
</div>


<div class="form-group row">
	<div class="col-2"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
	<div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
</div>

	</div>
</div>

</form>

<script type="application/javascript">
var pavem=0;
$(function(){
	
	$("#usuarios-agregando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($("#tdocumento").val()==""){
			if(err==0)$("#tdocumento").focus();err++;$("#tdocumento").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#estado").val()==""){
			if(err==0)$("#estado").focus();err++;$("#estado").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>