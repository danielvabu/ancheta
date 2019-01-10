<h4><?php echo __("Ver ciudades"); ?></h4>

<div class="row">
	<div class="col-8" itemscope itemtype="">


<div class="row">
	<div class="col-5"><?php echo __("id"); ?></div>
	<div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Departamento"); ?></div>
	<div class="col-7"><?php echo $sale->fields["departamentos_departamento"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Ciudad"); ?></div>
	<div class="col-7"><?php echo $sale->fields["ciudad"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Url"); ?></div>
	<div class="col-7"><?php echo $sale->fields["url"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Código"); ?></div>
	<div class="col-7"><?php echo $sale->fields["codigo"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Estado"); ?></div>
	<div class="col-7"><?php if($sale->fields["estado"]){echo __("Activo");}else{echo __("Inactivo");} ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Creado"); ?></div>
	<div class="col-7"><?php echo $sale->fields["creado"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Editado"); ?></div>
	<div class="col-7"><?php echo $sale->fields["editado"]; ?>	</div>
</div>


<div class="form-group">
<div class="col-5">&nbsp;</div>
<div class="col-7"><button type="button" class="btn btn-primary btn-block mt-2" onClick="window.history.back();">
<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("volver"); ?>
</button></div>
</div>

	</div>
	<div class="col-4">&nbsp;</div>
</div>

