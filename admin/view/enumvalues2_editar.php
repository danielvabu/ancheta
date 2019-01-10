<h4><?php echo __("Editar Enumvalues"); ?></h4>

<form id="enumvalues2-editando" name="enumvalues2-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>enumvalues2/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="id" class="col-3"><?php echo __("id"); ?></label>
<div class="col-7"><input id="id" name="id" type="text" value="<?php echo $sale->fields["id"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la id"); ?>" /></div>
</div>


<div class="form-group row">
<label for="label" class="col-3"><?php echo __("Label"); ?></label>
<div class="col-7"><input id="label" name="label" type="text" value="<?php echo $sale->fields["label"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Label"); ?>" /></div>
</div>


<div class="form-group row">
<label for="etiqueta" class="col-3"><?php echo __("Etiqueta"); ?></label>
<div class="col-7"><input id="etiqueta" name="etiqueta" type="text" value="<?php echo $sale->fields["etiqueta"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Etiqueta"); ?>" /></div>
</div>


<div class="form-group row">
<label for="comment" class="col-3"><?php echo __("Comment"); ?></label>
<div class="col-7"><input id="comment" name="comment" type="text" value="<?php echo $sale->fields["comment"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Comment"); ?>" /></div>
</div>


<div class="form-group row">
<label for="enumerationtype" class="col-3"><?php echo __("Enumerationtype"); ?></label>
<div class="col-7"><textarea id="enumerationtype" name="enumerationtype" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Enumerationtype"); ?>"><?php echo $sale->fields["enumerationtype"]; ?></textarea></div>
</div>


<div class="form-group row">
<label for="supersedes" class="col-3"><?php echo __("Supersedes"); ?></label>
<div class="col-7"><textarea id="supersedes" name="supersedes" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Supersedes"); ?>"><?php echo $sale->fields["supersedes"]; ?></textarea></div>
</div>


<div class="form-group row">
<label for="supersededBy" class="col-3"><?php echo __("SupersededBy"); ?></label>
<div class="col-7"><textarea id="supersededBy" name="supersededBy" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el SupersededBy"); ?>"><?php echo $sale->fields["supersededBy"]; ?></textarea></div>
</div>


<div class="form-group row">
<label for="isPartOf" class="col-3"><?php echo __("IsPartOf"); ?></label>
<div class="col-7"><textarea id="isPartOf" name="isPartOf" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el IsPartOf"); ?>"><?php echo $sale->fields["isPartOf"]; ?></textarea></div>
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
	
	$("#enumvalues2-editando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");


		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>