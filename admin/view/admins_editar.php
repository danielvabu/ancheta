<h4><?php echo __("Editar Administrador"); ?></h4>

<form id="admins-editando" name="admins-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>admins/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="nombre" class="col-3"><?php echo __("Nombre"); ?></label>
<div class="col-7"><input id="nombre" name="nombre" type="text" value="<?php echo $sale->fields["nombre"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Nombre"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="email" class="col-3"><?php echo __("Email"); ?></label>
<div class="col-7"><input id="email" name="email" type="text" value="<?php echo $sale->fields["email"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Email"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="usuario" class="col-3"><?php echo __("Usuario"); ?></label>
<div class="col-7"><input id="usuario" name="usuario" type="text" value="<?php echo $sale->fields["usuario"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Usuario"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="clave" class="col-3"><?php echo __("Clave"); ?></label>
<div class="col-7"><input id="clave" name="clave" type="text" value="<?php echo $sale->fields["clave"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Clave"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="estado" class="col-3"><?php echo __("Estado"); ?></label>
<div class="col-7"><select name="estado" id="estado" class="form-control" required>
			<option value="1"<?php if($sale->fields["estado"]) { ?> selected="selected"<?php } ?>><?php echo __("Activo"); ?></option>
			<option value="0"<?php if(!$sale->fields["estado"]){ ?> selected="selected"<?php } ?>><?php echo __("Inactivo"); ?></option>
		</select></div>
</div>


<div class="form-group row">
	<div class="col-3"><button type="button" class="btn btn-secondary btn-block" onClick="window.history.back();" style="margin-top:10px;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
	<div class="col-5"><button type="submit" class="btn btn-primary btn-block" data-loading-text="Verificando..." style="margin-top:10px;"><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
</div>

	</div>
</div>

</form>

<script language="javascript" type="application/javascript">
var pavem=0;
$(function(){
	
	$("#admins-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");


		if($("#nombre").val()==""){
			if(err==0)$("#nombre").focus();err++;$("#nombre").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#email").val()=="" || !valmail($("#email").val())){
			if(err==0)$("#email").focus();err++;$("#email").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#usuario").val()==""){
			if(err==0)$("#usuario").focus();err++;$("#usuario").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#clave").val()==""){
			if(err==0)$("#clave").focus();err++;$("#clave").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#estado").val()==""){
			if(err==0)$("#estado").focus();err++;$("#estado").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>