
<h4><?php echo __("Nuevo Departamento"); ?></h4>

<form id="departamentos-agregando" name="departamentos-agregando" class="form-horizontal" method="post" action="<?php echo PATO; ?>departamentos/agregando/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="departamento" class="col-2"><?php echo __("Departamento"); ?></label>
<div class="col-7"><input id="departamento" name="departamento" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Departamento"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="url" class="col-2"><?php echo __("Url"); ?></label>
<div class="col-7"><input id="url" name="url" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Url"); ?>" /></div>
</div>


<div class="form-group row">
<label for="codigo" class="col-2"><?php echo __("Código"); ?></label>
<div class="col-7"><input id="codigo" name="codigo" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Código"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="estado" class="col-2"><?php echo __("Estado"); ?></label>
<div class="col-7"><select name="estado" id="estado" class="custom-select" required>
			<option value="1" selected="selected"><?php echo __("Activo"); ?></option>
			<option value="0"><?php echo __("Inactivo"); ?></option>
		</select></div>
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
	
	$("#departamentos-agregando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($("#departamento").val()==""){
			if(err==0)$("#departamento").focus();err++;$("#departamento").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#codigo").val()==""){
			if(err==0)$("#codigo").focus();err++;$("#codigo").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#estado").val()==""){
			if(err==0)$("#estado").focus();err++;$("#estado").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>