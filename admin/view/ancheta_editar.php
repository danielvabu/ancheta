<h4><?php echo __("Editar Anchet"); ?></h4>

<form id="ancheta-editando" name="ancheta-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>ancheta/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="sessione_id" class="col-3"><?php echo __("Sessione"); ?></label>
<div class="col-7"><select name="sessione_id" id="sessione_id" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Sessione"); ?>" required>
		<option value="0"<?php if(!$sale->fields["sessione_id"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione Sessione"); ?></option><?php
if(!$sessiones->EOF){
	while(!$sessiones->EOF){ ?>
    	<option value="<?php echo $sessiones->fields["id"]; ?>"<?php if($sessiones->fields["id"]==$sale->fields["sessione_id"]){ ?> selected="selected"<?php } ?>><?php echo $sessiones->fields["nombre"]; ?></option><?php
		$sessiones->MoveNext();
	}
	$sessiones->Move(0);
} ?></select></div>
</div>


<div class="form-group row">
<label for="producto_id" class="col-3"><?php echo __("Producto"); ?></label>
<div class="col-7"><select name="producto_id" id="producto_id" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Producto"); ?>" required>
		<option value="0"<?php if(!$sale->fields["producto_id"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione Producto"); ?></option><?php
if(!$productos->EOF){
	while(!$productos->EOF){ ?>
    	<option value="<?php echo $productos->fields["id"]; ?>"<?php if($productos->fields["id"]==$sale->fields["producto_id"]){ ?> selected="selected"<?php } ?>><?php echo $productos->fields["nombre"]; ?></option><?php
		$productos->MoveNext();
	}
	$productos->Move(0);
} ?></select></div>
</div>


<div class="form-group row">
<label for="cantidad" class="col-3"><?php echo __("Cantidad"); ?></label>
<div class="col-7"><select name="cantidad" id="cantidad" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione la Cantidad"); ?>" required>
		<option value="0"<?php if(!$sale->fields["cantidad"]){ ?> selected="selected"<?php } ?>><?php echo __("Seleccione Cantidad"); ?></option>
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
	
	$("#ancheta-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");



		if($("#sessione_id").val()==0){
			if(err==0)$("#sessione_id").focus();err++;$("#sessione_id").addClass("has-error").popover("show").parent("div").addClass("has-error");}


		if($("#producto_id").val()==0){
			if(err==0)$("#producto_id").focus();err++;$("#producto_id").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#cantidad").val()==""){
			if(err==0)$("#cantidad").focus();err++;$("#cantidad").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>