<h4><?php echo __("Editar Session"); ?></h4>

<form id="sessiones-editando" name="sessiones-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>sessiones/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="ip" class="col-3"><?php echo __("Ip"); ?></label>
<div class="col-7"><input id="ip" name="ip" type="text" value="<?php echo $sale->fields["ip"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Ip"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="nombre" class="col-3"><?php echo __("Nombre"); ?></label>
<div class="col-7"><input id="nombre" name="nombre" type="text" value="<?php echo $sale->fields["nombre"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Nombre"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="email" class="col-3"><?php echo __("Email"); ?></label>
<div class="col-7"><input id="email" name="email" type="text" value="<?php echo $sale->fields["email"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Email"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="celular" class="col-3"><?php echo __("Celular"); ?></label>
<div class="col-7"><input id="celular" name="celular" type="text" value="<?php echo $sale->fields["celular"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Celular"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="fechaentrega" class="col-3"><?php echo __("Fechaentrega"); ?></label>
<div class="col-7"><input id="fechaentrega" name="fechaentrega" type="text" value="<?php echo $sale->fields["fechaentrega"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Fechaentrega"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="direccion" class="col-3"><?php echo __("Dirección"); ?></label>
<div class="col-7"><input id="direccion" name="direccion" type="text" value="<?php echo $sale->fields["direccion"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Dirección"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="fin" class="col-3"><?php echo __("Fin"); ?></label>
<div class="col-7"><select name="fin" id="fin" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Fin"); ?>" required>
		<option value="0"<?php if(!$sale->fields["fin"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione Fin"); ?></option>
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
	
	$("#fechaentrega").datepicker(dateconf);

	$("#sessiones-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");


		if($("#ip").val()==""){
			if(err==0)$("#ip").focus();err++;$("#ip").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#nombre").val()==""){
			if(err==0)$("#nombre").focus();err++;$("#nombre").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#email").val()=="" || !valmail($("#email").val())){
			if(err==0)$("#email").focus();err++;$("#email").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#celular").val()==""){
			if(err==0)$("#celular").focus();err++;$("#celular").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#fechaentrega").val()==""){
			if(err==0)$("#fechaentrega").focus();err++;$("#fechaentrega").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#direccion").val()==""){
			if(err==0)$("#direccion").focus();err++;$("#direccion").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#fin").val()==""){
			if(err==0)$("#fin").focus();err++;$("#fin").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>