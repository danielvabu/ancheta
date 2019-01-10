
<h4><?php echo __("Nuevo Types"); ?></h4>

<form id="types2-agregando" name="types2-agregando" class="form-horizontal" method="post" action="<?php echo PATO; ?>types2/agregando/" enctype="multipart/form-data">

<div class="row"><div class="col-12">&nbsp;</div></div>

<div class="row">
	<div class="col-12">


<div class="form-group row">
<label for="id" class="col-2"><?php echo __("id"); ?></label>
<div class="col-7"><input id="id" name="id" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la id"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="label" class="col-2"><?php echo __("Label"); ?></label>
<div class="col-7"><input id="label" name="label" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Label"); ?>" required /></div>
</div>


<div class="form-group row">
<label for="etiqueta" class="col-2"><?php echo __("Etiqueta"); ?></label>
<div class="col-7"><input id="etiqueta" name="etiqueta" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba la Etiqueta"); ?>" /></div>
</div>


<div class="form-group row">
<label for="comment" class="col-2"><?php echo __("Comment"); ?></label>
<div class="col-7"><input id="comment" name="comment" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Comment"); ?>" /></div>
</div>


<div class="form-group row">
<label for="subTypeOf" class="col-2"><?php echo __("SubTypeOf"); ?></label>
<div class="col-7"><textarea id="subTypeOf" name="subTypeOf" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el SubTypeOf"); ?>"></textarea></div>
</div>


<div class="form-group row">
<label for="equivalentClass" class="col-2"><?php echo __("EquivalentClass"); ?></label>
<div class="col-7"><textarea id="equivalentClass" name="equivalentClass" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el EquivalentClass"); ?>"></textarea></div>
</div>


<div class="form-group row">
<label for="properties" class="col-2"><?php echo __("Properties"); ?></label>
<div class="col-7"><input id="properties" name="properties" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Properties"); ?>" /></div>
</div>


<div class="form-group row">
<label for="subTypes" class="col-2"><?php echo __("SubTypes"); ?></label>
<div class="col-7"><textarea id="subTypes" name="subTypes" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el SubTypes"); ?>"></textarea></div>
</div>


<div class="form-group row">
<label for="supersedes" class="col-2"><?php echo __("Supersedes"); ?></label>
<div class="col-7"><textarea id="supersedes" name="supersedes" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Supersedes"); ?>"></textarea></div>
</div>


<div class="form-group row">
<label for="supersededBy" class="col-2"><?php echo __("SupersededBy"); ?></label>
<div class="col-7"><textarea id="supersededBy" name="supersededBy" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el SupersededBy"); ?>"></textarea></div>
</div>


<div class="form-group row">
<label for="isPartOf" class="col-2"><?php echo __("IsPartOf"); ?></label>
<div class="col-7"><textarea id="isPartOf" name="isPartOf" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el IsPartOf"); ?>"></textarea></div>
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
	
	$("#types2-agregando").submit(function(){
		var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");

		if($("#id").val()==""){
			if(err==0)$("#id").focus();err++;$("#id").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if($("#label").val()==""){
			if(err==0)$("#label").focus();err++;$("#label").addClass("has-error").popover("show").parent("div").addClass("has-error");}

		if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
	});
});
</script>