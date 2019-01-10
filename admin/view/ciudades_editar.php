<h4><?php echo __("Editar Ciudad"); ?></h4>

<form id="ciudades-editando" name="ciudades-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>ciudades/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="departamento_id" class="col-3"><?php echo __("Departamento"); ?></label>
<div class="col-7"><select name="departamento_id" id="departamento_id" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Departamento"); ?>" required>
		<option value="0"<?php if(!$sale->fields["departamento_id"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione Departamento"); ?></option><?php
if(!$departamentos->EOF){
	while(!$departamentos->EOF){ ?>
    	<option value="<?php echo $departamentos->fields["id"]; ?>"<?php if($departamentos->fields["id"]==$sale->fields["departamento_id"]){ ?> selected="selected"<?php } ?>><?php echo $departamentos->fields["departamento"]; ?></option><?php
		$departamentos->MoveNext();
	}
	$departamentos->Move(0);
} ?></select></div>
</div>


<div class="form-group row">
<label for="ciudad" class="col-3"><?php echo __("Ciudad"); ?></label>
<div class="col-7"><input id="ciudad" name="ciudad" type="text" value="<?php echo $sale->fields["ciudad"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Ciudad"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="url" class="col-3"><?php echo __("Url"); ?></label>
<div class="col-7"><input id="url" name="url" type="text" value="<?php echo $sale->fields["url"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Url"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="codigo" class="col-3"><?php echo __("Código"); ?></label>
<div class="col-7"><input id="codigo" name="codigo" type="text" value="<?php echo $sale->fields["codigo"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Código"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="estado" class="col-3"><?php echo __("Estado"); ?></label>
<div class="col-7"><select name="estado" id="estado" class="custom-select" required>
			<option value="1"<?php if($sale->fields["estado"]) { ?> selected="selected"<?php } ?>><?php echo __("Activo"); ?></option>
			<option value="0"<?php if(!$sale->fields["estado"]){ ?> selected="selected"<?php } ?>><?php echo __("Inactivo"); ?></option>
		</select></div>
</div>


<div class="form-group row">
	<div class="col-3"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
	<div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
</div>

	</div>
</div>

</form>

<script type="application/javascript">
var pavem=0;
$(function(){
	
	$("#ciudades-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");



		if($("#departamento_id").val()==0){
			if(err==0)$("#departamento_id").focus();err++;$("#departamento_id").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#ciudad").val()==""){
			if(err==0)$("#ciudad").focus();err++;$("#ciudad").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#url").val()==""){
			if(err==0)$("#url").focus();err++;$("#url").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#codigo").val()==""){
			if(err==0)$("#codigo").focus();err++;$("#codigo").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#estado").val()==""){
			if(err==0)$("#estado").focus();err++;$("#estado").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>